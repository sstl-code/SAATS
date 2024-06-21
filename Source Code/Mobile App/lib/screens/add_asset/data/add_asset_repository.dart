import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/image_response.dart';
import 'package:ats_system/screens/add_asset/models/asset_type_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/add_asset/models/dynamic_attribute_model.dart';
import 'package:ats_system/screens/add_asset/models/static_attribute_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:injectable/injectable.dart';

abstract class AddAssetService {
  Future<List<AssetType>> getAssetType(CustomRequest request);

  Future<AttributeModel> getAssetTypeAttributes(CustomRequest request);

  Future<List<DynamicAttribute>> getDynamicAttributes(CustomRequest request);

  Future<List<StatAttribute>> getStaticAttributes(CustomRequest request);

  Future<ResponseModel> addAsset(CustomRequest request);

  Future<SingleAssetModel> fetchBySerialNo(CustomRequest request);

  Future<ImageResponse> imageUpload(CustomRequest request);
}

@Injectable(as: AddAssetService)
class AddAssetServiceImpl extends AddAssetService {
  final _baseService = locator.get<BaseHttpService>();

  @override
  Future<List<AssetType>> getAssetType(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      return AssetTypeModel.fromJson(response.result).status ==
              SUCCESS_RESPONSE_CODE
          ? AssetTypeModel.fromJson(response.result).assetType
          : [];
    }
    return [];
  }

  @override
  Future<List<StatAttribute>> getStaticAttributes(CustomRequest request) async {
    CustomResponse response = await _baseService.onGetRequest(request);
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      return StaticAttributeModel.fromJson(response.result).status ==
              SUCCESS_RESPONSE_CODE
          ? StaticAttributeModel.fromJson(response.result).data ?? []
          : [];
    }
    return [];
  }

  @override
  Future<List<DynamicAttribute>> getDynamicAttributes(
      CustomRequest request) async {
    CustomResponse response = await _baseService.onGetRequest(request);
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      return DynamicAttributeModel.fromJson(response.result).status ==
              SUCCESS_RESPONSE_CODE
          ? DynamicAttributeModel.fromJson(response.result).data
          : [];
    }
    return [];
  }

  @override
  Future<ResponseModel> addAsset(CustomRequest request) async {
    CustomResponse response = await _baseService.onMultiPartRequest(request);
    try {
      return ResponseModel.fromJson(response.result);
    } catch (e) {
      return ResponseModel(status: 0, message: Strings.unableSaveAsset);
    }
  }

  @override
  Future<SingleAssetModel> fetchBySerialNo(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return SingleAssetModel.fromJson(response.result);
  }

  @override
  Future<AttributeModel> getAssetTypeAttributes(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return AttributeModel.fromJson(response.result);
  }

  @override
  Future<ImageResponse> imageUpload(CustomRequest request) async {
    CustomResponse response = await _baseService.onMultiPartRequest(request);
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      return ImageResponse.fromJson(response.result);
    }
    return ImageResponse(status: 401);
  }
}
