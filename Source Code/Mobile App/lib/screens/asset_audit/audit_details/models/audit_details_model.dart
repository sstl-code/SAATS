class AuditDetailsModel {
  int? status;
  Static? auditDetailsModelStatic;
  List<DynamicAttributeValue>? dynamicAttributeValue;
  String? assetTypeName;
  String? parentAssetName;
  SiteCode? siteCode;
  List<AttributeName>? attributeName;
  List<AttributeValue>? attributeValue;

  AuditDetailsModel({
    this.status,
    this.auditDetailsModelStatic,
    this.dynamicAttributeValue,
    this.assetTypeName,
    this.parentAssetName,
    this.siteCode,
    this.attributeName,
    this.attributeValue,
  });

  factory AuditDetailsModel.fromJson(Map<String, dynamic> json) =>
      AuditDetailsModel(
        status: json["status"],
        auditDetailsModelStatic:
            json["static"] == null ? null : Static.fromJson(json["static"]),
        dynamicAttributeValue: json["dynamic_attribute_value"] == null
            ? []
            : List<DynamicAttributeValue>.from(json["dynamic_attribute_value"]!
                .map((x) => DynamicAttributeValue.fromJson(x))),
        assetTypeName: json["asset_type_name"],
        parentAssetName: json["parent_asset_name"],
        siteCode: json["site_code"] == null
            ? null
            : SiteCode.fromJson(json["site_code"]),
        attributeName: json["attribute_name"] == null
            ? []
            : List<AttributeName>.from(
                json["attribute_name"]!.map((x) => AttributeName.fromJson(x))),
        attributeValue: json["attribute_value"] == null
            ? []
            : List<AttributeValue>.from(json["attribute_value"]!
                .map((x) => AttributeValue.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "static": auditDetailsModelStatic?.toJson(),
        "dynamic_attribute_value": dynamicAttributeValue == null
            ? []
            : List<dynamic>.from(dynamicAttributeValue!.map((x) => x.toJson())),
        "site_code": siteCode?.toJson(),
        "asset_type_name": assetTypeName,
        "parent_asset_name": parentAssetName,
        "attribute_name": attributeName == null
            ? []
            : List<dynamic>.from(attributeName!.map((x) => x.toJson())),
        "attribute_value": attributeValue == null
            ? []
            : List<dynamic>.from(attributeValue!.map((x) => x)),
      };
}

class Static {
  int? taAssetId;
  int? taAssetTypeMasterId;
  String? taAssetTypeCode;
  String? taAssetManufactureSerialNo;
  String? taAssetName;
  String? taAssetDescription;
  String? taAssetTagNumber;
  int? taAssetParentId;
  int? taAssetLocationId;
  String? taAssetStatus;
  String? taCreationDate;
  String? taCreatedBy;
  String? taEffectiveStartDate;
  String? taLastUpdatedDate;
  String? taLastUpdatedBy;
  int? taEffectiveEndDate;
  dynamic taAssetLastTagScanDate;
  String? taAssetReason;
  String? taAssetImage;
  String? taAssetActiveInactiveStatus;
  dynamic taLastAuditDate;

  Static({
    this.taAssetId,
    this.taAssetTypeMasterId,
    this.taAssetTypeCode,
    this.taAssetManufactureSerialNo,
    this.taAssetName,
    this.taAssetDescription,
    this.taAssetTagNumber,
    this.taAssetParentId,
    this.taAssetLocationId,
    this.taAssetStatus,
    this.taCreationDate,
    this.taCreatedBy,
    this.taEffectiveStartDate,
    this.taLastUpdatedDate,
    this.taLastUpdatedBy,
    this.taEffectiveEndDate,
    this.taAssetLastTagScanDate,
    this.taAssetReason,
    this.taAssetImage,
    this.taAssetActiveInactiveStatus,
    this.taLastAuditDate,
  });

  factory Static.fromJson(Map<String, dynamic> json) => Static(
        taAssetId: json["ta_asset_id"],
        taAssetTypeMasterId: json["ta_asset_type_master_id"],
        taAssetTypeCode: json["ta_asset_type_code"],
        taAssetManufactureSerialNo: json["ta_asset_manufacture_serial_no"],
        taAssetName: json["ta_asset_name"],
        taAssetDescription: json["ta_asset_description"],
        taAssetTagNumber: json["ta_asset_tag_number"],
        taAssetParentId: json["ta_asset_parent_id"],
        taAssetLocationId: json["ta_asset_location_id"],
        taAssetStatus: json["ta_asset_status"],
        taCreationDate: json["ta_creation_date"],
        taCreatedBy: json["ta_created_by"],
        taEffectiveStartDate: json["ta_effective_start_date"],
        taLastUpdatedDate: json["ta_last_updated_date"],
        taLastUpdatedBy: json["ta_last_updated_by"],
        taEffectiveEndDate: json["ta_effective_end_date"],
        taAssetLastTagScanDate: json["ta_asset_last_tag_scan_date"],
        taAssetReason: json["ta_asset_reason"],
        taAssetImage: json["ta_asset_image"],
        taAssetActiveInactiveStatus: json["ta_asset_active_inactive_status"],
        taLastAuditDate: json["ta_last_audit_date"],
      );

  Map<String, dynamic> toJson() => {
        "ta_asset_id": taAssetId,
        "ta_asset_type_master_id": taAssetTypeMasterId,
        "ta_asset_type_code": taAssetTypeCode,
        "ta_asset_manufacture_serial_no": taAssetManufactureSerialNo,
        "ta_asset_name": taAssetName,
        "ta_asset_description": taAssetDescription,
        "ta_asset_tag_number": taAssetTagNumber,
        "ta_asset_parent_id": taAssetParentId,
        "ta_asset_location_id": taAssetLocationId,
        "ta_asset_status": taAssetStatus,
        "ta_creation_date": taCreationDate,
        "ta_created_by": taCreatedBy,
        "ta_effective_start_date": taEffectiveStartDate,
        "ta_last_updated_date": taLastUpdatedDate,
        "ta_last_updated_by": taLastUpdatedBy,
        "ta_effective_end_date": taEffectiveEndDate,
        "ta_asset_last_tag_scan_date": taAssetLastTagScanDate,
        "ta_asset_reason": taAssetReason,
        "ta_asset_image": taAssetImage,
        "ta_asset_active_inactive_status": taAssetActiveInactiveStatus,
        "ta_last_audit_date": taLastAuditDate,
      };
}

class DynamicAttributeValue {
  String? atAssetAttributeDescription;
  String? atAssetAttributeValueText;
  int? atAssetAttributeValueInteger;
  String? atAssetAttributeValueNumber;

  DynamicAttributeValue({
    this.atAssetAttributeDescription,
    this.atAssetAttributeValueText,
    this.atAssetAttributeValueInteger,
    this.atAssetAttributeValueNumber,
  });

  factory DynamicAttributeValue.fromJson(Map<String, dynamic> json) {
    return DynamicAttributeValue(
      atAssetAttributeDescription: json["at_asset_attribute_description"],
      atAssetAttributeValueText: json["at_asset_attribute_value_text"],
      atAssetAttributeValueInteger: json["at_asset_attribute_value_integer"],
      atAssetAttributeValueNumber: json["at_asset_attribute_value_number"],
    );
  }

  Map<String, dynamic> toJson() => {
        "at_asset_attribute_description": atAssetAttributeDescription,
        "at_asset_attribute_value_text": atAssetAttributeValueText,
        "at_asset_attribute_value_integer": atAssetAttributeValueInteger,
        "at_asset_attribute_value_number": atAssetAttributeValueNumber,
      };
}

class SiteCode {
  String? tlLocationCode;
  String? tlLocationAddress;
  String? tlLocationName;

  SiteCode({this.tlLocationCode, this.tlLocationAddress, this.tlLocationName});

  factory SiteCode.fromJson(Map<String, dynamic> json) => SiteCode(
        tlLocationCode: json["tl_location_code"],
        tlLocationAddress: json["tl_location_address"],
        tlLocationName: json["tl_location_name"],
      );

  Map<String, dynamic> toJson() => {
        "tl_location_code": tlLocationCode,
        "tl_location_address": tlLocationAddress,
        "tl_location_name": tlLocationName,
      };
}

class AttributeName {
  int? ataAssetTypeAttributeId;
  String? ataAssetTypeAttributeCode;
  String? ataAssetTypeAttributeDescription;
  String? ataAssetTypeAttributeDatatype;
  String? ataAssetTypeAttributeMandatoryFlag;
  String? ataAssetTypeAttributeDefaultValue;
  dynamic ataAssetTypeId;
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

  AttributeName({
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
  });

  factory AttributeName.fromJson(Map<String, dynamic> json) => AttributeName(
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
      };
}

class AttributeValue {
  int? atAssetAttributeId;
  int? atAssetTypeAttributeMasterId;
  int? atAssetId;
  String? atAssetAttributeCode;
  String? atAssetAttributeDescription;
  String? atCreationDate;
  String? atCreatedBy;
  String? atEffectiveStartDate;
  String? atLastUpdatedDate;
  String? atLastUpdatedBy;
  dynamic atEffectiveEndDate;
  String? atAssetAttributeValueNumber;
  dynamic atAssetAttributeValueInteger;
  dynamic atAssetAttributeValueDateType;
  String? atAssetAttributeValueText;

  AttributeValue({
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
    this.atAssetAttributeValueNumber,
    this.atAssetAttributeValueInteger,
    this.atAssetAttributeValueDateType,
    this.atAssetAttributeValueText,
  });

  factory AttributeValue.fromJson(Map<String, dynamic> json) => AttributeValue(
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
        atAssetAttributeValueNumber: json["at_asset_attribute_value_number"],
        atAssetAttributeValueInteger: json["at_asset_attribute_value_integer"],
        atAssetAttributeValueDateType:
            json["at_asset_attribute_value_date_type"],
        atAssetAttributeValueText: json["at_asset_attribute_value_text"],
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
        "at_asset_attribute_value_number": atAssetAttributeValueNumber,
        "at_asset_attribute_value_integer": atAssetAttributeValueInteger,
        "at_asset_attribute_value_date_type": atAssetAttributeValueDateType,
        "at_asset_attribute_value_text": atAssetAttributeValueText,
      };
}
