import 'package:ats_system/screens/add_asset/models/asset_type_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:hive/hive.dart';

part 'single_asset_model.g.dart';

class SingleAssetModel {
  int? status;
  SingleAsset? data;

  SingleAssetModel({
    this.status,
    this.data,
  });

  factory SingleAssetModel.fromJson(Map<String, dynamic> json) =>
      SingleAssetModel(
        status: json["status"],
        data: json["data"] is Map ? SingleAsset.fromJson(json["data"]) : null,
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "data": data,
      };

  @override
  String toString() {
    return 'SingleAssetModel{status: $status, data: $data}';
  }
}

@HiveType(typeId: SINGLE_ASSET_TYPE_ID, adapterName: 'SingleAssetAdapter')
class SingleAsset extends HiveObject {
  @HiveField(0)
  int? masterId;

  @HiveField(1)
  int? taAssetId;

  @HiveField(2)
  dynamic taAssetTypeMasterId;

  @HiveField(3)
  String? taAssetTypeCode;

  @HiveField(4)
  String? taAssetManufactureSerialNo;

  @HiveField(5)
  String? taAssetName;

  @HiveField(6)
  dynamic taAssetDescription;

  @HiveField(7)
  String? taAssetTagNumber;

  @HiveField(8)
  int? taAssetParentId;

  @HiveField(9)
  int? taAssetLocationId;

  @HiveField(10)
  String? taAssetCatagory;

  @HiveField(11)
  String? taCreationDate;

  @HiveField(12)
  dynamic taAssetReason;

  @HiveField(13)
  String? taAssetImage;

  @HiveField(14)
  dynamic taAssetActiveInactiveStatus;

  @HiveField(15)
  dynamic taLastAuditDate;

  @HiveField(16)
  int? operatorId;

  @HiveField(17)
  String? assetType;

  @HiveField(18)
  String? parentAssetName;

  @HiveField(19)
  String? operators;

  @HiveField(20)
  int? atIsChildAvailable;

  @HiveField(21)
  double? latitude;

  @HiveField(22)
  double? longitude;

  @HiveField(23)
  List<AssetTypeAttr>? typeAttr;

  @HiveField(24)
  List<SingleAsset>? childs;

  Locationtype? locationtype;

  @HiveField(25)
  int? superId;

  @HiveField(26)
  String? parentSerialNo;

  @HiveField(27)
  List<AssetAttribute> attributes = [];

  @HiveField(28)
  List<AssetType?> assetTypeList = [];

  @HiveField(29)
  AssetType? selectedAssetType;

  @HiveField(30)
  String? pickedFilePath;

  SingleAsset({
    this.masterId,
    this.taAssetId,
    this.taAssetTypeMasterId,
    this.taAssetTypeCode,
    this.taAssetManufactureSerialNo,
    this.taAssetName,
    this.taAssetDescription,
    this.taAssetTagNumber,
    this.taAssetParentId,
    this.taAssetLocationId,
    this.taAssetCatagory,
    this.taCreationDate,
    this.taAssetReason,
    this.taAssetImage,
    this.taAssetActiveInactiveStatus,
    this.taLastAuditDate,
    this.operatorId,
    this.assetType,
    this.parentAssetName,
    this.operators,
    this.atIsChildAvailable,
    this.typeAttr,
    this.childs,
    this.locationtype,
    this.latitude,
    this.longitude,
  });

