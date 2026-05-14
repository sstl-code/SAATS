import 'dart:io';

import 'package:ats_system/utils/strings.dart';
import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';

checkPermission(
    {required Function onPermissionGranted,
    required Function onPermissionDenied,
    required Function onPermissionDeniedPermenanty,
    required Permission permission}) async {
  PermissionStatus status = await permission.request();

  if (status == PermissionStatus.granted) {
    onPermissionGranted();
  } else if (status == PermissionStatus.denied) {
    onPermissionDenied();
  } else if (status == PermissionStatus.permanentlyDenied) {
    onPermissionDeniedPermenanty();
  }
}

Future<int> checkPermissionStats({required Permission permission}) async {
  PermissionStatus status = await permission.request();

  if (status == PermissionStatus.granted) {
    return 1;
  } else if (status == PermissionStatus.denied) {
    return 2;
  } else if (status == PermissionStatus.permanentlyDenied) {
    return 3;
  }

  return 0;
}

void showPermissionRequiredDialog(
    BuildContext context, String locationPermissionMessage) {
  showDialog(
      context: context,
      builder: (BuildContext context) => AlertDialog(
            title: const Text(Strings.permissionNeeded),
            content: Text(locationPermissionMessage),
            actions: [
              TextButton(
                  child: const Text(Strings.closeApp),
                  onPressed: () => exit(0)),
              TextButton(
                  child: const Text(Strings.appSettings),
                  onPressed: () {
                    openAppSettings();
                    Navigator.pop(context);
                  })
            ],
          ));
}
