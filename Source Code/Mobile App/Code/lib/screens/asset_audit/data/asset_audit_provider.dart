import 'dart:convert';

import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/custom_attributes.dart';
import 'package:ats_system/screens/add_asset/data/add_asset_repository.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_audit/data/asset_audit_repository.dart';
import 'package:ats_system/screens/asset_details/data/asset_repository.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/log_util.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:flutter/material.dart';

class AssetAuditProvider extends ChangeNotifier {
  final _service = locator.get<AssetAuditService>();
  final _assetService = locator.get<AssetDetailsService>();
  final _assetDetailsService = locator.get<AssetDetailsService>();
  final _addAssetService = locator.get<AddAssetService>();
  final _session = locator.get<SessionManager>();

  bool isLoading = false,
      isAssetDetailsLoading = false,
      isChildSubmitted = false,
      isParentSubmitted = false;
  SingleAssetModel? singleAssetModel, childSingleAssetModel;
  int? selectedLocationCode;
  List<CustomAttributes> statList = [];
  List<CustomAttributes> statChildList = [];
  List<CustomAttributes> dynaList = [];
  List<CustomAttributes> dynaChildList = [];
  List<AssetDataModel> passiveList = [];
  List<AssetDataModel> actList = [];
  List<AssetDataModel> allDataList = [];
  List<AssetAttribute> attributeList = [];
  List<AssetAttribute> childAttributeList = [];

  void initializeAssetAudit(int locationCode) {
    selectedLocationCode = locationCode;
    isLoading = false;
    isParentSubmitted = false;
    getAssetAudit(selectedLocationCode!);
  }

  void initializeAssetDetails(AssetDataModel data, bool isFromParent) {
    isAssetDetailsLoading = false;
    singleAssetModel = null;
    statList = [];
    dynaList = [];
    Future.wait([
      getAttributes(data.masterId!),
      getAssetAuditDetails(data.taAssetId, isFromParent)
    ]).then((values) {
      if (isFromParent) {
        attributeList = values[0] as List<AssetAttribute>;
        singleAssetModel = values[1] as SingleAssetModel?;
        setAuditDetails(singleAssetModel, isFromParent);
      } else {
        childAttributeList = values[0] as List<AssetAttribute>;
        childSingleAssetModel = values[1] as SingleAssetModel?;
        setAuditDetails(childSingleAssetModel, isFromParent);
      }
    });
  }

  void setAssetDetailsLoading(bool val) {
    isAssetDetailsLoading = val;
    notifyListeners();
  }

  void setLoading(bool val) {
    isLoading = val;
    notifyListeners();
  }

