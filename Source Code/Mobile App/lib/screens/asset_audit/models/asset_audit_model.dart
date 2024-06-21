class AssetAuditModel {
  int? status;
  String? message;
  List<AssetAudit>? data;

  AssetAuditModel({
    this.status,
    this.message,
    this.data,
  });

  factory AssetAuditModel.fromJson(Map<String, dynamic> json) =>
      AssetAuditModel(
        status: json["status"],
        message: json["message"],
        data: json["data"] == null
            ? []
            : List<AssetAudit>.from(
                json["data"]!.map((x) => AssetAudit.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "message": message,
        "data": data == null
            ? []
            : List<dynamic>.from(data!.map((x) => x.toJson())),
      };
}

class AssetAudit {
  int taAssetId;
  String? tlLocationName;
  String? tlLocationCode;
  int? tlLocationId;
  String? taAssetName;
  String? taAssetManufactureSerialNo;
  String? taAssetTagNumber;
  String? taAssetActiveInactiveStatus;
  String? child;
  String? tagStatus;
  String? remarks;
  String? childEdited;
  String isAudited;

  AssetAudit(
      {required this.taAssetId,
      this.tlLocationName,
      this.tlLocationCode,
      this.tlLocationId,
      this.taAssetName,
      this.taAssetManufactureSerialNo,
      this.taAssetTagNumber,
      this.taAssetActiveInactiveStatus,
      this.child,
      this.tagStatus,
      this.remarks,
      this.childEdited,
      required this.isAudited});

  factory AssetAudit.fromJson(Map<String, dynamic> json) => AssetAudit(
        taAssetId: json["ta_asset_id"],
        tlLocationName: json["tl_location_name"],
        tlLocationCode: json["tl_location_code"],
        tlLocationId: json["tl_location_id"],
        taAssetName: json["ta_asset_name"],
        taAssetManufactureSerialNo: json["ta_asset_manufacture_serial_no"],
        taAssetTagNumber: json["ta_asset_tag_number"],
        taAssetActiveInactiveStatus: json["ta_asset_active_inactive_status"],
        child: json["child"],
        tagStatus: json["tag_status"],
        remarks: '',
        childEdited: 'N',
        isAudited: 'N',
      );

  Map<String, dynamic> toJson() => {
        "ta_asset_id": taAssetId,
        "tl_location_name": tlLocationName,
        "tl_location_code": tlLocationCode,
        "tl_location_id": tlLocationId,
        "ta_asset_name": taAssetName,
        "ta_asset_manufacture_serial_no": taAssetManufactureSerialNo,
        "ta_asset_tag_number": taAssetTagNumber,
        "ta_asset_active_inactive_status": taAssetActiveInactiveStatus,
        "child": child,
        "tag_status": tagStatus,
        "remarks": remarks,
        "childEdited": childEdited,
        "isAudited": isAudited,
      };

  @override
  String toString() {
    return 'AssetAudit{taAssetId: $taAssetId, tlLocationName: $tlLocationName, tlLocationCode: $tlLocationCode, tlLocationId: $tlLocationId, taAssetName: $taAssetName, taAssetManufactureSerialNo: $taAssetManufactureSerialNo, taAssetTagNumber: $taAssetTagNumber, taAssetActiveInactiveStatus: $taAssetActiveInactiveStatus, child: $child, tagStatus: $tagStatus, remarks: $remarks, childEdited: $childEdited, isAudited: $isAudited}';
  }
}
