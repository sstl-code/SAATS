import 'dart:convert';
import 'dart:io';

import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/repository/location_service.dart';
import 'package:ats_system/repository/navigation_service.dart';
import 'package:ats_system/screens/add_asset/data/add_asset_repository.dart';
import 'package:ats_system/screens/add_asset/data_source/add_asset_manager.dart';
import 'package:ats_system/screens/add_asset/enum/add_asset_screen_from.dart';
import 'package:ats_system/screens/add_asset/models/asset_type_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:flutter/material.dart';
import 'package:get_it/get_it.dart';
import 'package:intl/intl.dart';
import 'package:provider/provider.dart';

class AddAssetProvider extends ChangeNotifier {
  final AddAssetService _addAssetService = locator.get<AddAssetService>();
  final _session = locator.get<SessionManager>();

  List<String> categoryList = [];
  List<Operator> operatorList = [];
  List<SingleAsset> assetList = [];
  Operator? operator;
  String? status, category;
  List<AssetType?> assetTypeList = [];
  AssetType? assetType;
  int? parentAssetId;
  int? isChildAllowedToAdd;
  List<AssetAttribute> assetAttributes = [];
  List<AssetAttribute> statAttributes = [];
  List<AssetAttribute> dynaAttributes = [];
  bool isLoading = false, showAll = false;
  TextEditingController serialController = TextEditingController();
  TextEditingController nameController = TextEditingController();
  TextEditingController siteIdController = TextEditingController();
  TextEditingController parentAssetController = TextEditingController();
  TextEditingController parentAssetSerialNumberController =
      TextEditingController();
  TextEditingController parentAssetTypeController = TextEditingController();
  TextEditingController remarksController = TextEditingController();
  TextEditingController assetTagNumberController = TextEditingController();

  Map<String, String?> flovValueList = {};
  Map<String, TextEditingController> controllers = {};
  File? imageFile;
  List<Map<String, String>> filesList = [];

  // List<SingleAsset> assetListToValidate = [];

  String? dropdownValue, serialError, nameError, siteIdError, parentAssetError;

  void clear() {
    showAll = false;
    assetType = null;
    category = null;
    status = null;
    operator = null;
    nameController.clear();
    operator = null;
    operatorList = [];
    assetTypeList = [];
    nameController = TextEditingController();
    remarksController = TextEditingController();
    assetTagNumberController = TextEditingController();
    flovValueList = {};
    statAttributes = [];
    dynaAttributes = [];
    categoryList = [];
    isLoading = false;
    assetList = [];
    this.imageFile = null;
    this.assetTagNumberController = TextEditingController();
    notifyListeners();
  }

  addChild(SingleAsset result) {
    assetList.add(result);

    notifyListeners();
  }

  updateChild(SingleAsset result, int index) {
    assetList[index] = result;
    notifyListeners();
  }

  void clearAllData() {
    notifyListeners();
  }

  void cleanOnCategory() {
    assetType = null;
    showAll = false;
    operator = null;
    operatorList = [];
    nameController = TextEditingController();
    remarksController = TextEditingController();
    flovValueList = {};
  }

  void cleanOnAssetSelection({bool? isFromPrePopulate}) {
    operator = null;
    operatorList = [];
    assetList.clear();
    nameController = TextEditingController();
    assetTagNumberController = TextEditingController();
    remarksController = TextEditingController();
    flovValueList = {};
    showAll = true;
    if (isFromPrePopulate != true) {
      notifyListeners();
    }
  }

  void setLoading(bool val) {
    isLoading = val;
    notifyListeners();
  }

  void selectCategory(String val, {int? id, bool? isFromPrePopulate}) async {
    cleanOnCategory();
    category = val;
    print("selected category: ${category}");
// notifyListeners();
    if (isFromPrePopulate != true) {
      assetTypeList = await getAssetType(assetId: id);
      notifyListeners();
    }
  }

  void setAssetType(AssetType val) async {
    isChildAllowedToAdd = val.isChildAvailable;

    assetType = val;
    cleanOnAssetSelection();
    var response = await getAttributes();
    setAttributes(response);
  }