  factory SingleAsset.fromJson(Map<String, dynamic> json) => SingleAsset(
        masterId: json["master_id"],
        taAssetId: json["ta_asset_id"],
        taAssetTypeMasterId: json["ta_asset_type_master_id"],
        taAssetTypeCode: json["ta_asset_type_code"],
        taAssetManufactureSerialNo: json["ta_asset_manufacture_serial_no"],
        taAssetName: json["ta_asset_name"],
        taAssetDescription: json["ta_asset_description"],
        taAssetTagNumber: json["ta_asset_tag_number"],
        taAssetParentId: json["ta_asset_parent_id"],
        taAssetLocationId: json["ta_asset_location_id"],
        taAssetCatagory: json["ta_asset_catagory"],
        taCreationDate: json["ta_creation_date"],
        taAssetReason: json["ta_asset_reason"],
        taAssetImage: json["ta_asset_image"],
        taAssetActiveInactiveStatus: json["ta_asset_active_inactive_status"],
        taLastAuditDate: json["ta_last_audit_date"],
        operatorId: json["operator_id"],
        assetType: json["AssetType"],
        parentAssetName: json["ParentAssetName"],
        operators: json["operators"],
        atIsChildAvailable: json["at_is_child_available"],
        longitude: json["longitude"],
        latitude: json["latitude"],
        typeAttr: json["TypeAttr"] == null
            ? []
            : List<AssetTypeAttr>.from(
                json["TypeAttr"]!.map((x) => AssetTypeAttr.fromJson(x))),
        childs: json["childs"] == null
            ? []
            : List<SingleAsset>.from(
                json["childs"]!.map((x) => SingleAsset.fromJson(x))),
        locationtype: Locationtype.fromJson(
            json["locationtype"] is Map ? json["locationtype"] : {}),
      );

  Map<String, dynamic> toJson() => {
        "master_id": masterId,
        "ta_asset_id": taAssetId,
        "ta_asset_type_master_id": taAssetTypeMasterId,
        "ta_asset_type_code": taAssetTypeCode,
        "ta_asset_manufacture_serial_no": taAssetManufactureSerialNo,
        "ta_asset_name": taAssetName,
        "ta_asset_description": taAssetDescription,
        "ta_asset_tag_number": taAssetTagNumber,
        "ta_asset_parent_id": taAssetParentId,
        "ta_asset_location_id": taAssetLocationId,
        "ta_asset_catagory": taAssetCatagory,
        "ta_creation_date": taCreationDate,
        "ta_asset_reason": taAssetReason,
        "ta_asset_image": taAssetImage,
        "ta_asset_active_inactive_status": taAssetActiveInactiveStatus,
        "ta_last_audit_date": taLastAuditDate,
        "operator_id": operatorId,
        "AssetType": assetType,
        "ParentAssetName": parentAssetName,
        "operators": operators,
        "at_is_child_available": atIsChildAvailable,
        "longitude": longitude,
        "latitude": latitude,
        "TypeAttr": typeAttr == null
            ? []
            : List<dynamic>.from(typeAttr!.map((x) => x.toJson())),
        "childs":
            childs == null ? [] : List<dynamic>.from(childs!.map((x) => x)),
        "locationtype": locationtype,
      };

  @override
  String toString() {
    return 'SingleAsset{masterId: $masterId, taAssetId: $taAssetId, taAssetTypeMasterId: $taAssetTypeMasterId, taAssetTypeCode: $taAssetTypeCode, taAssetManufactureSerialNo: $taAssetManufactureSerialNo, taAssetName: $taAssetName, taAssetDescription: $taAssetDescription, taAssetTagNumber: $taAssetTagNumber, taAssetParentId: $taAssetParentId, taAssetLocationId: $taAssetLocationId, taAssetCatagory: $taAssetCatagory, taCreationDate: $taCreationDate, taAssetReason: $taAssetReason, taAssetImage: $taAssetImage, taAssetActiveInactiveStatus: $taAssetActiveInactiveStatus, taLastAuditDate: $taLastAuditDate, operatorId: $operatorId, assetType: $assetType, operators: $operators, typeAttr: $typeAttr, childs: $childs, locationtype: $locationtype}';
  }
}

