class TaskModel {
  int? status;
  List<Task>? taskList;

  TaskModel({
    this.status,
    this.taskList,
  });

  factory TaskModel.fromJson(Map<String, dynamic> json) => TaskModel(
        status: json["status"],
        taskList: json["data"] == null
            ? []
            : List<Task>.from(json["data"]!.map((x) => Task.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "data": taskList == null
            ? []
            : List<dynamic>.from(taskList!.map((x) => x.toJson())),
      };
}

class Task {
  String? f2ASyncDate;
  String? f2AFileName;
  String? f2AAssetType;
  String? f2AAssetName;
  String? f2AManufactureSerialNo;
  String? f2ADescription;
  int? f2ASiteId;
  String? f2ASiteType;
  String? f2ASiteName;
  dynamic f2AAddress;
  String? f2AStatus;
  String? f2AReason;
  dynamic f2AImage;
  dynamic f2AAssetAttribute;
  String? f2ACreationDate;
  dynamic f2ACreatedBy;
  dynamic f2ALastUpdatedDate;
  dynamic f2ALastUpdatedBy;
  dynamic f2AEndDate;
  String? f2AType;
  String? f2ASiteCode;
  int? id;
  dynamic f2AParentId;
  dynamic f2AOperatorId;
  dynamic f2ACategory;

  Task({
    this.f2ASyncDate,
    this.f2AFileName,
    this.f2AAssetType,
    this.f2AAssetName,
    this.f2AManufactureSerialNo,
    this.f2ADescription,
    this.f2ASiteId,
    this.f2ASiteType,
    this.f2ASiteName,
    this.f2AAddress,
    this.f2AStatus,
    this.f2AReason,
    this.f2AImage,
    this.f2AAssetAttribute,
    this.f2ACreationDate,
    this.f2ACreatedBy,
    this.f2ALastUpdatedDate,
    this.f2ALastUpdatedBy,
    this.f2AEndDate,
    this.f2AType,
    this.f2ASiteCode,
    this.id,
    this.f2AParentId,
    this.f2AOperatorId,
    this.f2ACategory,
  });

  factory Task.fromJson(Map<String, dynamic> json) => Task(
        f2ASyncDate: json["f2a_sync_date"],
        f2AFileName: json["f2a_file_name"],
        f2AAssetType: json["f2a_asset_type"],
        f2AAssetName: json["f2a_asset_name"],
        f2AManufactureSerialNo: json["f2a_manufacture_serial_no"],
        f2ADescription: json["f2a_description"],
        f2ASiteId: json["f2a_site_id"],
        f2ASiteType: json["f2a_site_type"],
        f2ASiteName: json["f2a_site_name"],
        f2AAddress: json["f2a_address"],
        f2AStatus: json["f2a_status"],
        f2AReason: json["f2a_reason"],
        f2AImage: json["f2a_image"],
        f2AAssetAttribute: json["f2a_asset_attribute"],
        f2ACreationDate: json["f2a_creation_date"],
        f2ACreatedBy: json["f2a_created_by"],
        f2ALastUpdatedDate: json["f2a_last_updated_date"],
        f2ALastUpdatedBy: json["f2a_last_updated_by"],
        f2AEndDate: json["f2a_end_date"],
        f2AType: json["f2a_type"],
        f2ASiteCode: json["f2a_site_code"],
        id: json["id"],
        f2AParentId: json["f2a_Parent_id"],
        f2AOperatorId: json["f2a_operator_id"],
        f2ACategory: json["f2a_category"],
      );

  Map<String, dynamic> toJson() => {
        "f2a_sync_date": f2ASyncDate,
        "f2a_file_name": f2AFileName,
        "f2a_asset_type": f2AAssetType,
        "f2a_asset_name": f2AAssetName,
        "f2a_manufacture_serial_no": f2AManufactureSerialNo,
        "f2a_description": f2ADescription,
        "f2a_site_id": f2ASiteId,
        "f2a_site_type": f2ASiteType,
        "f2a_site_name": f2ASiteName,
        "f2a_address": f2AAddress,
        "f2a_status": f2AStatus,
        "f2a_reason": f2AReason,
        "f2a_image": f2AImage,
        "f2a_asset_attribute": f2AAssetAttribute,
        "f2a_creation_date": f2ACreationDate,
        "f2a_created_by": f2ACreatedBy,
        "f2a_last_updated_date": f2ALastUpdatedDate,
        "f2a_last_updated_by": f2ALastUpdatedBy,
        "f2a_end_date": f2AEndDate,
        "f2a_type": f2AType,
        "f2a_site_code": f2ASiteCode,
        "id": id,
        "f2a_Parent_id": f2AParentId,
        "f2a_operator_id": f2AOperatorId,
        "f2a_category": f2ACategory,
      };
}