  Future<void> prepopulateData(
      {SingleAssetModel? result,
      AddAssetType? addAssetScreenFrom,
      int? parentAssetId = 0,
      String? category}) async {
    if (result?.data?.childs?.isNotEmpty == true) {
      assetList = result?.data?.childs ?? [];
    }
    this.imageFile = File(result?.data?.taAssetImage ?? '');
    serialController.text = result?.data?.taAssetManufactureSerialNo ?? '';
    if (category == null) {
      return;
    }
    setCategory(
        addAssetScreenFrom: addAssetScreenFrom,
        category: category,
        assetTypeId: result?.data?.taAssetParentId,
        isFromPrePopulate: true);
    if (result?.data?.assetTypeList.isNotEmpty == true) {
      assetTypeList = result?.data?.assetTypeList ?? [];
    } else {
      assetTypeList = await getAssetType(assetId: parentAssetId);
    }

    if (result?.data?.selectedAssetType != null) {
      assetType = assetTypeList.firstWhere((element) =>
          element?.atAssetTypeId ==
          result?.data?.selectedAssetType?.atAssetTypeId);
    } else {
      try {
        assetType = assetTypeList.firstWhere((element) =>
            element?.atAssetTypeId == result?.data?.taAssetTypeMasterId);
      } catch (e) {}
    }

    if (assetType == null) {
      notifyListeners();
      return;
    }
    isChildAllowedToAdd = assetType?.isChildAvailable;

    cleanOnAssetSelection(isFromPrePopulate: true);

    nameController.text = result?.data?.taAssetName ?? '';
    assetTagNumberController.text = result?.data?.taAssetTagNumber ?? '';

    if (result?.data?.attributes.isNotEmpty == true) {
      assetAttributes = result?.data?.attributes ?? [];
    } else {
      var attributes = await getAttributes();
      assetAttributes = attributes.assetType ?? [];
    }

    statAttributes = assetAttributes
        .where((element) =>
            element.attributeCatagory == 0 &&
            element.display?.toUpperCase() == 'YES')
        .toList();

    dynaAttributes = assetAttributes
        .where((element) =>
            element.attributeCatagory != 0 &&
            element.display?.toUpperCase() == 'YES')
        .toList();

    for (var a in assetAttributes) {
      if (a.attributeDatatype == 'FLoV') {
        if (a.ataFlov != null) flovValueList[a.attributeName] = null;
      } else {
        controllers[a.attributeName] = TextEditingController();
      }
    }

    statAttributes.forEach((statAttrKey) {
      result?.data?.typeAttr?.forEach((attributesValue) {
        if (attributesValue.typeAttrMaster?.attributeCategory == 0 &&
            (attributesValue.typeAttrMaster?.ataAssetTypeAttributeId ==
                statAttrKey.attributeId)) {
          if (attributesValue.typeAttrMaster?.ataAssetTypeAttributeDatatype ==
              'FLoV') {
            flovValueList[attributesValue
                    .typeAttrMaster!.ataAssetTypeAttributeName!] =
                attributesValue.atAssetAttributeValueText;
          } else {
            controllers[
                    attributesValue.typeAttrMaster?.ataAssetTypeAttributeName!]
                ?.text = attributesValue.atAssetAttributeValueText!;
            flovValueList[attributesValue
                    .typeAttrMaster!.ataAssetTypeAttributeName!] =
                attributesValue.atAssetAttributeValueText;
          }
        }
      });
    });

    dynaAttributes.forEach((statAttrKey) {
      result?.data?.typeAttr?.forEach((attributesValue) {
        if (attributesValue.typeAttrMaster?.attributeCategory == 1 &&
            (attributesValue.typeAttrMaster?.ataAssetTypeAttributeId ==
                statAttrKey.attributeId)) {
          if (attributesValue.typeAttrMaster?.ataAssetTypeAttributeDatatype ==
              'FLoV') {
            flovValueList[attributesValue
                    .typeAttrMaster!.ataAssetTypeAttributeName!] =
                attributesValue.atAssetAttributeValueText;
          } else {
            controllers[
                    attributesValue.typeAttrMaster?.ataAssetTypeAttributeName!]
                ?.text = attributesValue.atAssetAttributeValueText!;
            flovValueList[attributesValue
                    .typeAttrMaster!.ataAssetTypeAttributeName!] =
                attributesValue.atAssetAttributeValueText;
          }
        }
      });
    });

    notifyListeners();
  }

