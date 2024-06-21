class DynamicAttributeModel {
  int status;
  String message;
  List<DynamicAttribute> data;

  DynamicAttributeModel({
    required this.status,
    required this.message,
    required this.data,
  });

  factory DynamicAttributeModel.fromJson(Map<String, dynamic> json) =>
      DynamicAttributeModel(
        status: json.containsKey("status") ? json["status"] : -1,
        message: json["message"],
        data: json.containsKey("data")
            ? List<DynamicAttribute>.from(
                json["data"].map((x) => DynamicAttribute.fromJson(x)))
            : [],
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "message": message,
        "data": List<dynamic>.from(data.map((x) => x.toJson())),
      };
}

class DynamicAttribute {
  int atAssetTypeId;
  String ataAssetTypeAttributeName;
  String? ataAssetTypeAttributeDatatype;

  DynamicAttribute({
    required this.atAssetTypeId,
    required this.ataAssetTypeAttributeName,
    this.ataAssetTypeAttributeDatatype,
  });

  factory DynamicAttribute.fromJson(Map<String, dynamic> json) =>
      DynamicAttribute(
        atAssetTypeId: json["at_asset_type_id"],
        ataAssetTypeAttributeName: json["ata_asset_type_attribute_name"],
        ataAssetTypeAttributeDatatype:
            json["ata_asset_type_attribute_datatype"],
      );

  Map<String, dynamic> toJson() => {
        "at_asset_type_id": atAssetTypeId,
        "ata_asset_type_attribute_name": ataAssetTypeAttributeName,
        "ata_asset_type_attribute_datatype": ataAssetTypeAttributeDatatype,
      };

  @override
  String toString() {
    return 'DynamicAttribute{atAssetTypeId: $atAssetTypeId, ataAssetTypeAttributeName: $ataAssetTypeAttributeName, ataAssetTypeAttributeDatatype: $ataAssetTypeAttributeDatatype}';
  }
}
