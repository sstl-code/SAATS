import 'package:ats_system/repository/internet_connection_service.dart';
import 'package:ats_system/screens/auth/bloc/auth_event.dart';
import 'package:ats_system/screens/auth/bloc/auth_state.dart';
import 'package:ats_system/screens/auth/repo/auth_repo.dart';
import 'package:ats_system/screens/site_gallery/models/event_failure.dart';
import 'package:ats_system/utils/api_response_handler.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:bloc/bloc.dart';
import 'package:injectable/injectable.dart';

@injectable
class AuthBloc extends Bloc<AuthEvent, AuthState> {
  final AuthRepo repo;
  final InternetConnectionService internetConnection;

  AuthBloc(this.repo, this.internetConnection) : super(GetOtpState.initial()) {
    on<GetOtp>(_getOtp);
    on<ValidateOtp>(_validateOtp);
    on<UpdatePassword>(_updatePassword);
  }

  void _getOtp(GetOtp request, emit) async {
    if (!await internetConnection.isInternetConnected()) {
      emit(GetOtpState.noInternet(checkInternetConnection));
      return;
    }
    try {
      emit(GetOtpState.loading());
      final response = await repo.getOtp(request);
      if (response.status == 200) {
        emit(GetOtpState.success(response));
        await checkResponseStatus(response.message!);
      } else {
        Failure failure = await checkResponseStatus(response.message!);
        emit(ValidateOtpState.error(failure));
      }
    } catch (e) {
      Failure failure = await checkResponseStatus(e);

      emit(GetOtpState.error(failure));
    }
  }

  void _validateOtp(ValidateOtp request, emit) async {
    if (!await internetConnection.isInternetConnected()) {
      emit(ValidateOtpState.noInternet(checkInternetConnection));
      return;
    }
    try {
      emit(ValidateOtpState.loading());
      final response = await repo.validateOtp(request);

      if (response.status == 200) {
        emit(ValidateOtpState.success(response));
      } else {
        Failure failure = await checkResponseStatus(response.message!);
        emit(ValidateOtpState.error(failure));
      }
    } catch (e) {
      Failure failure = await checkResponseStatus(e);

      emit(ValidateOtpState.error(failure));
    }
  }

  void _updatePassword(UpdatePassword request, emit) async {
    if (!await internetConnection.isInternetConnected()) {
      emit(UpdatePasswordState.noInternet(checkInternetConnection));
      return;
    }
    try {
      emit(UpdatePasswordState.loading());
      final response = await repo.updatePassword(request);

      if (response.status == 200) {
        emit(UpdatePasswordState.success(response));
        ToastMessage.showMessage(response.message, kToastSuccessColor);
      } else {
        Failure failure = await checkResponseStatus(response.message!);
        emit(UpdatePasswordState.error(failure));
      }
    } catch (e) {
      Failure failure = await checkResponseStatus(e);

      emit(UpdatePasswordState.error(failure));
    }
  }
}