  void setAttributes(AttributeModel response) {
    statAttributes = response.assetType!
        .where((element) =>
            element.attributeCatagory == 0 &&
            element.display?.toUpperCase() == 'YES')
        .toList();
    dynaAttributes = response.assetType!
        .where((element) =>
            element.attributeCatagory != 0 &&
            element.display?.toUpperCase() == 'YES')
        .toList();

    for (var a in response.assetType!) {
      if (a.attributeDatatype == 'FLoV') {
        if (a.ataFlov != null) flovValueList[a.attributeName] = null;
      } else {
        controllers[a.attributeName] = TextEditingController();
      }
    }
    notifyListeners();
  }

  void setCategory(
      {AddAssetType? addAssetScreenFrom,
      String? category,
      int? assetTypeId,
      bool? isFromPrePopulate}) {
    if (addAssetScreenFrom == AddAssetType.addParentFromAssetListing) {
      categoryList = ['PASSIVE', 'ACTIVE'];
      if (isFromPrePopulate == true) {
        selectCategory(category!,
            id: assetTypeId, isFromPrePopulate: isFromPrePopulate);
      }
    } else {
      selectCategory(category!,
          id: assetTypeId, isFromPrePopulate: isFromPrePopulate);
    }
  }

  Future<SingleAssetModel?> fetchBySerialNo({
    int? tlLocationId,
  }) async {
    clear();
    await CommonMethods.isAuthKeyExpired();
    setLoading(true);
    var body = {
      "serialno": serialController.text,
      "location_id": tlLocationId,
      "is_add_asset": 1
    };
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.serialNoUrl,
        urlName: 'serialNo',
        body: jsonEncode(body),
        headers: header);
    var result = await _addAssetService
        .fetchBySerialNo(request)
        .whenComplete(() => setLoading(false));

