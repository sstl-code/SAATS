import 'dart:convert';
import 'dart:io';

import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/custom_attributes.dart';
import 'package:ats_system/screens/add_asset/data/add_asset_repository.dart';
import 'package:ats_system/screens/add_asset/models/add_asset_request_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/task_list/data/task_repository.dart';
import 'package:ats_system/screens/task_list/enums/task_type.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/screens/task_list/models/task_model.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';

class TaskProvider extends ChangeNotifier {
  final MyTaskService _taskService = locator.get<MyTaskService>();
  final SessionManager _session = locator.get<SessionManager>();
  final _service = locator.get<AddAssetService>();
  List<Task> taskList = [];
  bool isLoading = false;
  bool isSubmitted = false, isSRNLoading = false;
  List<CustomAttributes> statList = [];
  SingleAssetModel? singleAssetModel;
  List<AssetAttribute> assetAttributes = [];
  List<AssetAttribute> statAttributes = [];
  List<AssetAttribute> dynaAttributes = [];

  List<AssetTypeAttr>? srnAssetAttributes = [];
  List<AssetTypeAttr>? srnStatAttributes = [];
  List<AssetTypeAttr>? srnDynaAttributes = [];

  Map<String, String?> flovValueList = {};
  Map<String, TextEditingController> controllers = {};

  final TextEditingController remarksController = TextEditingController();
  final TextEditingController assetNameController = TextEditingController();
  Operator? operator;
  List<Operator> operatorList = [];
  List<Map<String, String>> filesList = [];

  File? imageFile;
  String? qrCode;

  void clearData() {
    clearTagging();
    singleAssetModel = null;
    isLoading = isSubmitted = isSRNLoading = false;
    statList = [];
  }

  void setLoading(bool val) {
    isLoading = val;
    notifyListeners();
  }

  void setSubmitted(bool val) {
    isSubmitted = val;
    notifyListeners();
  }

  void setSRNLoading(bool val) {
    isSRNLoading = val;
    notifyListeners();
  }

  void setStaticList(SingleAssetModel response, TaskType taskType) async {
    assetNameController.text = response.data?.taAssetName ?? 'N/A';

    if (taskType == TaskType.stn) {
      statAttributes = assetAttributes
          .where((element) => element.attributeCatagory == 0)
          .toList();

      dynaAttributes = assetAttributes
          .where((element) => element.attributeCatagory != 0)
          .toList();

      for (var a in assetAttributes) {
        if (a.attributeDatatype == 'FLoV') {
          if (a.ataFlov != null) flovValueList[a.attributeName] = null;
        } else {
          controllers[a.attributeName] = TextEditingController();
        }
      }

      statAttributes.forEach((statAttrKey) {
        response.data?.typeAttr?.forEach((attributesValue) {
          if (attributesValue.typeAttrMaster?.attributeCategory == 0 &&
              (attributesValue.typeAttrMaster?.ataAssetTypeAttributeId ==
                  statAttrKey.attributeId)) {
            if (attributesValue.typeAttrMaster?.ataAssetTypeAttributeDatatype ==
                'FLoV') {
              flovValueList[attributesValue
                      .typeAttrMaster!.ataAssetTypeAttributeName!] =
                  attributesValue.atAssetAttributeValueText;
            } else {
              controllers[attributesValue
                      .typeAttrMaster?.ataAssetTypeAttributeName!]
                  ?.text = attributesValue.atAssetAttributeValueText!;
              flovValueList[attributesValue
                      .typeAttrMaster!.ataAssetTypeAttributeName!] =
                  attributesValue.atAssetAttributeValueText;
            }
          }
        });
      });

      dynaAttributes.forEach((statAttrKey) {
        response.data?.typeAttr?.forEach((attributesValue) {
          if (attributesValue.typeAttrMaster?.attributeCategory == 1 &&
              (attributesValue.typeAttrMaster?.ataAssetTypeAttributeId ==
                  statAttrKey.attributeId)) {
            if (attributesValue.typeAttrMaster?.ataAssetTypeAttributeDatatype ==
                'FLoV') {
              flovValueList[attributesValue
                      .typeAttrMaster!.ataAssetTypeAttributeName!] =
                  attributesValue.atAssetAttributeValueText;
            } else {
              controllers[attributesValue
                      .typeAttrMaster?.ataAssetTypeAttributeName!]
                  ?.text = attributesValue.atAssetAttributeValueText!;
              flovValueList[attributesValue
                      .typeAttrMaster!.ataAssetTypeAttributeName!] =
                  attributesValue.atAssetAttributeValueText;
            }
          }
        });
      });
    } else {
      srnStatAttributes = response.data?.typeAttr
          ?.where((element) => element.typeAttrMaster?.attributeCategory == 0)
          .toList();
      srnDynaAttributes = response.data?.typeAttr!
          .where((element) => element.typeAttrMaster?.attributeCategory != 0)
          .toList();

      var array = response.data?.typeAttr;

      for (var a in array!) {
        if (a.typeAttrMaster?.ataAssetTypeAttributeDatatype == 'FLoV') {
          if (a.typeAttrMaster?.ataFlov != null) {
            flovValueList[a.typeAttrMaster!.ataAssetTypeAttributeName!] = null;
            flovValueList[a.typeAttrMaster!.ataAssetTypeAttributeName!] =
                response.data!.typeAttr!
                    .firstWhere((element) =>
                        element.typeAttrMaster?.ataAssetTypeAttributeName ==
                        a.typeAttrMaster?.ataAssetTypeAttributeName)
                    .atAssetAttributeValueText
                    ?.trim();
          }
        } else {
          if (a.typeAttrMaster != null &&
              a.typeAttrMaster!.ataAssetTypeAttributeName != null) {
            controllers[a.typeAttrMaster!.ataAssetTypeAttributeName!] =
                TextEditingController();
            String? value = '';
            try {
              value = response.data!.typeAttr!
                  .firstWhere((element) =>
                      element.typeAttrMaster?.ataAssetTypeAttributeName
                          ?.toLowerCase() ==
                      a.typeAttrMaster?.ataAssetTypeAttributeName!
                          .toLowerCase())
                  .atAssetAttributeValueText;
            } catch (e) {
              value = '';
            }
            controllers[a.typeAttrMaster!.ataAssetTypeAttributeName!] =
                TextEditingController(text: value ?? '');
          }
        }
      }
    }

    final data = response.data;

    statList.add(CustomAttributes(
        key: 'Serial No.', value: data?.taAssetManufactureSerialNo ?? ''));
    statList.add(CustomAttributes(
        key: Constants.assetTagNo, value: data?.taAssetTagNumber ?? ''));
    statList.add(CustomAttributes(
        key: Constants.assetName, value: data?.taAssetName ?? ''));
    statList.add(CustomAttributes(
        key: Constants.parentAssetName, value: data?.parentAssetName ?? '-'));
    notifyListeners();
  }

