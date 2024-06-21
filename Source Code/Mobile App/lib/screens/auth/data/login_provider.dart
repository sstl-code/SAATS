import 'dart:convert';

import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/auth/data/login_repository.dart';
import 'package:ats_system/screens/auth/models/login_model.dart';
import 'package:ats_system/screens/auth/models/login_req_model.dart';
import 'package:ats_system/screens/home/models/change_password_model.dart';
import 'package:ats_system/screens/home/models/change_pw_response.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:flutter/material.dart';

class LoginProvider extends ChangeNotifier {
  final LoginApiService _loginService = locator.get<LoginApiService>();
  final SessionManager _session = locator.get<SessionManager>();

  bool _isPwObscure = true,
      _isNPwObscure = true,
      _isENPwObscure = true,
      _isProcessing = false;
  String? _userError, _pwError, _newPwError, _cNPwError;
  LoginModel? _loginModel;

  get userError => _userError;

  String? get pwError => _pwError;

  get newPwError => _newPwError;

  get cNPwError => _cNPwError;

  void initializePassword() {
    _userError = _pwError = _newPwError = _cNPwError = null;
    notifyListeners();
  }

  void setUserError(String? error) {
    _userError = error;
    notifyListeners();
  }

  void setPwError(String? error) {
    _pwError = error;
    notifyListeners();
  }

  void setNewPwError(String? error) {
    _newPwError = error;
    notifyListeners();
  }

  void setCNPwError(String? error) {
    _cNPwError = error;
    notifyListeners();
  }

  bool get isPwObscure => _isPwObscure;

  void setPwObscure(bool value) {
    _isPwObscure = value;
    notifyListeners();
  }

  get isNPwObscure => _isNPwObscure;

  void setNPwObscure(value) {
    _isNPwObscure = value;
    notifyListeners();
  }

  get isENPwObscure => _isENPwObscure;

  void setENPwObscure(value) {
    _isENPwObscure = value;
    notifyListeners();
  }

  void setValuesForButton() {
    _isPwObscure = true;
    _isNPwObscure = true;
    _isENPwObscure = true;
    notifyListeners();
  }

  bool get isProcessing => _isProcessing;

  void setProcessing(bool value) {
    _isProcessing = value;
    notifyListeners();
  }

  LoginModel get loginModel => _loginModel!;

  bool validateBoth(String userID, String password) {
    if (userID.trim().isEmpty && password.trim().isEmpty) {
      setUserError(Strings.emptyUsername);
      setPwError(Strings.emptyPassword);
      return false;
    }
    return true;
  }

  bool isValidUserId(String input) {
    if (input.isEmpty) {
      setUserError(Strings.emptyUsername);
      return false;
    }
    if (!RegExp(
            r"^[a-zA-Z0-9.a-zA-Z0-9.!#$%&'*+-/=?^_`{|}~]+@[a-zA-Z0-9]+\.[a-zA-Z]+")
        .hasMatch(input)) {
      setUserError(Strings.incorrectEmail);
      return false;
    }
    setUserError(null);
    return true;
  }

  bool isValidPassword(Map<String, String> input) {
    String type = input.entries.first.key;
    if (input.entries.first.value.trim().isEmpty) {
      type == 'pw'
          ? setPwError(Strings.emptyPassword)
          : type == 'np'
              ? setNewPwError('New Password can\'t be empty.')
              : setCNPwError('Confirm password can\'t be empty.');
      return false;
    } else if (input.entries.first.value.trim().length < 5) {
      type == 'pw'
          ? setPwError('Password should be greater than 4 digits.')
          : type == 'np'
              ? setNewPwError('New password should be greater than 4 digits.')
              : setCNPwError(
                  'Confirm new password should be greater than 4 digits.');
      return false;
    }
    type == 'pw'
        ? setPwError(null)
        : type == 'np'
            ? setNewPwError(null)
            : setCNPwError(null);
    return true;
  }

  void setLoginDetails(LoginModel model, String username, String password) {
    User? result = model.data.user;
    if (result == null) return;
    _session.setExpirationTime(DateTime.now()
        .add(Duration(seconds: model.data.expiresIn!))
        .toString());
    _session.setToken('${model.data.tokenType!} ${model.data.accessToken!}');
    _session.setRefreshToken(model.data.refreshToken!);
    _session.setLoginId(username);
    _session.setPassword(password);
    _session.setUserId(result.id!);
    _session.setUserName(result.name ?? '');
    _session.setUserEmail(result.email ?? '');
    _session.setSupervisor(result.isSupervisor!);
    notifyListeners();
  }

  Future<String?> doLogin(String username, String password) async {
    setProcessing(true);

    LoginReqModel body = LoginReqModel(
      email: username,
      password: password,
    );
    return _loginService
        .doLogin(CustomRequest(
            url: Urls.loginUrl, urlName: 'loginUrl', body: jsonEncode(body)))
        .then((response) async {
      try {
        if (response != null) {
          if (response.status == 'Success') {
            _loginModel = response;

            setLoginDetails(_loginModel!, username, password);
            return response.status!;
          } else {
            return response.data.message;
          }
        }
        return null;
      } catch (e) {
        return null;
      }
    }).whenComplete(() => setProcessing(false));
  }

  Future<ChangePwResponse> changePassword(String oldPwd, String newPwd) async {
    await CommonMethods.isAuthKeyExpired();
    setProcessing(true);
    ChangePasswordModel model = ChangePasswordModel(
        oldPassword: oldPwd,
        newPassword: newPwd,
        userId: _session.getUserId()!);
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    return await _loginService
        .changePassword(CustomRequest(
            url: Urls.changePasswordUrl,
            urlName: 'changePassword',
            body: jsonEncode(model.toJson()),
            headers: header))
        .then((value) => value)
        .whenComplete(() => setProcessing(false));
  }

  void initialize() {
    _isProcessing = false;
    _userError = _pwError = _newPwError = _cNPwError = null;
  }

  void clearAll() {
    _isPwObscure = true;
    _isNPwObscure = true;
    _isENPwObscure = true;
    _isProcessing = false;
    _loginModel = null;
    _userError = _pwError = _newPwError = _cNPwError = null;
    notifyListeners();
  }
}
