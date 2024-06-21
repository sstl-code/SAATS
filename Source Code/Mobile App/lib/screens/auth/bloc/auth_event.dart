import 'package:ats_system/screens/auth/models/forgot_password/get_otp/get_otp_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/update_password/update_password_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/validate_otp/validate_otp_request_model.dart';
import 'package:freezed_annotation/freezed_annotation.dart';

part 'auth_event.freezed.dart';

@freezed
class AuthEvent with _$AuthEvent {
  factory AuthEvent.getOtp(GetOtpRequestModel data) = GetOtp;
  factory AuthEvent.validateOtp(ValidateOtpRequestModel data) = ValidateOtp;
  factory AuthEvent.updatePassword(UpdatePasswordRequestModel data) =
      UpdatePassword;
}
