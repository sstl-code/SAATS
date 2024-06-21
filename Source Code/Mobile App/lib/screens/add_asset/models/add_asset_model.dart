class AddAssetModel {
  StaticModel staticAttributes;
  List<DynReqAttribute> dynamicAttributes;
  String updatedBy;

  AddAssetModel(
      {required this.staticAttributes,
      required this.dynamicAttributes,
      this.updatedBy = ''});

  factory AddAssetModel.fromJson(Map<String, dynamic> json) => AddAssetModel(
      staticAttributes: json['static_attribute'],
      dynamicAttributes: json['dynamic_attribute'],
      updatedBy: json['updatedBy']);

  Map<String, dynamic> toJson() => {
        'static_attribute': staticAttributes,
        'dynamic_attribute': dynamicAttributes,
        "updatedBy": updatedBy
      };

  @override
  String toString() {
    return 'AddAssetModel{staticAttributes: $staticAttributes, dynamicAttributes: $dynamicAttributes, updatedBy: $updatedBy}';
  }
}

class DynReqAttribute {
  String key;
  dynamic value;
  String valueType;
  String mandate;
  String attributeCode;

  DynReqAttribute(
      {required this.key,
      required this.value,
      required this.valueType,
      required this.mandate,
      required this.attributeCode});

  factory DynReqAttribute.fromJson(Map<String, dynamic> json) =>
      DynReqAttribute(
        key: json["key"],
        value: json["value"],
        valueType: json["valueType"],
        mandate: json["mandate"],
        attributeCode: json["attributeCode"],
      );

  Map<String, String> toJson() => {
        "key": key,
        "value": value.toString(),
        "valueType": valueType,
        "mandate": mandate,
        "attributeCode": attributeCode,
      };

  @override
  String toString() {
    return 'DynReqAttribute{key: $key, value: $value, valueType: $valueType, mandate: $mandate, attributeCode: $attributeCode}';
  }
}

class StaticModel {
  String assetTypeName;
  String assetManufactureSerialNo;
  String assetName;
  String assetDescription;
  String assetTagNumber;
  int? assetParentId;
  int assetLocationId;
  String assetStatus;
  String assetActiveInactiveStatus;
  String assetReason;

  StaticModel({
    required this.assetTypeName,
    required this.assetManufactureSerialNo,
    required this.assetName,
    required this.assetDescription,
    required this.assetTagNumber,
    required this.assetParentId,
    required this.assetLocationId,
    required this.assetStatus,
    required this.assetActiveInactiveStatus,
    required this.assetReason,
  });

  factory StaticModel.fromJson(Map<String, dynamic> json) => StaticModel(
        assetTypeName: json["asset_type_name"],
        assetManufactureSerialNo: json["asset_manufacture_serial_no"],
        assetName: json["asset_name"],
        assetDescription: json["asset_description"],
        assetTagNumber: json["asset_tag_number"],
        assetParentId: json["asset_parent_id"],
        assetLocationId: json["asset_location_id"],
        assetStatus: json["asset_status"],
        assetActiveInactiveStatus: json["ta_asset_active_inactive_status"],
        assetReason: json["asset_reason"],
      );

  Map<String, dynamic> toJson() => {
        "asset_type_name": assetTypeName,
        "asset_manufacture_serial_no": assetManufactureSerialNo,
        "asset_name": assetName,
        "asset_description": assetDescription,
        "asset_tag_number": assetTagNumber,
        "asset_parent_id": assetParentId,
        "asset_location_id": assetLocationId,
        "asset_status": assetStatus,
        "ta_asset_active_inactive_status": assetActiveInactiveStatus,
        "asset_reason": assetReason,
      };

  @override
  String toString() {
    return 'StaticModel{assetTypeName: $assetTypeName, assetManufactureSerialNo: $assetManufactureSerialNo, assetName: $assetName, assetDescription: $assetDescription, assetTagNumber: $assetTagNumber, assetParentId: $assetParentId, assetLocationId: $assetLocationId, assetStatus: $assetStatus, assetActiveInactiveStatus: $assetActiveInactiveStatus, assetReason: $assetReason}';
  }
}
