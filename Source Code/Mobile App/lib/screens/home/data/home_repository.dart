import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:injectable/injectable.dart';

abstract class HomeRepository {
  Future<List<SiteData>> fetchMySites(CustomRequest request);

  Future<List<SiteData>> fetchNearBySites(CustomRequest request);

  Future<List<SiteData>> globalSearch(CustomRequest request);

  Future<CustomResponse> sendMail(CustomRequest request);
}

@Injectable(as: HomeRepository)
class HomeRepositoryImpl implements HomeRepository {
  final _baseService = locator.get<BaseHttpService>();

  @override
  Future<List<SiteData>> fetchMySites(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return response.statusCode == SUCCESS_RESPONSE_CODE
        ? SiteModel.fromJson(response.result).status == SUCCESS_RESPONSE_CODE
            ? SiteModel.fromJson(response.result).data
            : []
        : [];
  }

  @override
  Future<List<SiteData>> fetchNearBySites(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return response.statusCode == SUCCESS_RESPONSE_CODE
        ? SiteModel.fromJson(response.result).status == SUCCESS_RESPONSE_CODE
            ? SiteModel.fromJson(response.result).data
            : []
        : [];
  }

  @override
  Future<List<SiteData>> globalSearch(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return response.statusCode == SUCCESS_RESPONSE_CODE
        ? SiteModel.fromJson(response.result).status == SUCCESS_RESPONSE_CODE
            ? SiteModel.fromJson(response.result).data
            : []
        : [];
  }

  @override
  Future<CustomResponse> sendMail(CustomRequest request) async {
    return await _baseService.onPostRequest(request);
  }
}
