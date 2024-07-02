class Urls {
 //hostname
  static const String hostName = "http://115.113.197.12:86";
 //baseURL
  static const String baseUrl = "$hostName/public/api";
 // Login
  static const String loginUrl = "$baseUrl/login";
  static const String changePasswordUrl = "$baseUrl/changepassword";
  static const String refreshTokenUrl = "$baseUrl/refreshtoken_login";

  // Home
  static const String nearBySitesUrl = "$baseUrl/near_site";
  static const String mySitesUrl = "$baseUrl/my_sites";
  static const String globalSearchUrl = "$baseUrl/global_search_home";
  static const String sendMailUrl = "$baseUrl/notification_mail";

  // Asset Details
  static const String assetListUrl = "$baseUrl/assets_list_location_wise/";
  static const String singleAssetDetailsUrl = "$baseUrl/single_asset_details";
  static const String imageUploadUrl = "$baseUrl/asset_tagging";
  static const String editAssetUrl = "$baseUrl/edit_asset";
  static const String serialNoUrl = "$baseUrl/fetch_asset_by_serialno";

  // Add asset
  static const String assetTypeUrl = "$baseUrl/asset_type";
  static const String assetTypeAttrUrl = "$baseUrl/asset_type_attr";
  static const String addAssetUrl = "$baseUrl/add_asset";

  // My Task
  static const String myTaskList = "$baseUrl/get_task_list_by_location";
  static const String updateSRNUrl = "$baseUrl/update_srn";
  static const String updateSTNUrl = "$baseUrl/update_stn";

  // Asset Audit
  static const String submitAssetAuditUrl = '$baseUrl/audit_submit';

  // Upload Site Media
  static const String uploadSiteMedia = '$baseUrl/upload_site_media';
}