class Locationtype {
  int? tlLocationId;
  int? tlLocationTypeMasterId;
  String? tlLocationType;
  String? tlLocationCode;
  dynamic tlLocationAddress;
  dynamic tlLocationDescription;
  dynamic tlLocationStatus;
  dynamic tlLocationRegion;
  dynamic tlLocationLatitude;
  dynamic tlLocationLongitude;
  dynamic tlCreationDate;
  dynamic tlCreatedBy;
  dynamic tlEffectiveStartDate;
  dynamic tlLastUpdatedDate;
  dynamic tlLastUpdatedBy;
  dynamic tlEffectiveEndDate;
  String? tlLocationName;
  String? createdAt;
  String? updatedAt;
  dynamic deletedAt;
  String? taggingStatus;
  List<Location>? location;

  Locationtype({
    this.tlLocationId,
    this.tlLocationTypeMasterId,
    this.tlLocationType,
    this.tlLocationCode,
    this.tlLocationAddress,
    this.tlLocationDescription,
    this.tlLocationStatus,
    this.tlLocationRegion,
    this.tlLocationLatitude,
    this.tlLocationLongitude,
    this.tlCreationDate,
    this.tlCreatedBy,
    this.tlEffectiveStartDate,
    this.tlLastUpdatedDate,
    this.tlLastUpdatedBy,
    this.tlEffectiveEndDate,
    this.tlLocationName,
    this.createdAt,
    this.updatedAt,
    this.deletedAt,
    this.taggingStatus,
    this.location,
  });

