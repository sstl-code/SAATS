import 'dart:convert';
import 'dart:io';

import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/custom_attributes.dart';
import 'package:ats_system/models/image_response.dart';
import 'package:ats_system/repository/location_service.dart';
import 'package:ats_system/repository/navigation_service.dart';
import 'package:ats_system/screens/add_asset/data/add_asset_repository.dart';
import 'package:ats_system/screens/add_asset/models/add_asset_request_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_details/data/asset_repository.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:get_it/get_it.dart';
import 'package:intl/intl.dart';

class AssetDetailsProvider extends ChangeNotifier {
  final _service = locator.get<AssetDetailsService>();
  final _session = locator.get<SessionManager>();
  final _addAssetService = locator.get<AddAssetService>();

  SingleAssetModel? singleAssetModel, forChildSingleAssetModel;
  Map<String, List<AssetDataModel>> map = {};
  Map<String, List<AssetDataModel>> activeMap = {};
  bool isAssetDetailsLoading = false;
  bool isAssetLoading = false;
  bool isAssetTagLoading = false;
  bool isAssetUpdating = false;
  Color color = Colors.transparent;

  List<Operator> operatorList = [];
  Operator? operator;
  List<CustomAttributes> statList = [];
  List<CustomAttributes> dynaList = [];
  List<CustomAttributes> editStatList = [];
  List<CustomAttributes> editDynaList = [];
  Map<String, TextEditingController> statControllers = {};
  List<TextEditingController> dynaControllers = [];
  List<String?> statErrors = [];
  List<String?> dynaErrors = [];

  List<AssetAttribute> attributeList = [];
  String? status, parentAssetName;
  Map<String, String?> flovValueList = {};
  TextEditingController assetNameController = TextEditingController();
  File? imageFile;
  String? qrCode;

  setAssetName() {
    assetNameController.text = singleAssetModel?.data?.taAssetName ?? '';
  }

  void initializeAssetPage(int assetId, int masterId, bool isFromParent) async {
    isAssetTagLoading = false;
    setAssetLoading(true);

    if (!await CommonMethods.isAuthKeyExpired()) {
      Future.wait([
        getAttributes(masterId),
        getSingleAssetDetails(assetId, isFromParent)
      ]).then((responses) {
        final a = responses.elementAt(0) as AttributeModel;
        final m = responses.elementAt(1) as SingleAssetModel;
        if (m.data == null) return;

        if (a.assetType?.isNotEmpty == true) {
          attributeList = a.assetType!;
        }
        if (m.data?.taAssetCatagory?.toUpperCase() == "ACTIVE" &&
            a.operators?.isNotEmpty == true) {
          operatorList = a.operators!;

          operator = operatorList.firstWhere(
            (e) => e.operatorId == m.data?.operatorId,
            orElse: () => Operator(operatorId: 0, operatorName: "Default"),
          );
        }
        singleAssetModel = m;

        setStaticList(m, isFromParent);
      }).whenComplete(() => setAssetLoading(false));
    }
  }

  void setFlovValue(String key, String value) {
    flovValueList[key] = value;
    notifyListeners();
  }

  Future<AttributeModel?> getAttributes(int assetTypeId) async {
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
        .then((value) => value);
  }

