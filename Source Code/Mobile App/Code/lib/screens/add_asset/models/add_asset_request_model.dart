class AddAssetRequestModel {
  String? manufactureSerialNo;
  int? userId;
  int? taAssetTypeMasterId;
  String? assetName;
  String? remarks;
  String? assetTagNumber;
  int? locationId;
  int? taAssetId;
  String? assetCatagory;
  String? assetActiveInactiveStatus;
  int? assetParentId;
  int? operatorId;
  String? assetTypeName;
  String? imageFilePath;
  double? latitude;
  double? longitude;
  List<Attribute>? attributes;

  AddAssetRequestModel({
    this.manufactureSerialNo,
    this.taAssetId,
    this.userId,
    this.taAssetTypeMasterId,
    this.assetName,
    this.remarks,
    this.assetTagNumber,
    this.locationId,
    this.imageFilePath,
    this.assetCatagory,
    this.assetActiveInactiveStatus,
    this.assetParentId,
    this.operatorId,
    this.assetTypeName,
    this.attributes,
    this.latitude,
    this.longitude,
  });

  factory AddAssetRequestModel.fromJson(Map<String, dynamic> json) =>
      AddAssetRequestModel(
        manufactureSerialNo: json["manufacture_serial_no"],
        taAssetId: json["asset_id"],
        userId: json["user_name"],
        taAssetTypeMasterId: json["ta_asset_type_master_id"],
        assetName: json["asset_name"],
        remarks: json["remarks"],
        assetTagNumber: json["asset_tag_number"],
        locationId: json["location_id"],
        assetCatagory: json["asset_catagory"],
        assetActiveInactiveStatus: json["asset_active_inactive_status"],
        assetParentId: json["asset_parent_id"],
        operatorId: json["operator_id"],
        assetTypeName: json["asset_type_name"],
        imageFilePath: json["image_file_path"],
        longitude: json["longitude"],
        latitude: json["latitude"],
        attributes: json["attributes"] == null
            ? []
            : List<Attribute>.from(
                json["attributes"]!.map((x) => Attribute.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "manufacture_serial_no": manufactureSerialNo,
        "asset_id": taAssetId,
        "user_name": userId,
        "ta_asset_type_master_id": taAssetTypeMasterId,
        "asset_name": assetName,
        "remarks": remarks,
        "asset_tag_number": assetTagNumber,
        "location_id": locationId,
        "asset_catagory": assetCatagory,
        "asset_active_inactive_status": assetActiveInactiveStatus,
        "asset_parent_id": assetParentId,
        "operator_id": operatorId,
        "asset_type_name": assetTypeName,
        "image_file_path": imageFilePath,
        "longitude": longitude,
        "latitude": latitude,
        "attributes": attributes == null
            ? []
            : List<dynamic>.from(attributes!.map((x) => x.toJson())),
      };

  @override
  String toString() {
    return 'AddAssetRequestModel{manufactureSerialNo: $manufactureSerialNo, userId: $userId, taAssetTypeMasterId: $taAssetTypeMasterId, assetName: $assetName, assetTagNumber: $assetTagNumber, locationId: $locationId, assetCatagory: $assetCatagory, assetActiveInactiveStatus: $assetActiveInactiveStatus, assetParentId: $assetParentId, operatorId: $operatorId, assetTypeName: $assetTypeName, attributes: $attributes}';
  }
}

class Attribute {
  int? attrMasterId;
  String? attributeName;
  String? attributeValue;

  Attribute({
    this.attrMasterId,
    this.attributeName,
    this.attributeValue,
  });

  factory Attribute.fromJson(Map<String, dynamic> json) => Attribute(
        attrMasterId: json["attr_master_id"],
        attributeName: json["attribute_name"],
        attributeValue: json["attribute_value"],
      );

  Map<String, dynamic> toJson() => {
        "attr_master_id": attrMasterId,
        "attribute_name": attributeName,
        "attribute_value": attributeValue,
      };

  @override
  String toString() {
    return 'Attribute{attrMasterId: $attrMasterId, attributeName: $attributeName, attributeValue: $attributeValue}';
  }
}
