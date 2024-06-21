import 'dart:developer';

import 'package:ats_system/repository/internet_connection_service.dart';
import 'package:ats_system/screens/site_gallery/models/event_failure.dart';
import 'package:ats_system/screens/splash/bloc/app_metadata_event.dart';
import 'package:ats_system/screens/splash/bloc/app_metadata_state.dart';
import 'package:ats_system/screens/splash/repo/app_metadata_repo.dart';
import 'package:ats_system/utils/api_response_handler.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:bloc/bloc.dart';
import 'package:injectable/injectable.dart';

@injectable
class AppMetaDataBloc extends Bloc<AppMetaDataEvent, AppMetaDataState> {
  final AppMetaDataRepo appMetaDataRepo;
  final InternetConnectionService internetConnection;

  AppMetaDataBloc(this.appMetaDataRepo, this.internetConnection)
      : super(AppMetaDataState.initial()) {
    on<GetAppMetaData>(_getAppMetaData);
  }

  void _getAppMetaData(GetAppMetaData request, emit) async {
    if (!await internetConnection.isInternetConnected()) {
      emit(AppMetaDataState.noInternet(checkInternetConnection));
      return;
    }

    try {
      emit(AppMetaDataState.loading());
      final response = await appMetaDataRepo.getAppMetaData();
      emit(AppMetaDataState.success(response));
    } catch (e) {
      log('api response error is ${e}');
      Failure failure = await checkResponseStatus(e);

      emit(AppMetaDataState.error(failure));
    }
  }
}
