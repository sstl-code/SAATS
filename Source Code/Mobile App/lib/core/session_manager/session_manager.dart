import 'package:ats_system/utils/constants.dart';
import 'package:injectable/injectable.dart';
import 'package:shared_preferences/shared_preferences.dart';

@lazySingleton
@injectable
class SessionManager {
  late final SharedPreferences _pref;

  SessionManager(this._pref);

  void clearPref() {
    _pref.clear();
  }

  String? getLoginId() => _pref.getString(Constants.prefLoginId);
  void setLoginId(String value) =>
      _pref.setString(Constants.prefLoginId, value);

  int? getUserId() => _pref.getInt(Constants.prefUserId);
  void setUserId(int value) => _pref.setInt(Constants.prefUserId, value);

  String? getPassword() => _pref.getString(Constants.prefPassword);
  void setPassword(String value) =>
      _pref.setString(Constants.prefPassword, value);

  String? getUserName() => _pref.getString(Constants.prefUserName);
  void setUserName(String value) =>
      _pref.setString(Constants.prefUserName, value);

  String? getUserEmail() => _pref.getString(Constants.prefUserEmail);
  void setUserEmail(String value) =>
      _pref.setString(Constants.prefUserEmail, value);

  String? getUserMobileNo() => _pref.getString(Constants.prefUserMobileNo);
  void setUserMobileNo(String value) =>
      _pref.setString(Constants.prefUserMobileNo, value);

  String? getUserAlternateContactNo() =>
      _pref.getString(Constants.prefAlternateContactNo);
  void setUserAlternateContactNo(String value) =>
      _pref.setString(Constants.prefAlternateContactNo, value);

  int? getRoleId() => _pref.getInt(Constants.prefRoleId);
  void setRoleId(int value) => _pref.setInt(Constants.prefRoleId, value);

  String? getRoleCode() => _pref.getString(Constants.prefRoleCode);
  void setRoleCode(String value) =>
      _pref.setString(Constants.prefRoleCode, value);

  String? getRoleName() => _pref.getString(Constants.prefRoleName);
  void setRoleName(String value) =>
      _pref.setString(Constants.prefRoleName, value);

  bool isSupervisor() => _pref.getBool(Constants.prefIsSupervisor) ?? false;
  void setSupervisor(bool value) =>
      _pref.setBool(Constants.prefIsSupervisor, value);

  String getToken() => _pref.getString(Constants.prefAccessToken) ?? '';
  void setToken(String value) =>
      _pref.setString(Constants.prefAccessToken, value);

  String? getRefreshToken() => _pref.getString(Constants.prefRefreshToken);
  void setRefreshToken(String value) =>
      _pref.setString(Constants.prefRefreshToken, value);

  String get expirationTime => _pref.getString(Constants.prefExpirationTime)!;
  void setExpirationTime(String value) =>
      _pref.setString(Constants.prefExpirationTime, value);

  String? getProxyIpAddress() => _pref.getString(Constants.prefIpAddress);
  void setProxyIpAddress(String value) =>
      _pref.setString(Constants.prefIpAddress, value);

  String? getProxyPort() => _pref.getString(Constants.prefPort);
  void setProxyPort(String value) => _pref.setString(Constants.prefPort, value);
}
