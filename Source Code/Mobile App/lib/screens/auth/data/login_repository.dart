import 'dart:convert';
import 'dart:developer';

import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/auth/models/login_model.dart';
import 'package:ats_system/screens/home/models/change_pw_response.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:injectable/injectable.dart';

abstract class LoginApiService {
  Future<LoginModel?> doLogin(CustomRequest request);

  Future<ChangePwResponse> changePassword(CustomRequest request);

  Future<bool> refreshToken();
}

@Injectable(as: LoginApiService)
class LoginApiImpl extends LoginApiService {
  final BaseHttpService _service = locator.get<BaseHttpService>();

  @override
  Future<LoginModel?> doLogin(CustomRequest request) async {
    CustomResponse response = await _service.onPostRequest((request));
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      try {
        return LoginModel.fromJson((response.result));
      } catch (e) {
        return LoginModel.fromErrorJson((response.result));
      }
    } else {
      return LoginModel.fromErrorJson((response.result));
    }
  }

  @override
  Future<ChangePwResponse> changePassword(CustomRequest request) async {
    CustomResponse response = await _service.onPostRequest(request);
    return ChangePwResponse.fromJson((response.result));
  }

  @override
  Future<bool> refreshToken() async {
    final SessionManager session = locator.get<SessionManager>();
    final body = {
      'refresh_token': session.getRefreshToken(),
      'content-type': 'application/json'
    };
    log('My token :${jsonEncode(body)}');
    CustomRequest request = CustomRequest(
        url: Urls.refreshTokenUrl,
        urlName: 'refreshToken',
        body: jsonEncode(body));
    CustomResponse response = await _service.onPostRequest(request);
    if (response.statusCode == 200) {
      final model = LoginModel.fromJson(response.result);
      if (model.status == 'Success') {
        session.setExpirationTime(DateTime.now()
            .add(Duration(seconds: model.data.expiresIn!))
            .toString());

        session.setToken('${model.data.tokenType} ${model.data.accessToken}');
        session.setRefreshToken(model.data.refreshToken!);
        return false;
      }
    }

    return true;
  }
}