  void setStaticList(SingleAssetModel model, bool isFromParent) {
    final data = model.data;
    if (data == null) return;
    List<AssetTypeAttr?> typeAttrs = data.typeAttr!;
    statList = [];
    dynaList = [];
    editStatList = [];
    editDynaList = [];
    statControllers = {};
    dynaControllers = [];
    statErrors = [];
    dynaErrors = [];
    statList.add(CustomAttributes(
        key: 'Serial No.',
        value: data.taAssetManufactureSerialNo ?? '',
        isMandate: true));
    statList.add(CustomAttributes(
        key: Constants.assetTagNo,
        value: data.taAssetTagNumber ?? '',
        isMandate: true));
    statList.add(
        CustomAttributes(key: 'Asset Name', value: data.taAssetName ?? ''));
    if (data.taAssetCatagory?.toUpperCase() == "ACTIVE") {
      statList
          .add(CustomAttributes(key: 'Operator', value: data.operators ?? ''));
    }
    statList.add(CustomAttributes(
        key: 'Parent Asset Name',
        value: data.taAssetParentId == null
            ? '-'
            : data.taAssetParentId == 0
                ? '-'
                : data.parentAssetName.toString()));

    for (var v in attributeList) {
      var e = typeAttrs.firstWhere(
          (element) => element!.atAssetTypeAttributeMasterId == v.attributeId,
          orElse: () => AssetTypeAttr(typeAttrMaster: AttrMaster()));
      var master = e?.typeAttrMaster;
      if (v.display?.trim().toLowerCase() == 'yes') {
        var c = CustomAttributes(
            key: master?.ataAssetTypeAttributeName ?? v.attributeName,
            value: e?.atAssetAttributeValueText,
            datatype: v.attributeDatatype ?? '',
            isMandate: v.requieredNotRequiredFlag?.toLowerCase() == 'no',
            attributeId: v.attributeId.toString());

        statControllers[v.attributeName.trim()] =
            TextEditingController(text: c.value ?? '');
        if (v.attributeDatatype == 'FLoV') {
          flovValueList[v.attributeName.trim()] = c.value;
        }
        if (v.attributeCatagory == 0) {
          statList.add(c);
          editStatList.add(c);
          statErrors.add(null);
        } else {
          dynaList.add(c);
          editDynaList.add(c);
          dynaControllers.add(TextEditingController(text: c.value));
          dynaErrors.add(null);
        }
      }
    }

    notifyListeners();
  }

  void setLoading(bool value) {
    isAssetDetailsLoading = value;
    notifyListeners();
  }

  void setAssetTagLoading(bool value) {
    isAssetTagLoading = value;
    notifyListeners();
  }

  void setAssetLoading(bool value) {
    isAssetLoading = value;
    notifyListeners();
  }

  void setSingleAssetModel(SingleAssetModel? v) {
    singleAssetModel = v;
    notifyListeners();
  }

  void clearAllData() {
    singleAssetModel = null;
    map = {};
    isAssetDetailsLoading = false;
    isAssetLoading = false;
    isAssetTagLoading = false;
    color = Colors.transparent;
  }

  Map<String, List<AssetDataModel>> _calc(List<AssetDataModel> response) {
    Map<String, List<AssetDataModel>> map = {};
    for (var v in response) {
      if (map.containsKey(v.assetTypeName)) {
        map[v.assetTypeName]?.add(v);
      } else {
        map.putIfAbsent(v.assetTypeName ?? '', () => [v]);
      }
    }
    return map;
  }

