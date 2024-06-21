import 'dart:async';
import 'dart:convert';

import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/repository/location_service.dart';
import 'package:ats_system/screens/home/data/home_repository.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:flutter/material.dart';
import 'package:location/location.dart';

class HomeProvider extends ChangeNotifier {
  final _homeService = locator.get<HomeRepository>();
  final _session = locator.get<SessionManager>();
  final _location = locator.get<LocationService>();
  List<SiteData> mySiteList = [];
  List<SiteData> homeNearBySiteList = [];
  List<SiteData> globalSiteList = [];
  String dataFound = '';
  LocationData? data;
  bool isMySiteLoading = false,
      isHomeNearSiteLoading = false,
      isGlobalSearchLoading = false,
      isMailLoading = false;
  SiteData? selectedSite;
  int taskCount = 0;

  void mailLoading(bool val) {
    isMailLoading = val;
    notifyListeners();
  }

  void setGlobalLoading(bool val) {
    isGlobalSearchLoading = val;
    notifyListeners();
  }

  void setMySiteLoading(bool val) {
    isMySiteLoading = val;
    notifyListeners();
  }

  void setHomeNearSiteLoading(bool val) {
    isHomeNearSiteLoading = val;
    notifyListeners();
  }

  void setTaskCount(int val) {
    taskCount = val;
    notifyListeners();
  }

  void globalSearch(String filter) async {
    await CommonMethods.isAuthKeyExpired();
    setGlobalLoading(true);
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.globalSearchUrl,
        urlName: 'globalSearch',
        params: {'search': filter},
        headers: header);
    _homeService.globalSearch(request).then((response) {
      globalSiteList = response;
      dataFound = globalSiteList.isNotEmpty ? '' : Strings.dataNotFound;
      notifyListeners();
    }).whenComplete(() => setGlobalLoading(false));
  }

  void fetchSites() async {
    setMySiteLoading(true);

    await CommonMethods.isAuthKeyExpired();
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    _homeService
        .fetchMySites(CustomRequest(
            url: Urls.mySitesUrl,
            urlName: 'mySite',
            body: jsonEncode({
              "user_id": _session.getUserId(),
              "role": _session.getRoleId()
            }),
            headers: header))
        .then((response) {
      mySiteList = response;
    }).whenComplete(() => setMySiteLoading(false));
  }

  void fetchHomeNearBySites(String distance) async {
    data = await _location.getUserLocation();
    setHomeNearSiteLoading(true);

    await CommonMethods.isAuthKeyExpired();
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };

    var map = {
      'lat': data?.latitude,
      'lng': data?.longitude,
      "radius": distance
    };
    _homeService
        .fetchNearBySites(CustomRequest(
            url: Urls.nearBySitesUrl,
            urlName: 'nearBySite',
            body: jsonEncode(map),
            headers: header))
        .then((response) {
      homeNearBySiteList = response;
      dataFound = homeNearBySiteList.isNotEmpty ? '' : Strings.dataNotFound;
    }).whenComplete(() => setHomeNearSiteLoading(false));
  }

  Future<CustomResponse> sendMail(String notificationType,
      {int? location, int? assetId}) async {
    await CommonMethods.isAuthKeyExpired();
    mailLoading(true);
    data = await _location.getUserLocation();
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    var map = {
      "user_id": _session.getUserId(),
      "notification_type": notificationType,
      'location': location,
      'asset_id': assetId
    };
    return _homeService
        .sendMail(CustomRequest(
            url: Urls.sendMailUrl,
            urlName: 'sendMail',
            body: jsonEncode(map),
            headers: header))
        .whenComplete(() => mailLoading(false));
  }

  void clearHome() {
    globalSiteList = [];
    mySiteList = [];
    homeNearBySiteList = [];
    isMySiteLoading = false;
    dataFound = '';
  }

  void clearGlobalSearchList() {
    globalSiteList = [];
    isGlobalSearchLoading = false;
    dataFound = '';
  }
}
