class StaticAttributeModel {
  int? status;
  String? message;
  List<StatAttribute>? data;

  StaticAttributeModel({
    this.status,
    this.message,
    this.data,
  });

  factory StaticAttributeModel.fromJson(Map<String, dynamic> json) =>
      StaticAttributeModel(
        status: json["status"],
        message: json["message"],
        data: json["data"] == null
            ? []
            : List<StatAttribute>.from(
                json["data"]!.map((x) => StatAttribute.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "message": message,
        "data": data == null
            ? []
            : List<dynamic>.from(data!.map((x) => x.toJson())),
      };
}

class StatAttribute {
  int? atAssetTypeId;
  String? ataAssetTypeAttributeMandatoryFlag;
  String? ataAssetTypeAttributeName;
  String? ataAssetTypeAttributeDatatype;

  StatAttribute({
    this.atAssetTypeId,
    this.ataAssetTypeAttributeMandatoryFlag,
    this.ataAssetTypeAttributeName,
    this.ataAssetTypeAttributeDatatype,
  });

  factory StatAttribute.fromJson(Map<String, dynamic> json) => StatAttribute(
        atAssetTypeId: json["at_asset_type_id"],
        ataAssetTypeAttributeMandatoryFlag:
            json["ata_asset_type_attribute_mandatory_flag"],
        ataAssetTypeAttributeName: json["ata_asset_type_attribute_name"],
        ataAssetTypeAttributeDatatype:
            json["ata_asset_type_attribute_datatype"],
      );

  Map<String, dynamic> toJson() => {
        "at_asset_type_id": atAssetTypeId,
        "ata_asset_type_attribute_mandatory_flag":
            ataAssetTypeAttributeMandatoryFlag,
        "ata_asset_type_attribute_name": ataAssetTypeAttributeName,
        "ata_asset_type_attribute_datatype": ataAssetTypeAttributeDatatype,
      };
}
