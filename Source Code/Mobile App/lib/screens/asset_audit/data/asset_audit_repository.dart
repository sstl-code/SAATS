import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/asset_audit/audit_details/models/audit_details_model.dart';
import 'package:ats_system/screens/asset_audit/models/asset_audit_model.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:injectable/injectable.dart';

abstract class AssetAuditService {
  Future<List<AssetAudit>> getAssetAudit(CustomRequest request);
  Future<AuditDetailsModel> getAssetAuditDetails(CustomRequest request);
  Future<ResponseModel> submitAssetAudit(CustomRequest request);
}

@Injectable(as: AssetAuditService)
class AssetAuditServiceImpl implements AssetAuditService {
  final _baseService = locator.get<BaseHttpService>();

  @override
  Future<List<AssetAudit>> getAssetAudit(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return response.statusCode == SUCCESS_RESPONSE_CODE
        ? AssetAuditModel.fromJson(response.result).status ==
                SUCCESS_RESPONSE_CODE
            ? AssetAuditModel.fromJson(response.result).data!
            : []
        : [];
  }

  @override
  Future<AuditDetailsModel> getAssetAuditDetails(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return AuditDetailsModel.fromJson(response.result);
  }

  @override
  Future<ResponseModel> submitAssetAudit(CustomRequest request) async {
    CustomResponse response = await _baseService.onPostRequest(request);
    return ResponseModel.fromJson(response.result);
  }
}
