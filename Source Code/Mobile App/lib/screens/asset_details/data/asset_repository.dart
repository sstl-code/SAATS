import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/image_response.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:injectable/injectable.dart';

abstract class AssetDetailsService {
  Future<List<AssetDataModel>> fetchAssetList(CustomRequest request);

  Future<SingleAssetModel> fetchSingleAssetDetails(CustomRequest request);

  Future<ImageResponse> imageUpload(CustomRequest request);

  Future<ResponseModel> editAsset(CustomRequest request);

  Future<SingleAssetModel> fetchBySerialNoForChild(CustomRequest request);
}

@Injectable(as: AssetDetailsService)
class AssetDetailsServiceImpl implements AssetDetailsService {
  final _baseService = locator.get<BaseHttpService>();

  @override
  Future<ImageResponse> imageUpload(CustomRequest request) async {
    CustomResponse response = await _baseService.onMultiPartRequest(request);
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      return ImageResponse.fromJson(response.result);
    }
    return ImageResponse(status: 401);
  }

  @override
  Future<List<AssetDataModel>> fetchAssetList(CustomRequest request) async {
    CustomResponse response = await _baseService.onGetRequest(request);
    var a = AssetDetailsModel.fromJson(response.result);
    return response.statusCode == SUCCESS_RESPONSE_CODE
        ? a.status == SUCCESS_RESPONSE_CODE
            ? a.data!
            : []
        : [];
  }

  @override
  Future<SingleAssetModel> fetchSingleAssetDetails(
      CustomRequest request) async {
    CustomResponse response = await _baseService.onGetRequest(request);
    return SingleAssetModel.fromJson(response.result);
  }

  @override
  Future<ResponseModel> editAsset(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return ResponseModel.fromJson(response.result);
  }

  @override
  Future<SingleAssetModel> fetchBySerialNoForChild(
      CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return SingleAssetModel.fromJson(response.result);
  }
}
