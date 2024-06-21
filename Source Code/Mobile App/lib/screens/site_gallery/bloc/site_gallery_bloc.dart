import 'dart:developer';
import 'dart:io';

import 'package:ats_system/repository/internet_connection_service.dart';
import 'package:ats_system/repository/navigation_service.dart';
import 'package:ats_system/screens/site_gallery/bloc/site_gallery_event.dart';
import 'package:ats_system/screens/site_gallery/bloc/site_gallery_state.dart';
import 'package:ats_system/screens/site_gallery/models/event_failure.dart';
import 'package:ats_system/screens/site_gallery/repo/site_gallery_repo.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/snack_bar.dart';
import 'package:bloc/bloc.dart';
import 'package:dio/dio.dart';
import 'package:get_it/get_it.dart';
import 'package:injectable/injectable.dart';

@injectable
class SiteGalleryBloc extends Bloc<SiteGalleryEvent, SiteGalleryState> {
  final SiteGalleryRepo siteGalleryRepo;
  final InternetConnectionService internetConnection;

  SiteGalleryBloc(this.siteGalleryRepo, this.internetConnection)
      : super(SiteGalleryState.initial()) {
    on<GetGallery>(_getGallery);
  }

  void _getGallery(GetGallery request, emit) async {
    if (!await internetConnection.isInternetConnected()) {
      emit(SiteGalleryState.noInternet(checkInternetConnection));
      return;
    }
    await CommonMethods.isAuthKeyExpired();

    try {
      emit(SiteGalleryState.loading());
      final response = await siteGalleryRepo.getGallery(request);
      emit(SiteGalleryState.success(response));
    } catch (e) {
      Failure failure = await _checkResponseStatus(e);

      emit(SiteGalleryState.error(failure));
    }
  }

  void deleteFile(String filePath, String? thumbnail) async {
    try {
      if (thumbnail != null) {
        File file = File(thumbnail);
        await file.delete();
      }
      File file = File(filePath);
      await file.delete();
      log('File deleted successfully');
    } catch (e) {
      log('Error deleting file: $e');
    }
  }
}

Future<Failure> _checkResponseStatus(Object e) async {
  Failure failure;
  String? errorMessage;
  if (e is DioException) {
    if (e.response != null) {
      if (e.response?.data != null) {
        Map<String, dynamic> jsonObject =
            e.response?.data as Map<String, dynamic>;

        if (jsonObject.containsKey('message')) {
          errorMessage = jsonObject['message'].toString();
        }
      }

      var statusCode = e.response!.statusCode;
      switch (statusCode) {
        case 400:
          failure =
              Failure(code: 400, error: errorMessage ?? "Something went wrong");
          break;
        case 401:
          failure = Failure(code: 401, error: errorMessage ?? "Unauthorized");
          break;
        case 403:
          failure = Failure(
              code: 403,
              error: errorMessage ??
                  'You do not have access right for this operation.');
          break;
        case 404:
          failure = Failure(code: 404, error: errorMessage ?? 'Not found');
          break;
        case 405:
          failure =
              Failure(code: 405, error: errorMessage ?? 'Method not allowed');
          break;
        case 415:
          failure = Failure(
              code: 415, error: errorMessage ?? 'Media type not supported.');
          break;
        case 423:
          failure = Failure(code: 423, error: errorMessage ?? 'Access denied.');
          break;
        case 500:
          failure = Failure(
              code: 500, error: errorMessage ?? 'Internal server error');
          break;
        case 503:
          failure =
              Failure(code: 503, error: errorMessage ?? 'Service unavailable');
          break;
        default:
          failure = Failure(code: 0, error: errorMessage ?? 'Unknown request');
      }
    } else {
      failure = Failure(code: 0, error: e.message!);
    }
  } else {
    log('Printing response ${e}');

    failure = Failure(code: 0, error: e.toString());
  }

  GetIt.I<NavigationService>().getContext().showSnackBar(failure.error);

  return failure;
}
