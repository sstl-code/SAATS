import 'dart:developer';

import 'package:flutter/foundation.dart';

class LogUtil {
  static void logPrint(var title, var msg) {
    if (kDebugMode) {
      log('$title: $msg');
    }
  }
}