  void getAssetList(int locationId) async {
    if (await CommonMethods.isAuthKeyExpired()) return;
    setLoading(true);
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: '${Urls.assetListUrl}$locationId',
        urlName: 'assetList',
        headers: header);
    _service.fetchAssetList(request).then((List<AssetDataModel> response) {
      List<AssetDataModel> actList =
          response.where((e) => e.category?.toLowerCase() == 'active').toList();
      List<AssetDataModel> passiveList = response
          .where((e) => e.category?.toLowerCase() == 'passive')
          .toList();
      map.clear();
      activeMap.clear();
      int count = 0;
      int total = response.length;
      map = _calc(passiveList);
      activeMap = _calc(actList);
      for (var v in response) {
        if (v.parentTag != null) count++;
      }
      double percent = (count * 100) / total;
      if (percent == 100) {
        color = Colors.green;
      } else if (percent < 100 && percent >= 50) {
        color = Colors.orange;
      } else {
        color = Colors.red;
      }
      setLoading(false);
    });
  }

  Future<SingleAssetModel> getSingleAssetDetails(
      int assetId, bool isFromParent) async {
    await CommonMethods.isAuthKeyExpired();
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: '${Urls.singleAssetDetailsUrl}/$assetId',
        urlName: 'singleAssetDetails',
        headers: header);
    return _service.fetchSingleAssetDetails(request).then((response) {
      return response;
    });
  }

  Future<ImageResponse> newImageUpload(
      int assetId, String? tagNo, File? file) async {
    var data = await locator.get<LocationService>().getUserLocation();
    setAssetTagLoading(true);

    await CommonMethods.isAuthKeyExpired();

    Map<String, String> fields = {
      "modified_by": _session.getUserName()!,
      "asset_id": assetId.toString(),
      "tag_number": tagNo.toString(),
      "latitude": data.latitude.toString(),
      "longitude": data.longitude.toString(),
      "location_id": GetIt.I<NavigationService>()
              .getContext()
              .read<HomeProvider>()
              .selectedSite
              ?.tlLocationId
              .toString() ??
          ''
    };
    List<Map<String, String>> filesList = [];

    if (file != null) {
      if (file.existsSync()) {
        filesList.add({'asset_img': file.path});
      }
    }

    var map = {"fields": fields, "files": filesList};
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.imageUploadUrl,
        urlName: 'imageUpload',
        multiPart: map,
        headers: header);
    return _service
        .imageUpload(request)
        .whenComplete(() => setAssetTagLoading(false));
  }

  Future<bool> validateDynamicAttributes(
      List<AssetAttribute> assetAttributes) async {
    bool isValidated = true;
    for (var a in assetAttributes) {
      if (a.display?.toUpperCase() == 'YES' &&
          a.requieredNotRequiredFlag?.toUpperCase() == 'YES' &&
          a.editableNonEditableFlag?.toUpperCase() == 'YES') {
        if (a.attributeDatatype == 'FLoV') {
          if (flovValueList[a.attributeName] == null) {
            ToastMessage.showMessage(
                "Please select ${a.attributeName}.", kToastErrorColor);
            isValidated = false;
            break;
          }
        } else {
          if (statControllers[a.attributeName]!.text.isEmpty) {
            ToastMessage.showMessage(
                "Please enter ${a.attributeName}.", kToastErrorColor);
            isValidated = false;
            break;
          }
        }
      }
    }

    return isValidated;
  }

  Future<AddAssetRequestModel> getUpdateDynamicAttributesModel(
      List<AssetAttribute> assetAttributes) async {
    final data = singleAssetModel!.data!;
    AddAssetRequestModel model = AddAssetRequestModel();
    model.taAssetTypeMasterId = data.taAssetTypeMasterId;
    model.assetTagNumber = qrCode ?? data.taAssetTagNumber;
    model.assetCatagory = data.taAssetCatagory;
    model.assetActiveInactiveStatus = data.taAssetActiveInactiveStatus;
    model.assetParentId = data.taAssetParentId;
    model.operatorId = operator?.operatorId;
    model.assetTypeName = data.assetType;
    model.manufactureSerialNo = data.taAssetManufactureSerialNo;
    model.assetName = assetNameController.text.isEmpty
        ? data.taAssetName
        : assetNameController.text;
    model.userId = locator.get<SessionManager>().getUserId();
    model.locationId = GetIt.I<NavigationService>()
        .getContext()
        .read<HomeProvider>()
        .selectedSite
        ?.tlLocationId;
    model.attributes = assetAttributes
        .map((e) => Attribute(
              attrMasterId: e.attributeId,
              attributeName: e.attributeName,
              attributeValue: e.attributeDatatype == 'FLoV'
                  ? flovValueList[e.attributeName]
                  : statControllers[e.attributeName]?.text,
            ))
        .toList();

    return model;
  }

  Future<ResponseModel> editAsset(AddAssetRequestModel model) async {
    var data = await locator.get<LocationService>().getUserLocation();
    model.latitude = data.latitude;
    model.longitude = data.longitude;

    setAssetUpdating(true);

    await CommonMethods.isAuthKeyExpired();

    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };

    CustomRequest request = CustomRequest(
        url: Urls.editAssetUrl,
        urlName: 'editAsset',
        body: jsonEncode(model),
        headers: header);
    return await _service.editAsset(request);
  }

  void setAssetUpdating(bool value) {
    isAssetUpdating = value;
    notifyListeners();
  }

  void selectDate(BuildContext context, TextEditingController controller) {
    showDatePicker(
            context: context,
            initialDate: DateTime.now(),
            firstDate: DateTime(2000),
            lastDate: DateTime.now().add(const Duration(days: 18300)))
        .then((date) {
      if (date == null) return;
      controller.text = DateFormat(defaultDateFormat).format(date);
      notifyListeners();
    });
  }

  setImageFile(File imageFile) {
    this.imageFile = imageFile;
  }

  setQrCode(String qrCode) {
    this.qrCode = qrCode;
    notifyListeners();
  }

  clearTagging() {
    this.imageFile = null;
    this.qrCode = null;
    notifyListeners();
  }

  clearImage() {
    this.imageFile = null;
  }
}
