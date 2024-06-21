import 'dart:async';
import 'dart:io';

import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/auth/data/login_repository.dart';
import 'package:ats_system/screens/auth/login_page.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:image_picker/image_picker.dart';

class CommonMethods {
  static final _session = locator.get<SessionManager>();

  static Future<bool> isAuthKeyExpired() async {
    DateTime expiration = DateTime.parse(_session.expirationTime);
    if (DateTime.now().compareTo(expiration) > -1) {
      return await locator.get<LoginApiService>().refreshToken();
    } else {
      return false;
    }
  }

  static void gotoLogin(BuildContext context) async {
    _session.clearPref();

    Navigator.pushNamedAndRemoveUntil(
        context, LoginPage.routeName, (route) => false);
  }

  static Future<File?> pickImage() async {
    try {
      XFile? pickedImage = await ImagePicker()
          .pickImage(source: ImageSource.camera, imageQuality: 50);
      if (pickedImage == null) return null;
      File file = File(pickedImage.path);
      return file;
    } on PlatformException catch (e) {
      if (e.code == 'photo_access_denied') {
        ToastMessage.showMessage(
            'Please grant user\'s photo permission', kToastInfoColor);
      }
      if (e.code == 'PERMISSION_DENIED_NEVER_ASK') {
        ToastMessage.showMessage(
            'Permission denied, please enable it from app settings',
            kToastInfoColor);
      }
    }
    return null;
  }
}
