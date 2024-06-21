import 'dart:async';

import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/session_management/session_config.dart';
import 'package:ats_system/utils/session_management/session_timeout_manager.dart';
import 'package:flutter/material.dart';

class MainProvider extends ChangeNotifier {
  final sessionStateStream = StreamController<SessionState>();
  final sessionConfig = SessionConfig(
    invalidateSessionForAppLostFocus:
        const Duration(seconds: TIME_OUT_DURATION_IN_SECONDS),
    invalidateSessionForUserInactivity:
        const Duration(seconds: TIME_OUT_DURATION_IN_SECONDS),
  );

  bool sessionTimeOut = false;

  void sessionTimeoutState(bool sessionTimeOut) {
    this.sessionTimeOut = sessionTimeOut;
    if (sessionTimeOut) {
      sessionStateStream.add(SessionState.startListening);
    } else {
      sessionStateStream.add(SessionState.stopListening);
    }
  }
}
