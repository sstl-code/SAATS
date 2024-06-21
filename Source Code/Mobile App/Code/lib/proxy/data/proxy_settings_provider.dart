import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/proxy/custom_proxy.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';

class ProxySettingsProvider extends ChangeNotifier {
  TextEditingController ipAddress = TextEditingController();
  TextEditingController port = TextEditingController();
  final SessionManager _session = locator.get<SessionManager>();

  Future setProxySettings() async {
    _session.setProxyIpAddress(ipAddress.text);
    _session.setProxyPort(port.text);

    if (!kReleaseMode) {
      final proxyIpAddress = locator.get<SessionManager>().getProxyIpAddress();
      final proxyPort = locator.get<SessionManager>().getProxyPort();

      if (proxyIpAddress != null &&
          proxyIpAddress.isNotEmpty &&
          proxyPort != null &&
          proxyPort.isNotEmpty) {
        final proxy =
            CustomProxy(ipAddress: proxyIpAddress, port: int.parse(proxyPort));
        proxy.enable();
      }

      print('proxy address and port :${proxyIpAddress}--${proxyPort}');
    }
  }

  void setProxyFromSessionManager() {
    if (!kReleaseMode) {
      ipAddress.text = locator.get<SessionManager>().getProxyIpAddress() ?? '';
      port.text = locator.get<SessionManager>().getProxyPort() ?? '';
    }
  }
}
