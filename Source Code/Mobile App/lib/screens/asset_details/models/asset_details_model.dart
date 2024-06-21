class AssetDetailsModel {
  int? status;
  List<AssetDataModel>? data;

  AssetDetailsModel({
    this.status,
    this.data,
  });

  factory AssetDetailsModel.fromJson(Map<String, dynamic> json) =>
      AssetDetailsModel(
        status: json["status"],
        data: json["data"] == null
            ? []
            : List<AssetDataModel>.from(
                json["data"]!.map((x) => AssetDataModel.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "data": data == null
            ? []
            : List<dynamic>.from(data!.map((x) => x.toJson())),
      };

  @override
  String toString() {
    return 'AssetDetailsModel{status: $status, data: $data}';
  }
}

class AssetDataModel {
  int? masterId;
  int taAssetId;
  int? locationId;
  String? assetName;
  String? taAssetManufactureSerialNo;
  String? parentTag;
  dynamic taAssetActiveInactiveStatus;
  dynamic parentAssetId;
  String? category;
  String? assetTypeName;
  dynamic assetType;
  String? operators;
  List<TypeAttr>? typeAttr;
  List<AssetDataModel> childs;
  String isAudited;
  bool tagMissing;
  bool assetMissing;
  bool isChildAudited;
  String? childEdited;

  AssetDataModel({
    required this.taAssetId,
    required this.category,
    required this.assetName,
    this.masterId,
    this.locationId,
    this.taAssetManufactureSerialNo,
    this.parentTag,
    this.taAssetActiveInactiveStatus,
    this.parentAssetId,
    this.assetTypeName,
    this.operators,
    this.typeAttr,
    required this.childs,
    required this.isAudited,
    required this.tagMissing,
    required this.assetMissing,
    required this.isChildAudited,
    this.childEdited,
  });

  factory AssetDataModel.fromJson(Map<String, dynamic> json) => AssetDataModel(
        masterId: json["ta_asset_type_master_id"],
        taAssetId: json["ta_asset_id"],
        locationId: json["ta_asset_location_id"],
        assetName: json["ta_asset_name"],
        taAssetManufactureSerialNo: json["ta_asset_manufacture_serial_no"],
        parentTag: json["ta_asset_tag_number"],
        category: json["ta_asset_catagory"],
        taAssetActiveInactiveStatus: json["ta_asset_active_inactive_status"],
        parentAssetId: json["ta_asset_parent_id"],
        assetTypeName: json["AssetType"],
        operators: json["operators"],
        typeAttr: json["TypeAttr"] == null
            ? []
            : List<TypeAttr>.from(
                json["TypeAttr"]!.map((x) => TypeAttr.fromJson(x))),
        childs: List<AssetDataModel>.from(
            json["childs"]!.map((x) => AssetDataModel.fromJson(x))),
        isAudited: 'N',
        tagMissing: false,
        assetMissing: false,
        isChildAudited: false,
        childEdited: 'N',
      );

  Map<String, dynamic> toJson() => {
        "master_id": masterId,
        "ta_asset_id": taAssetId,
        "location_id": locationId,
        "parent_asset_name": assetName,
        "ta_asset_manufacture_serial_no": taAssetManufactureSerialNo,
        "parent_tag": parentTag,
        "catagory": category,
        "ta_asset_active_inactive_status": taAssetActiveInactiveStatus,
        "parent_asset_id": parentAssetId,
        "TypeName": assetTypeName,
        "operators": operators,
        "TypeAttr": typeAttr == null
            ? []
            : List<dynamic>.from(typeAttr!.map((x) => x.toJson())),
        "childs": List<AssetDataModel>.from(childs.map((x) => x.toJson())),
      };

  @override
  String toString() {
    return 'AssetDataModel{masterId: $masterId, locationId: $locationId, assetName: $assetName, taAssetManufactureSerialNo: $taAssetManufactureSerialNo, category: $category, assetTypeName: $assetTypeName, assetType: $assetType, operators: $operators, childs: $childs, isAudited: $isAudited, tagMissing: $tagMissing, assetMissing: $assetMissing, isChildAudited: $isChildAudited}';
  }
}

class TypeAttr {
  int? atAssetAttributeId;
  int? atAssetTypeAttributeMasterId;
  int? atAssetId;
  String? atAssetAttributeCode;
  String? atAssetAttributeDescription;
  String? atCreationDate;
  dynamic atCreatedBy;
  dynamic atEffectiveStartDate;
  dynamic atLastUpdatedDate;
  dynamic atLastUpdatedBy;
  dynamic atEffectiveEndDate;
  String? atAssetAttributeValueText;
  TypeAttrMaster? typeAttrMaster;

  TypeAttr({
    this.atAssetAttributeId,
    this.atAssetTypeAttributeMasterId,
    this.atAssetId,
    this.atAssetAttributeCode,
    this.atAssetAttributeDescription,
    this.atCreationDate,
    this.atCreatedBy,
    this.atEffectiveStartDate,
    this.atLastUpdatedDate,
    this.atLastUpdatedBy,
    this.atEffectiveEndDate,
    this.atAssetAttributeValueText,
    this.typeAttrMaster,
  });

  factory TypeAttr.fromJson(Map<String, dynamic> json) => TypeAttr(
        atAssetAttributeId: json["at_asset_attribute_id"],
        atAssetTypeAttributeMasterId: json["at_asset_type_attribute_master_id"],
        atAssetId: json["at_asset_id"],
        atAssetAttributeCode: json["at_asset_attribute_code"],
        atAssetAttributeDescription: json["at_asset_attribute_description"],
        atCreationDate: json["at_creation_date"],
        atCreatedBy: json["at_created_by"],
        atEffectiveStartDate: json["at_effective_start_date"],
        atLastUpdatedDate: json["at_last_updated_date"],
        atLastUpdatedBy: json["at_last_updated_by"],
        atEffectiveEndDate: json["at_effective_end_date"],
        atAssetAttributeValueText: json["at_asset_attribute_value_text"],
        typeAttrMaster: json["TypeAttrMaster"] is Map
            ? TypeAttrMaster.fromJson(json["TypeAttrMaster"])
            : null,
      );

  Map<String, dynamic> toJson() => {
        "at_asset_attribute_id": atAssetAttributeId,
        "at_asset_type_attribute_master_id": atAssetTypeAttributeMasterId,
        "at_asset_id": atAssetId,
        "at_asset_attribute_code": atAssetAttributeCode,
        "at_asset_attribute_description": atAssetAttributeDescription,
        "at_creation_date": atCreationDate,
        "at_created_by": atCreatedBy,
        "at_effective_start_date": atEffectiveStartDate,
        "at_last_updated_date": atLastUpdatedDate,
        "at_last_updated_by": atLastUpdatedBy,
        "at_effective_end_date": atEffectiveEndDate,
        "at_asset_attribute_value_text": atAssetAttributeValueText,
        "TypeAttrMaster": typeAttrMaster,
      };
}

class TypeAttrMaster {
  int? ataAssetTypeAttributeId;
  String? ataAssetTypeAttributeCode;
  String? ataAssetTypeAttributeDescription;
  String? ataAssetTypeAttributeDatatype;
  String? ataAssetTypeAttributeMandatoryFlag;
  dynamic ataAssetTypeAttributeDefaultValue;
  int? ataAssetTypeId;
  String? ataCreationDate;
  String? ataCreatedBy;
  String? ataEffectiveStartDate;
  String? ataLastUpdatedDate;
  String? ataLastUpdatedBy;
  dynamic ataEffectiveEndDate;
  String? ataAssetTypeAttributeName;
  dynamic ataFlov;
  String? ataDisplay;
  String? ataStatus;
  String? ataFieldRequieredNotRequiredFlag;
  String? ataFieldEditableNonEditableFlag;
  int? attributeCatagory;

  TypeAttrMaster({
    this.ataAssetTypeAttributeId,
    this.ataAssetTypeAttributeCode,
    this.ataAssetTypeAttributeDescription,
    this.ataAssetTypeAttributeDatatype,
    this.ataAssetTypeAttributeMandatoryFlag,
    this.ataAssetTypeAttributeDefaultValue,
    this.ataAssetTypeId,
    this.ataCreationDate,
    this.ataCreatedBy,
    this.ataEffectiveStartDate,
    this.ataLastUpdatedDate,
    this.ataLastUpdatedBy,
    this.ataEffectiveEndDate,
    this.ataAssetTypeAttributeName,
    this.ataFlov,
    this.ataDisplay,
    this.ataStatus,
    this.ataFieldRequieredNotRequiredFlag,
    this.ataFieldEditableNonEditableFlag,
    this.attributeCatagory,
  });

  factory TypeAttrMaster.fromJson(Map<String, dynamic> json) => TypeAttrMaster(
        ataAssetTypeAttributeId: json["ata_asset_type_attribute_id"],
        ataAssetTypeAttributeCode: json["ata_asset_type_attribute_code"],
        ataAssetTypeAttributeDescription:
            json["ata_asset_type_attribute_description"],
        ataAssetTypeAttributeDatatype:
            json["ata_asset_type_attribute_datatype"],
        ataAssetTypeAttributeMandatoryFlag:
            json["ata_asset_type_attribute_mandatory_flag"],
        ataAssetTypeAttributeDefaultValue:
            json["ata_asset_type_attribute_default_value"],
        ataAssetTypeId: json["ata_asset_type_id"],
        ataCreationDate: json["ata_creation_date"],
        ataCreatedBy: json["ata_created_by"],
        ataEffectiveStartDate: json["ata_effective_start_date"],
        ataLastUpdatedDate: json["ata_last_updated_date"],
        ataLastUpdatedBy: json["ata_last_updated_by"],
        ataEffectiveEndDate: json["ata_effective_end_date"],
        ataAssetTypeAttributeName: json["ata_asset_type_attribute_name"],
        ataFlov: json["ata_flov"],
        ataDisplay: json["ata_display"],
        ataStatus: json["ata_status"],
        ataFieldRequieredNotRequiredFlag:
            json["ata_field_requiered_not_required_flag"],
        ataFieldEditableNonEditableFlag:
            json["ata_field_editable_non_editable_flag"],
        attributeCatagory: json["attribute_catagory"],
      );

  Map<String, dynamic> toJson() => {
        "ata_asset_type_attribute_id": ataAssetTypeAttributeId,
        "ata_asset_type_attribute_code": ataAssetTypeAttributeCode,
        "ata_asset_type_attribute_description":
            ataAssetTypeAttributeDescription,
        "ata_asset_type_attribute_datatype": ataAssetTypeAttributeDatatype,
        "ata_asset_type_attribute_mandatory_flag":
            ataAssetTypeAttributeMandatoryFlag,
        "ata_asset_type_attribute_default_value":
            ataAssetTypeAttributeDefaultValue,
        "ata_asset_type_id": ataAssetTypeId,
        "ata_creation_date": ataCreationDate,
        "ata_created_by": ataCreatedBy,
        "ata_effective_start_date": ataEffectiveStartDate,
        "ata_last_updated_date": ataLastUpdatedDate,
        "ata_last_updated_by": ataLastUpdatedBy,
        "ata_effective_end_date": ataEffectiveEndDate,
        "ata_asset_type_attribute_name": ataAssetTypeAttributeName,
        "ata_flov": ataFlov,
        "ata_display": ataDisplay,
        "ata_status": ataStatus,
        "ata_field_requiered_not_required_flag":
            ataFieldRequieredNotRequiredFlag,
        "ata_field_editable_non_editable_flag": ataFieldEditableNonEditableFlag,
        "attribute_catagory": attributeCatagory,
      };
}
