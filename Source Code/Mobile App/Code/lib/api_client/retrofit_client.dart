import 'package:ats_system/api_client/api_service.dart';
import 'package:ats_system/api_client/config.dart';
import 'package:ats_system/api_client/logging_interceptor.dart';
import 'package:ats_system/screens/auth/models/forgot_password/get_otp/get_otp_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/get_otp/get_otp_response_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/update_password/update_password_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/update_password/update_password_response_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/validate_otp/validate_otp_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/validate_otp/validate_otp_response_model.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_request_model.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_response_model/get_gallery_response_model.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/common_meta_data.dart';
import 'package:dio/dio.dart';
import 'package:injectable/injectable.dart';

abstract class RetrofitClient {
  Future<GetGalleryResponseModel> getGallery(GetGalleryRequestModel request);

  Future<GetOtpResponseModel> getOtp(GetOtpRequestModel request);

  Future<ValidateOtpResponseModel> validateOtp(ValidateOtpRequestModel request);

  Future<UpdatePasswordResponseModel> updatePassword(
      UpdatePasswordRequestModel request);

  Future<CommonMetaData> getAppMetaData();

  Dio get getDio;
}

@Injectable(as: RetrofitClient)
class UserAuthClient extends RetrofitClient {
  final Dio dio;
  final IConfig config;
  final ApiService client;

  UserAuthClient({
    required this.dio,
    required this.config,
  }) : client = ApiService(dio, baseUrl: config.baseUrl) {
    dio.interceptors.add(LoggingInterceptor());
  }

  @override
  Future<GetGalleryResponseModel> getGallery(request) {
    return client.getGallery(request);
  }

  @override
  Dio get getDio => dio;

  @override
  Future<GetOtpResponseModel> getOtp(GetOtpRequestModel request) {
    return client.getOtp(request);
  }

  @override
  Future<ValidateOtpResponseModel> validateOtp(
      ValidateOtpRequestModel request) {
    return client.validateOtp(request);
  }

  @override
  Future<UpdatePasswordResponseModel> updatePassword(
      UpdatePasswordRequestModel request) {
    return client.updatePassword(request);
  }

  @override
  Future<CommonMetaData> getAppMetaData() {
    return client.appMetaData();
  }
}
