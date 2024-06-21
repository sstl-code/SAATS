import 'package:ats_system/api_client/api_client.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/task_list/models/response_model.dart';
import 'package:ats_system/screens/task_list/models/task_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:injectable/injectable.dart';

abstract class MyTaskService {
  Future<List<Task>> fetchTasks(CustomRequest request);
  Future<ResponseModel> updateSTN(CustomRequest request);
  Future<ResponseModel> updateSRN(CustomRequest request);
  Future<AttributeModel> getAssetTypeAttributes(CustomRequest request);
}

@Injectable(as: MyTaskService)
class MyTaskServiceImpl implements MyTaskService {
  final BaseHttpService _service = locator.get<BaseHttpService>();

  @override
  Future<ResponseModel> updateSRN(CustomRequest request) async {
    CustomResponse response = await _service.onPostRequest((request));
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      return ResponseModel.fromJson(response.result);
    }
    return ResponseModel(status: 0, message: "Failed to submit SRN");
  }

  @override
  Future<List<Task>> fetchTasks(CustomRequest request) async {
    CustomResponse response = await _service.onPostRequest((request));
    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      TaskModel model = TaskModel.fromJson((response.result));
      return model.status == SUCCESS_RESPONSE_CODE ? model.taskList! : [];
    }
    return [];
  }

  @override
  Future<ResponseModel> updateSTN(CustomRequest request) async {
    CustomResponse response = await _service.onMultiPartRequest((request));

    if (response.statusCode == SUCCESS_RESPONSE_CODE) {
      return ResponseModel.fromJson(response.result);
    }
    return ResponseModel(status: 0, message: "Failed to submit STN");
  }

  @override
  Future<AttributeModel> getAssetTypeAttributes(CustomRequest request) async {
    CustomResponse response = await _service.onPostRequest(request);
    return AttributeModel.fromJson(response.result);
  }
}
