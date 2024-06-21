import 'package:ats_system/utils/log_util.dart';
import 'package:device_info_plus/device_info_plus.dart';
import 'package:flutter/services.dart';
import 'package:permission_handler/permission_handler.dart';

class PermissionManager {
  Future<bool> _requestPermission(List<Permission>? permissions) async {
    Map<Permission, PermissionStatus> statuses = {};
    try {
      if (permissions == null) {
        final deviceInfo = await DeviceInfoPlugin().androidInfo;
        if (deviceInfo.version.sdkInt > 32) {
          statuses = await [
            Permission.location,
            Permission.camera,
            Permission.photos,
          ].request();
        } else {
          statuses = await [
            Permission.location,
            Permission.camera,
            Permission.storage
          ].request();
        }
      } else {
        statuses = await permissions.request();
      }
    } on PlatformException catch (ex) {
      LogUtil.logPrint('platformException', ex.toString());
    }
    bool permitted = true;
    statuses.forEach((permission, status) {
      if (status.isDenied) _requestPermission(permissions);
      if (!status.isGranted) permitted = false;
    });
    return permitted;
  }

  Future<bool> requestPermission(
      {Function? onPermissionDenied, List<Permission>? permission}) async {
    bool isGranted = await _requestPermission(permission);
    if (!isGranted) {
      onPermissionDenied!();
    }
    return isGranted;
  }

  static Future<bool> hasLocationPermission() async {
    return _hasPermission(Permission.location);
  }

  static Future<bool> hasCameraPermission() async {
    return _hasPermission(Permission.camera);
  }

  static Future<bool> hasStoragePermission() async {
    return _hasPermission(Permission.storage);
  }

  static Future<bool> _hasPermission(Permission permission) async {
    PermissionStatus permissionStatus = await permission.status;
    return permissionStatus == PermissionStatus.granted;
  }

  Future<bool> hasPermissions() async {
    List<Permission> permissionList = [
      Permission.camera,
      Permission.photos,
      Permission.location
    ];
    for (var permission in permissionList) {
      PermissionStatus permissionStatus = await permission.status;
      if (permissionStatus != PermissionStatus.granted) {
        return false;
      }
    }
    return true;
  }
}
