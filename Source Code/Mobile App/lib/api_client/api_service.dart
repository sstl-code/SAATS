// api_service.dart
import 'package:ats_system/screens/auth/models/forgot_password/get_otp/get_otp_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/get_otp/get_otp_response_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/update_password/update_password_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/update_password/update_password_response_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/validate_otp/validate_otp_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/validate_otp/validate_otp_response_model.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_request_model.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_response_model/get_gallery_response_model.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/common_meta_data.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:dio/dio.dart';
import 'package:retrofit/retrofit.dart';

part 'api_service.g.dart';

@RestApi(baseUrl: Urls.baseUrl)
abstract class ApiService {
  factory ApiService(Dio dio, {String baseUrl}) = _ApiService;

  @POST("/getsite_media")
  Future<GetGalleryResponseModel> getGallery(
      @Body() GetGalleryRequestModel body);

  @POST("/getotp")
  Future<GetOtpResponseModel> getOtp(@Body() GetOtpRequestModel body);

  @POST("/matchotp")
  Future<ValidateOtpResponseModel> validateOtp(
      @Body() ValidateOtpRequestModel body);

  @POST("/forgotpassword")
  Future<UpdatePasswordResponseModel> updatePassword(
      @Body() UpdatePasswordRequestModel body);

  @GET("/commondata")
  Future<CommonMetaData> appMetaData();
}