  factory Locationtype.fromJson(Map<String, dynamic> json) => Locationtype(
        tlLocationId: json["tl_location_id"],
        tlLocationTypeMasterId: json["tl_location_type_master_id"],
        tlLocationType: json["tl_location_type"],
        tlLocationCode: json["tl_location_code"],
        tlLocationAddress: json["tl_location_address"],
        tlLocationDescription: json["tl_location_description"],
        tlLocationStatus: json["tl_location_status"],
        tlLocationRegion: json["tl_location_region"],
        tlLocationLatitude: json["tl_location_latitude"],
        tlLocationLongitude: json["tl_location_longitude"],
        tlCreationDate: json["tl_creation_date"],
        tlCreatedBy: json["tl_created_by"],
        tlEffectiveStartDate: json["tl_effective_start_date"],
        tlLastUpdatedDate: json["tl_last_updated_date"],
        tlLastUpdatedBy: json["tl_last_updated_by"],
        tlEffectiveEndDate: json["tl_effective_end_date"],
        tlLocationName: json["tl_location_name"],
        createdAt: json["created_at"],
        updatedAt: json["updated_at"],
        deletedAt: json["deleted_at"],
        taggingStatus: json["tagging_status"],
        location: json["location"] == null
            ? []
            : List<Location>.from(
                json["location"]!.map((x) => Location.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "tl_location_id": tlLocationId,
        "tl_location_type_master_id": tlLocationTypeMasterId,
        "tl_location_type": tlLocationType,
        "tl_location_code": tlLocationCode,
        "tl_location_address": tlLocationAddress,
        "tl_location_description": tlLocationDescription,
        "tl_location_status": tlLocationStatus,
        "tl_location_region": tlLocationRegion,
        "tl_location_latitude": tlLocationLatitude,
        "tl_location_longitude": tlLocationLongitude,
        "tl_creation_date": tlCreationDate,
        "tl_created_by": tlCreatedBy,
        "tl_effective_start_date": tlEffectiveStartDate,
        "tl_last_updated_date": tlLastUpdatedDate,
        "tl_last_updated_by": tlLastUpdatedBy,
        "tl_effective_end_date": tlEffectiveEndDate,
        "tl_location_name": tlLocationName,
        "created_at": createdAt,
        "updated_at": updatedAt,
        "deleted_at": deletedAt,
        "tagging_status": taggingStatus,
        "location": location == null
            ? []
            : List<dynamic>.from(location!.map((x) => x.toJson())),
      };
}

class Location {
  int? tlaLocationAttributeId;
  int? tlaLocationAttributeMasterId;
  int? tlaLocationId;
  String? tlaLocationAttributeName;
  dynamic tlaLocationAttributeDescription;
  dynamic tlaCreationDate;
  dynamic tlaCreatedBy;
  dynamic tlaEffectiveStartDate;
  dynamic tlaLastUpdatedDate;
  dynamic tlaLastUpdatedBy;
  dynamic tlaEffectiveEndDate;
  String? tlaLocationAttributeValueText;
  String? createdAt;
  String? updatedAt;
  dynamic deletedAt;

  Location({
    this.tlaLocationAttributeId,
    this.tlaLocationAttributeMasterId,
    this.tlaLocationId,
    this.tlaLocationAttributeName,
    this.tlaLocationAttributeDescription,
    this.tlaCreationDate,
    this.tlaCreatedBy,
    this.tlaEffectiveStartDate,
    this.tlaLastUpdatedDate,
    this.tlaLastUpdatedBy,
    this.tlaEffectiveEndDate,
    this.tlaLocationAttributeValueText,
    this.createdAt,
    this.updatedAt,
    this.deletedAt,
  });

  factory Location.fromJson(Map<String, dynamic> json) => Location(
        tlaLocationAttributeId: json["tla_location_attribute_id"],
        tlaLocationAttributeMasterId: json["tla_location_attribute_master_id"],
        tlaLocationId: json["tla_location_id"],
        tlaLocationAttributeName: json["tla_location_attribute_name"],
        tlaLocationAttributeDescription:
            json["tla_location_attribute_description"],
        tlaCreationDate: json["tla_creation_date"],
        tlaCreatedBy: json["tla_created_by"],
        tlaEffectiveStartDate: json["tla_effective_start_date"],
        tlaLastUpdatedDate: json["tla_last_updated_date"],
        tlaLastUpdatedBy: json["tla_last_updated_by"],
        tlaEffectiveEndDate: json["tla_effective_end_date"],
        tlaLocationAttributeValueText:
            json["tla_location_attribute_value_text"],
        createdAt: json["created_at"],
        updatedAt: json["updated_at"],
        deletedAt: json["deleted_at"],
      );

  Map<String, dynamic> toJson() => {
        "tla_location_attribute_id": tlaLocationAttributeId,
        "tla_location_attribute_master_id": tlaLocationAttributeMasterId,
        "tla_location_id": tlaLocationId,
        "tla_location_attribute_name": tlaLocationAttributeName,
        "tla_location_attribute_description": tlaLocationAttributeDescription,
        "tla_creation_date": tlaCreationDate,
        "tla_created_by": tlaCreatedBy,
        "tla_effective_start_date": tlaEffectiveStartDate,
        "tla_last_updated_date": tlaLastUpdatedDate,
        "tla_last_updated_by": tlaLastUpdatedBy,
        "tla_effective_end_date": tlaEffectiveEndDate,
        "tla_location_attribute_value_text": tlaLocationAttributeValueText,
        "created_at": createdAt,
        "updated_at": updatedAt,
        "deleted_at": deletedAt,
      };
}

@HiveType(typeId: ASSET_TYPE_ATTR, adapterName: 'AssetTypeAttrAdapter')
class AssetTypeAttr {
  @HiveField(0)
  int? atAssetAttributeId;
  @HiveField(1)
  int? atAssetTypeAttributeMasterId;
  @HiveField(2)
  int? atAssetId;
  @HiveField(3)
  String? atAssetAttributeCode;
  @HiveField(4)
  String? atAssetAttributeDescription;
  @HiveField(5)
  String? atCreationDate;
  @HiveField(6)
  String? atAssetAttributeValueText;
  @HiveField(7)
  AttrMaster? typeAttrMaster;

  AssetTypeAttr({
    this.atAssetAttributeId,
    this.atAssetTypeAttributeMasterId,
    this.atAssetId,
    this.atAssetAttributeCode,
    this.atAssetAttributeDescription,
    this.atCreationDate,
    this.atAssetAttributeValueText,
    this.typeAttrMaster,
  });

  factory AssetTypeAttr.fromJson(Map<String, dynamic> json) => AssetTypeAttr(
        atAssetAttributeId: json["at_asset_attribute_id"],
        atAssetTypeAttributeMasterId: json["at_asset_type_attribute_master_id"],
        atAssetId: json["at_asset_id"],
        atAssetAttributeCode: json["at_asset_attribute_code"],
        atAssetAttributeDescription: json["at_asset_attribute_description"],
        atCreationDate: json["at_creation_date"],
        atAssetAttributeValueText: json["at_asset_attribute_value_text"],
        typeAttrMaster: AttrMaster.fromJson(
            json["TypeAttrMaster"] is Map ? json["TypeAttrMaster"] : {}),
      );

  Map<String, dynamic> toJson() => {
        "at_asset_attribute_id": atAssetAttributeId,
        "at_asset_type_attribute_master_id": atAssetTypeAttributeMasterId,
        "at_asset_id": atAssetId,
        "at_asset_attribute_code": atAssetAttributeCode,
        "at_asset_attribute_description": atAssetAttributeDescription,
        "at_creation_date": atCreationDate,
        "at_asset_attribute_value_text": atAssetAttributeValueText,
        "TypeAttrMaster": typeAttrMaster,
      };
}

@HiveType(typeId: ATTR_MASTER, adapterName: 'AttrMasterAdapter')
class AttrMaster {
  @HiveField(0)
  int? ataAssetTypeAttributeId;
  @HiveField(1)
  String? ataAssetTypeAttributeCode;
  @HiveField(2)
  String? ataAssetTypeAttributeDescription;
  @HiveField(3)
  String? ataAssetTypeAttributeDatatype;
  @HiveField(4)
  String? ataAssetTypeAttributeMandatoryFlag;
  @HiveField(5)
  dynamic ataAssetTypeAttributeDefaultValue;
  @HiveField(6)
  int? ataAssetTypeId;
  @HiveField(7)
  String? ataAssetTypeAttributeName;
  @HiveField(8)
  String? ataFlov;
  @HiveField(9)
  String? ataDisplay;
  @HiveField(10)
  String? ataStatus;
  @HiveField(11)
  String? ataFieldRequieredNotRequiredFlag;
  @HiveField(12)
  String? ataFieldEditableNonEditableFlag;
  @HiveField(13)
  int? attributeCategory;

  AttrMaster({
    this.ataAssetTypeAttributeId,
    this.ataAssetTypeAttributeCode,
    this.ataAssetTypeAttributeDescription,
    this.ataAssetTypeAttributeDatatype,
    this.ataAssetTypeAttributeMandatoryFlag,
    this.ataAssetTypeAttributeDefaultValue,
    this.ataAssetTypeId,
    this.ataAssetTypeAttributeName,
    this.ataFlov,
    this.ataDisplay,
    this.ataStatus,
    this.ataFieldRequieredNotRequiredFlag,
    this.ataFieldEditableNonEditableFlag,
    this.attributeCategory,
  });

  factory AttrMaster.fromJson(Map<String, dynamic> json) => AttrMaster(
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
        ataAssetTypeAttributeName: json["ata_asset_type_attribute_name"],
        ataFlov: json["ata_flov"],
        ataDisplay: json["ata_display"],
        ataStatus: json["ata_status"],
        ataFieldRequieredNotRequiredFlag:
            json["ata_field_requiered_not_required_flag"],
        ataFieldEditableNonEditableFlag:
            json["ata_field_editable_non_editable_flag"],
        attributeCategory: json["attribute_catagory"],
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
        "ata_asset_type_attribute_name": ataAssetTypeAttributeName,
        "ata_flov": ataFlov,
        "ata_display": ataDisplay,
        "ata_status": ataStatus,
        "ata_field_requiered_not_required_flag":
            ataFieldRequieredNotRequiredFlag,
        "ata_field_editable_non_editable_flag": ataFieldEditableNonEditableFlag,
        "attribute_catagory": attributeCategory,
      };
}