  void setFlovValue(String key, String value) {
    flovValueList[key] = value;
    notifyListeners();
  }

  void fetchSTN(String serialNo, int? siteId) async {
    await CommonMethods.isAuthKeyExpired();
    setSRNLoading(true);
    var body = {"serialno": serialNo, "location_id": siteId};
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.serialNoUrl,
        urlName: 'serialNo',
        body: jsonEncode(body),
        headers: header);
    await _service.fetchBySerialNo(request).then((response) {
      singleAssetModel = response;
    }).whenComplete(() {
      getAttributes(singleAssetModel?.data?.taAssetTypeMasterId)
          .then((response) => {
                assetAttributes = response.assetType ?? [],
                setOperators(response.operators)
              })
          .whenComplete(() {
        setStaticList(singleAssetModel!, TaskType.stn);
        setSRNLoading(false);
      });
    });
  }

  void fetchSRN(String serialNo, int? siteId) async {
    await CommonMethods.isAuthKeyExpired();
    setSRNLoading(true);
    var body = {"serialno": serialNo, "location_id": siteId};
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.serialNoUrl,
        urlName: 'serialNo',
        body: jsonEncode(body),
        headers: header);
    await _service.fetchBySerialNo(request).then((response) {
      singleAssetModel = response;
    }).whenComplete(() {
      if (singleAssetModel?.data?.taAssetCatagory?.toUpperCase() == "ACTIVE") {
        getAttributes(singleAssetModel?.data?.taAssetTypeMasterId)
            .then((response) => {setOperators(response.operators)})
            .whenComplete(() {
          setStaticList(singleAssetModel!, TaskType.srn);
          setSRNLoading(false);
        });
      } else {
        setStaticList(singleAssetModel!, TaskType.srn);
        setSRNLoading(false);
      }
    });
  }

  setOperators(List<Operator>? operators) {
    if (operators != null) {
      operatorList = operators;

      operator = operatorList.firstWhere(
        (e) => e.operatorId == singleAssetModel?.data?.operatorId,
        orElse: () => operatorList.first,
      );
    }
  }

  Future<AttributeModel> getAttributes(assetTypeId) async {
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
    var response = await _taskService
        .getAssetTypeAttributes(request)
        .whenComplete(() => setLoading(false));
    assetAttributes = response.assetType!;
    setOperators(response.operators);

    return response;
  }

  Future<List<Task>> fetchTasks(String locationId) async {
    await CommonMethods.isAuthKeyExpired();
    setLoading(true);
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    return _taskService
        .fetchTasks(CustomRequest(
            url: Urls.myTaskList,
            urlName: 'taskUrl',
            body: jsonEncode({"location_code": locationId}),
            headers: header))
        .then((value) {
      taskList = value;
      return value;
    }).whenComplete(() => setLoading(false));
  }

  Future<ResponseModel> updateSRN(int assetId, String remarks) async {
    await CommonMethods.isAuthKeyExpired();
    setLoading(true);
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
      url: Urls.updateSRNUrl,
      urlName: 'srnSubmit',
      body: jsonEncode({
        'asset_id': assetId,
        'user_name': _session.getUserId().toString(),
        'remarks': remarks
      }),
      headers: header,
    );
    return _taskService.updateSRN(request).then((value) {
      return value;
    }).whenComplete(() => setLoading(false));
  }

  Future<ResponseModel> updateSTN(AddAssetRequestModel requestModel) async {
    setSubmitted(true);
    await CommonMethods.isAuthKeyExpired();
    var filesList = await getFiles(requestModel);

    var hashMap = {"fields": requestModel.toJson(), "files": filesList};
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.updateSTNUrl,
        urlName: 'stnSubmit',
        multiPart: hashMap,
        headers: header);
    return _taskService
        .updateSTN(request)
        .whenComplete(() => setSubmitted(false));
  }

  Future<List<Map<String, String>>> getFiles(AddAssetRequestModel data) async {
    filesList = [];
    if (data.imageFilePath != null) {
      String? filePath = data.imageFilePath;
      File file = File(filePath!);
      if (file.existsSync()) {
        String serialNumber = data.manufactureSerialNo!;

        filesList.add({serialNumber: filePath});
      }
    }
    return filesList;
  }

  void selectDate(BuildContext context, String name) {
    showDatePicker(
            context: context,
            initialDate: DateTime.now(),
            firstDate: DateTime(2000),
            lastDate: DateTime.now().add(const Duration(days: 18300)))
        .then((date) {
      if (date == null) return;
      controllers[name]?.text = DateFormat(defaultDateFormat).format(date);
      notifyListeners();
    });
  }

  Future<bool> isValidated() async {
    bool isValidated = true;

    if (assetNameController.text.trim().isEmpty) {
      ToastMessage.showMessage("Please enter asset name", kToastErrorColor);
      isValidated = false;
    } else {
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
            if (controllers[a.attributeName]!.text.isEmpty) {
              ToastMessage.showMessage(
                  "Please enter ${a.attributeName}.", kToastErrorColor);
              isValidated = false;
              break;
            }
          }
        }
      }
    }
    return isValidated;
  }

  Future<AddAssetRequestModel> getRequestModel(
      {int? locationId, int? assetId}) async {
    AddAssetRequestModel model = AddAssetRequestModel();
    model.assetTagNumber = qrCode;
    model.assetName = assetNameController.text;
    model.manufactureSerialNo =
        singleAssetModel?.data?.taAssetManufactureSerialNo;
    model.assetCatagory = singleAssetModel?.data?.taAssetCatagory;
    model.operatorId = operator?.operatorId;
    model.taAssetId = singleAssetModel?.data?.taAssetId;
    model.remarks = remarksController.text;
    model.imageFilePath = imageFile?.path;
    model.locationId = singleAssetModel?.data?.taAssetLocationId;
    model.assetParentId = singleAssetModel?.data?.taAssetParentId;
    model.attributes = assetAttributes
        .map((e) => Attribute(
              attrMasterId: e.attributeId,
              attributeName: e.attributeName,
              attributeValue: e.attributeDatatype == 'FLoV'
                  ? flovValueList[e.attributeName]
                  : controllers[e.attributeName]?.text,
            ))
        .toList();

    return model;
  }

  setImageFile(File imageFile) {
    this.imageFile = imageFile;
  }

  setQrCode(String qrCode) {
    statList.forEach((element) {
      if (element.key == Constants.assetTagNo) {
        element.value = qrCode;
        return;
      }
    });
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