    return result;
  }

  bool isShowDataWillbeLosedDialog() {
    if (serialController.text.isNotEmpty ||
        assetType != null ||
        nameController.text.isNotEmpty) {
      return true;
    }
    return false;
  }

  Future<List<AssetType>> getAssetType({int? assetId}) async {
    await CommonMethods.isAuthKeyExpired();
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.assetTypeUrl,
        urlName: 'assetType',
        body: jsonEncode({"assetCategory": category, "id": assetId}),
        headers: header);
    var result = await _addAssetService
        .getAssetType(request)
        .whenComplete(() => notifyListeners());
    if (result.isEmpty) {
      ToastMessage.showMessage('No assets type found!', kToastErrorColor);
      return [];
    } else {
      result.sort((a, b) => a.atAssetTypeName.compareTo(b.atAssetTypeName));
      return result;
    }
  }

  void setFlovValue(String key, String value) {
    flovValueList[key] = value;
    notifyListeners();
  }

  Future<AttributeModel> getAttributes() async {
    await CommonMethods.isAuthKeyExpired();
    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    CustomRequest request = CustomRequest(
        url: Urls.assetTypeAttrUrl,
        urlName: 'assetTypeAttr',
        body: jsonEncode({"asset_type_id": assetType?.atAssetTypeId}),
        headers: header);
    var response = await _addAssetService
        .getAssetTypeAttributes(request)
        .whenComplete(() => setLoading(false));
    assetAttributes = response.assetType!;

    operatorList = response.operators!;

    return response;
  }

  Future<ResponseModel> addAsset(SingleAsset model) async {
    filesList = [];
    var data = await locator.get<LocationService>().getUserLocation();
    model.latitude = data.latitude;
    model.longitude = data.longitude;
    setLoading(true);

    await CommonMethods.isAuthKeyExpired();

    final header = {
      "Authorization": _session.getToken(),
      'content-type': 'application/json'
    };
    var files = await getFiles(model);

    print('All file sare ${files}');
    var hashMap = {"fields": model.toJson(), "files": files};

    CustomRequest request = CustomRequest(
        url: Urls.addAssetUrl,
        urlName: 'addAsset',
        multiPart: hashMap,
        headers: header);
    return _addAssetService
        .addAsset(request)
        .whenComplete(() => setLoading(false));
  }

  Future<List<Map<String, String>>> getFiles(SingleAsset data) async {
    if (data.taAssetImage != null) {
      String? filePath = data.taAssetImage;
      File file = File(filePath!);
      if (file.existsSync()) {
        String serialNumber = data.taAssetManufactureSerialNo.toString();

        filesList.add({serialNumber: filePath});
      }
    }

    if (data.childs?.isNotEmpty == true) {
      for (int i = 0; i < data.childs!.length; i++) {
        await getFiles((data.childs!.elementAt(i)));
      }
    }

    return filesList;
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

  Future<bool> isValidated() async {
    bool isValidated = true;

    if (serialController.text.trim().isEmpty) {
      serialError = Strings.emptyField;
      notifyListeners();
      isValidated = false;
    } else if (category == null) {
      ToastMessage.showMessage("Please select category.", kToastErrorColor);
      isValidated = false;
    } else if (assetType == null) {
      ToastMessage.showMessage("Please select asset type.", kToastErrorColor);
      isValidated = false;
    } else if (siteIdController.text.trim().isEmpty) {
      siteIdError = Strings.emptyField;
      isValidated = false;
    } else if (nameController.text.trim().isEmpty) {
      nameError = Strings.emptyField;
      notifyListeners();
      isValidated = false;
    } else if (parentAssetController.text.trim().isEmpty) {
      parentAssetError = Strings.emptyField;
      notifyListeners();
    } else if (category == 'ACTIVE' && operator == null) {
      ToastMessage.showMessage("Please select operator.", kToastErrorColor);
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

  Future<SingleAsset> getRequestModel({int? locationId}) async {
    SingleAsset model = SingleAsset();
    model.taAssetManufactureSerialNo = serialController.text;
    model.taAssetTypeMasterId = assetType?.atAssetTypeId;
    model.taAssetTagNumber = assetTagNumberController.text;
    model.taAssetName = nameController.text;
    model.taAssetLocationId = locationId;
    model.taAssetCatagory = category;
    model.taAssetActiveInactiveStatus = status;
    model.parentSerialNo = parentAssetSerialNumberController.text;
    model.operatorId = operator?.operatorId ?? null;
    model.assetType = assetType?.atAssetTypeName;
    model.taAssetParentId = parentAssetId;
    model.taAssetImage = imageFile?.path;
    model.childs = assetList;
    model.selectedAssetType = assetType;
    model.assetTypeList = assetTypeList;
    model.attributes = assetAttributes;
    model.typeAttr = assetAttributes
        .map((e) => AssetTypeAttr(
              typeAttrMaster: AttrMaster(
                  attributeCategory: e.attributeCatagory,
                  ataAssetTypeAttributeId: e.attributeId,
                  ataAssetTypeAttributeName: e.attributeName),
              atAssetAttributeValueText: e.attributeDatatype == 'FLoV'
                  ? flovValueList[e.attributeName]
                  : controllers[e.attributeName]?.text,
            ))
        .toList();

    return model;
  }

  deleteAsset(SingleAsset bean) {
    assetList.remove(bean);
    notifyListeners();
  }

  setImageFile(File imageFile) {
    this.imageFile = imageFile;
  }

  setQrCode(String qrCode) {
    assetTagNumberController.text = qrCode;
    notifyListeners();
  }

  clearTagging() {
    this.imageFile = null;
    this.assetTagNumberController = TextEditingController();
    notifyListeners();
  }

  clearImage() {
    this.imageFile = null;
  }

  Future<SingleAsset?> getAsset() async {
    final AddAssetManager dataSource =
        locator.get<AddAssetManager>(instanceName: 'local-add-asset');
    var asset = await getRequestModel(
        locationId: GetIt.I<NavigationService>()
            .getContext()
            .read<HomeProvider>()
            .selectedSite!
            .tlLocationId);

    SingleAsset? assetFromDb = dataSource.findBySerialNoAndLocationId(
        asset.taAssetManufactureSerialNo, asset.taAssetLocationId);

    return assetFromDb;
  }

  addAssetToBox() async {
    final AddAssetManager dataSource =
        locator.get<AddAssetManager>(instanceName: 'local-add-asset');
    var asset = await getRequestModel(
        locationId: GetIt.I<NavigationService>()
            .getContext()
            .read<HomeProvider>()
            .selectedSite!
            .tlLocationId);

    SingleAsset? assetFromDb = dataSource.findBySerialNoAndLocationId(
        asset.taAssetManufactureSerialNo, asset.taAssetLocationId);
    if (assetFromDb != null) {
      assetFromDb.delete();
    }
    dataSource.add(asset);
  }
}
