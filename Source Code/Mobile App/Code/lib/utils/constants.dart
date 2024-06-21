import 'package:flutter/material.dart';

class Constants {
  static const String checkInternetConnection =
      'Unable to connect. Please check your Internet Connection';

  static const String prefLoginId = 'pref.login_id';
  static const String prefUserId = 'pref.user_id';
  static const String prefUserName = 'pref.user_name';
  static const String prefUserEmail = 'pref.user_email';
  static const String prefUserMobileNo = 'pref.user_mobile_no';
  static const String prefAlternateContactNo = 'pref.alternate_contact_number';
  static const String prefPassword = 'pref.password';
  static const String prefRoleId = 'pref.role_id';
  static const String prefRoleCode = 'pref.role_code';
  static const String prefRoleName = 'pref.role_name';
  static const String prefIsSupervisor = 'pref.is_supervisor';
  static const String prefAccessToken = 'pref.access_token';
  static const String prefRefreshToken = 'pref.refresh_token';
  static const String prefExpirationTime = 'pref.expiration_time';
  static const String prefIpAddress = 'pref.ipAddress';
  static const String prefPort = 'pref.port';

  static const String clientImageUrl = '';
  static const String serialNo = 'Serial No.';
  static const String assetType = 'Asset Type';
  static const String assetTagNo = 'Asset Tag No.';
  static const String status = 'Status';
  static const String assetName = 'Asset Name';
  static const String parentAssetname = 'Parent Asset Name';
  static const String siteID = 'Site ID';
  static const String parentAssetName = 'Parent Asset Name';
  static const String parentSerialNumber = 'Parent Serial No.';
  static const String parentAssetType = 'Parent Asset Type';
  static const String siteAddress = 'Site Address';
  static const String remarks = 'Remarks';
  static const String dynamicAttributes = 'Dynamic Attributes';
  static const String siteName = 'Site Name';
  static const String editDynamicAttributes = 'Edit Dynamic Attributes';
}

const defaultDateFormat = 'yyyy-MM-dd';
const locationPermissionMessage =
    'This app needs location permission, Go to App Settings->Permissions and enable it.';
const pleaseAllowLocationPermission = 'Please allow location permission';
const viewMap = 'View Map';
const uploadPhotoOrVideo = 'Upload photos/videos';
const String checkInternetConnection =
    'Unable to connect. Please check your Internet Connection';
const pleaseWait = 'Please wait...';
const String assetFoundInOtherSite =
    'This asset found in another site. Do you want to transer to this site?';
const String assetFoundInOtherSiteAsChild =
    'This is a child of another site\'s asset. Do you want to transer this to parent asset of this site?';
const String assetFoundInOtherSiteAsParent =
    'This is a parent of another site\'s child asset. Do you want to transer this to child asset of this site?';
const pleaseEnterDescription = 'Please enter description';
const addAssetDraftTitle = 'Confirm action';
const addAssetDraftDesc = 'Do you want to save the changes as draft and exit?';
const selectRadius = 'Select Radius';
const selectSite = 'Select Site';
const viewAll = 'View All';
const searchAnySites = 'Search any site...';
const searchSites = 'Search Sites';
const failedToInitialiseApp = 'Failed to initialise app';
const initialDistance = 40.0;
const kPrimaryColor = Color(0xff303D8B);
final kSecondaryColor = Colors.blue.shade100;
const scaffoldBackgroundColor = const Color(0xffE6EBFF);
const white = const Color(0xffFFFFFF);
const bgColor = Color.fromARGB(255, 242, 242, 242);

const labelTextColor = Color.fromARGB(255, 43, 43, 43);
const grey = Color.fromARGB(255, 125, 125, 125);
const kToastSuccessColor = Color(0xFF8BC34A);
const kToastInfoColor = Color(0xFF2196F3);
const kToastErrorColor = Color(0xFFF44336);
const SUCCESS_RESPONSE_CODE = 200;
const TIME_OUT_DURATION_IN_SECONDS = 600;

const int SINGLE_ASSET_TYPE_ID = 2;
const int ASSET_TYPE_ATTR = 3;
const int ATTR_MASTER = 4;
const int ASSET_ATTRIBUTE = 5;
const int ASSET_TYPE = 6;
const int COMMON_APP_META_DATA = 7;

const double appCardCurve = 5.0;
