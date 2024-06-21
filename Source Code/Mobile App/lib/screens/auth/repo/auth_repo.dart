import 'package:ats_system/api_client/retrofit_client.dart';
import 'package:ats_system/screens/auth/bloc/auth_event.dart';
import 'package:ats_system/screens/auth/models/forgot_password/get_otp/get_otp_response_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/update_password/update_password_response_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/validate_otp/validate_otp_response_model.dart';
import 'package:injectable/injectable.dart';

abstract class AuthRepo {
  Future<GetOtpResponseModel> getOtp(GetOtp request);
  Future<ValidateOtpResponseModel> validateOtp(ValidateOtp request);
  Future<UpdatePasswordResponseModel> updatePassword(UpdatePassword request);
}

@Injectable(as: AuthRepo)
class Auth extends AuthRepo {
  final RetrofitClient authClient;
  Auth({
    required this.authClient,
  });

  @override
  Future<GetOtpResponseModel> getOtp(GetOtp request) async {
    return await authClient.getOtp(request.data);
  }

  @override
  Future<ValidateOtpResponseModel> validateOtp(ValidateOtp request) async {
    return await authClient.validateOtp(request.data);
  }

  @override
  Future<UpdatePasswordResponseModel> updatePassword(
      UpdatePassword request) async {
    return await authClient.updatePassword(request.data);
  }
}
