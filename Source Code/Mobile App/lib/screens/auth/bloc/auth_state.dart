import 'package:ats_system/screens/site_gallery/models/event_failure.dart';
import 'package:freezed_annotation/freezed_annotation.dart';

part 'auth_state.freezed.dart';

abstract class AuthState {
  const AuthState();
}

@freezed
class GetOtpState extends AuthState with _$GetOtpState {
  factory GetOtpState.initial() = GetOtpStateInitial;

  factory GetOtpState.loading() = GetOtpStateLoading;

  factory GetOtpState.success(dynamic data) = GetOtpStateSuccess;

  factory GetOtpState.error(Failure error) = GetOtpStateError;

  factory GetOtpState.noInternet(String message) = GetOtpStateNoInternet;
}

@freezed
class ValidateOtpState extends AuthState with _$ValidateOtpState {
  factory ValidateOtpState.initial() = ValidateOtpStateInitial;

  factory ValidateOtpState.loading() = ValidateOtpStateLoading;

  factory ValidateOtpState.success(dynamic data) = ValidateOtpStateSuccess;

  factory ValidateOtpState.error(Failure error) = ValidateOtpStateError;

  factory ValidateOtpState.noInternet(String message) =
      ValidateOtpStateNoInternet;
}

@freezed
class UpdatePasswordState extends AuthState with _$UpdatePasswordState {
  factory UpdatePasswordState.initial() = UpdatePasswordStateInitial;

  factory UpdatePasswordState.loading() = UpdatePasswordStateLoading;

  factory UpdatePasswordState.success(dynamic data) =
      UpdatePasswordStateSuccess;

  factory UpdatePasswordState.error(Failure error) = UpdatePasswordStateError;

  factory UpdatePasswordState.noInternet(String message) =
      UpdatePasswordStateNoInternet;
}