  Future<List<AssetAttribute>> getAttributes(int assetTypeId) async {
    await CommonMethods.isAuthKeyExpired();
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.assetTypeAttrUrl,
        urlName: 'assetTypeAttr',
        body: jsonEncode({"asset_type_id": assetTypeId}),
        headers: header);
    return _addAssetService
        .getAssetTypeAttributes(request)
        .then((value) => value.assetType ?? []);
  }

  void setAuditDetails(SingleAssetModel? model, bool isFromParent) {
    if (model?.status == SUCCESS_RESPONSE_CODE) {
      try {
        if (isFromParent) {
          singleAssetModel = model;
          final data = singleAssetModel!.data;
          List<AssetTypeAttr?> typeAttrs = data!.typeAttr!;
          statList = [];
          dynaList = [];
          statList.add(CustomAttributes(
              key: 'Serial No.',
              value: data.taAssetManufactureSerialNo ?? '',
              isMandate: true));
          statList.add(CustomAttributes(
              key: Constants.assetTagNo,
              value: data.taAssetTagNumber ?? '',
              isMandate: true));
          statList.add(CustomAttributes(
              key: 'Asset Name', value: data.taAssetName ?? ''));
          statList.add(CustomAttributes(
              key: 'Parent Asset Name',
              value: data.taAssetParentId == null
                  ? '-'
                  : data.taAssetParentId == 0
                      ? '-'
                      : data.taAssetParentId.toString()));
          for (var v in attributeList) {
            var e = typeAttrs.firstWhere(
                (element) =>
                    element!.atAssetTypeAttributeMasterId == v.attributeId,
                orElse: () => AssetTypeAttr(typeAttrMaster: AttrMaster()));
            var master = e?.typeAttrMaster;
            if (v.display?.trim().toLowerCase() == 'yes') {
              var c = CustomAttributes(
                  key: master?.ataAssetTypeAttributeName ?? v.attributeName,
                  value: e?.atAssetAttributeValueText ?? '',
                  datatype: v.attributeDatatype ?? '',
                  isMandate: v.requieredNotRequiredFlag?.toLowerCase() == 'no',
                  attributeId: v.attributeId.toString());
              if (v.attributeCatagory == 0) {
                statList.add(c);
              } else {
                dynaList.add(c);
              }
            }
          }
        } else {
          childSingleAssetModel = model;
          final data = childSingleAssetModel!.data;
          List<AssetTypeAttr?> typeAttrs = data!.typeAttr!;
          statChildList = [];
          dynaChildList = [];
          statChildList.add(CustomAttributes(
              key: 'Serial No.',
              value: data.taAssetManufactureSerialNo ?? '',
              isMandate: true));
          statChildList.add(CustomAttributes(
              key: Constants.assetTagNo,
              value: data.taAssetTagNumber ?? '',
              isMandate: true));
          statChildList.add(CustomAttributes(
              key: 'Asset Name', value: data.taAssetName ?? ''));
          statChildList.add(CustomAttributes(
              key: 'Parent Asset Name',
              value: data.taAssetParentId == null
                  ? '-'
                  : data.taAssetParentId == 0
                      ? '-'
                      : data.taAssetParentId.toString()));
          for (var v in childAttributeList) {
            var e = typeAttrs.firstWhere(
                (element) =>
                    element!.atAssetTypeAttributeMasterId == v.attributeId,
                orElse: () => AssetTypeAttr(typeAttrMaster: AttrMaster()));
            var master = e?.typeAttrMaster;
            if (v.display?.trim().toLowerCase() == 'yes') {
              var c = CustomAttributes(
                  key: master?.ataAssetTypeAttributeName ?? v.attributeName,
                  value: e?.atAssetAttributeValueText ?? '',
                  datatype: v.attributeDatatype ?? '',
                  isMandate: v.requieredNotRequiredFlag?.toLowerCase() == 'no',
                  attributeId: v.attributeId.toString());
              if (v.attributeCatagory == 0) {
                statChildList.add(c);
              } else {
                dynaChildList.add(c);
              }
            }
          }
        }
      } catch (e) {
        LogUtil.logPrint('exception', e);
      }
    }
    notifyListeners();
  }

  void childSubmit(int assetId, BuildContext context) {
    int count = 0;
    final children = allDataList
        .firstWhere((element) => element.taAssetId == assetId)
        .childs;
    count =
        children.where((element) => element.isAudited == 'Y').toList().length;

    if (count == children.length) {
      allDataList.firstWhere((a) => assetId == a.taAssetId).childEdited = 'Y';
      final audit = allDataList.firstWhere((a) => assetId == a.taAssetId);
      audit.isAudited =
          audit.isAudited == 'N' || audit.isAudited == 'O' ? 'O' : 'Y';
      allDataList.firstWhere((a) => assetId == a.taAssetId).isAudited =
          audit.isAudited;
      isChildSubmitted = true;
      Future.delayed(
          const Duration(milliseconds: 200), () => Navigator.pop(context));
    }
    if (count > 0) {
      allDataList.firstWhere((a) => assetId == a.taAssetId).childEdited = 'Y';
      final audit = allDataList.firstWhere((a) => assetId == a.taAssetId);
      audit.isAudited =
          audit.isAudited == 'N' || audit.isAudited == 'O' ? 'O' : 'Y';
      allDataList.firstWhere((a) => assetId == a.taAssetId).isAudited =
          audit.isAudited;
    } else {
      ToastMessage.showMessage(
          'Please audit all the assets.', kToastErrorColor);
    }
    notifyListeners();
  }

  void _assetStatus(String type, int assetId) {
    if (tagMissing.contains(assetId)) tagMissing.remove(assetId);
    if (assetMissing.contains(assetId)) assetMissing.remove(assetId);
    if (matched.contains(assetId)) matched.remove(assetId);

    switch (type) {
      case 'tagMissing':
        tagMissing.add(assetId);
        break;
      case 'assetMissing':
        assetMissing.add(assetId);
        break;
      case 'unmatched':
        matched.add(assetId);
        break;
      default:
        matched.add(assetId);
    }
  }

  void updateChildAuditList(String type, int parentAssetId,
      {required int assetId}) {
    _assetStatus(type, assetId);
    allDataList
        .firstWhere((element) => element.taAssetId == parentAssetId)
        .childs
        .firstWhere((child) => child.taAssetId == assetId)
        .isAudited = 'Y';
    setDataOnTabs();
    notifyListeners();
  }

  void updateAuditList(int assetId, String type) {
    allDataList
        .firstWhere((AssetDataModel element) => element.taAssetId == assetId)
        .isAudited = 'Y';
    var a = allDataList.firstWhere((element) => element.taAssetId == assetId);

    _assetStatus(type, assetId);
    a.isAudited = a.isAudited == 'N'
        ? a.childs.isNotEmpty
            ? a.childEdited == 'Y'
                ? 'Y'
                : 'O'
            : 'Y'
        : 'Y';

    allDataList[
        allDataList.indexWhere((element) => element.taAssetId == assetId)] = a;
    notifyListeners();
  }

  void setDataOnTabs() {
    actList = allDataList
        .where((e) => e.category?.toLowerCase() == 'active')
        .toList();
    passiveList = allDataList
        .where((e) => e.category?.toLowerCase() == 'passive')
        .toList();
    setLoading(false);
  }

  void getAssetAudit(int locationCode) async {
    await CommonMethods.isAuthKeyExpired();
    setLoading(true);
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: '${Urls.assetListUrl}$locationCode',
        urlName: 'assetList',
        headers: header);
    _assetDetailsService
        .fetchAssetList(request)
        .then((List<AssetDataModel> response) {
      allDataList = response;
      setDataOnTabs();
    });
  }

  Future<SingleAssetModel> getAssetAuditDetails(
      int id, bool isFromParent) async {
    await CommonMethods.isAuthKeyExpired();
    setAssetDetailsLoading(true);
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: '${Urls.singleAssetDetailsUrl}/$id',
        urlName: 'singleAssetDetails',
        headers: header);
    return _assetService
        .fetchSingleAssetDetails(request)
        .whenComplete(() => setAssetDetailsLoading(false));
    // _service.getAssetAuditDetails(request).then((value) => setAuditDetails(value)).whenComplete(() => setAssetDetailsLoading(false));
  }

  Set<int> assetMissing = {};
  Set<int> tagMissing = {};
  Set<int> matched = {};

  Future<ResponseModel> submitAssetAudit(int locationId) async {
    var map = {
      "location_id": locationId,
      "user_id": locator.get<SessionManager>().getUserId(),
      "assetMissing": assetMissing.toList(),
      "tagMissing": tagMissing.toList(),
      "Matched": matched.toList(),
    };
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.submitAssetAuditUrl,
        urlName: 'submitAssetAudit',
        body: jsonEncode(map),
        headers: header);
    return await _service.submitAssetAudit(request);
  }
}
