import 'package:ats_system/utils/constants.dart';
import 'package:hive/hive.dart';

part 'attribute_model.g.dart';

class AttributeModel {
  List<AssetAttribute>? assetType;
  List<Operator>? operators;

  AttributeModel({
    this.assetType,
    this.operators,
  });

  factory AttributeModel.fromJson(Map<String, dynamic> json) => AttributeModel(
        assetType: json["asset_type"] == null
            ? []
            : List<AssetAttribute>.from(
                json["asset_type"]!.map((x) => AssetAttribute.fromJson(x))),
        operators: json["operators"] == null
            ? []
            : List<Operator>.from(
                json["operators"]!.map((x) => Operator.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "asset_type": assetType == null
            ? []
            : List<dynamic>.from(assetType!.map((x) => x.toJson())),
        "operators": operators == null
            ? []
            : List<dynamic>.from(operators!.map((x) => x.toJson())),
      };

  @override
  String toString() {
    return 'AttributeModel{assetType: $assetType, operators: $operators}';
  }
}

@HiveType(typeId: ASSET_ATTRIBUTE, adapterName: 'AssetAttrAdapter')
class AssetAttribute {
  @HiveField(0)
  int attributeId;
  @HiveField(1)
  String? attributeDatatype;
  @HiveField(2)
  int? ataAssetTypeId;
  @HiveField(3)
  String attributeName;
  @HiveField(4)
  String? display;
  @HiveField(5)
  String? status;
  @HiveField(6)
  String? editableNonEditableFlag;
  @HiveField(7)
  String? requieredNotRequiredFlag;
  @HiveField(8)
  int? attributeCatagory;
  @HiveField(9)
  String? assetType;
  @HiveField(10)
  String? ataFlov;
  @HiveField(11)
  String? value;

  AssetAttribute({
    required this.attributeId,
    this.attributeDatatype,
    this.ataAssetTypeId,
    required this.attributeName,
    this.display,
    this.status,
    this.editableNonEditableFlag,
    this.requieredNotRequiredFlag,
    this.attributeCatagory,
    this.assetType,
    this.ataFlov,
    this.value,
  });

  String get ataFlovWithDefaultValue => ataFlov!;

  factory AssetAttribute.fromJson(Map<String, dynamic> json) => AssetAttribute(
        attributeId: json["attribute_id"],
        attributeDatatype: json["attribute_datatype"],
        ataAssetTypeId: json["ata_asset_type_id"],
        attributeName: json["attribute_name"] ?? 'N/A',
        display: json["display"],
        status: json["status"],
        editableNonEditableFlag: json["editable_non_editable_flag"],
        requieredNotRequiredFlag: json["requiered_not_required_flag"],
        attributeCatagory: json["attribute_catagory"],
        assetType: json["AssetType"],
        ataFlov: json["ata_flov"],
        value: null,
      );

  Map<String, dynamic> toJson() => {
        "attribute_id": attributeId,
        "attribute_datatype": attributeDatatype,
        "ata_asset_type_id": ataAssetTypeId,
        "attribute_name": attributeName,
        "display": display,
        "status": status,
        "editable_non_editable_flag": editableNonEditableFlag,
        "requiered_not_required_flag": requieredNotRequiredFlag,
        "attribute_catagory": attributeCatagory,
        "AssetType": assetType,
        "ata_flov": ataFlov,
      };

  @override
  String toString() {
    return 'AssetAttribute{attributeId: $attributeId, attributeDatatype: $attributeDatatype, ataAssetTypeId: $ataAssetTypeId, attributeName: $attributeName, display: $display, status: $status, editableNonEditableFlag: $editableNonEditableFlag, requieredNotRequiredFlag: $requieredNotRequiredFlag, attributeCatagory: $attributeCatagory, assetType: $assetType, ataFlov: $ataFlov, value: $value}';
  }
}

class Operator {
  int? operatorId;
  String? operatorName;

  Operator({
    this.operatorId,
    this.operatorName,
  });

  factory Operator.fromJson(Map<String, dynamic> json) => Operator(
        operatorId: json["operator_id"],
        operatorName: json["operator_name"],
      );

  Map<String, dynamic> toJson() => {
        "operator_id": operatorId,
        "operator_name": operatorName,
      };

  @override
  String toString() {
    return 'Operator{operatorId: $operatorId, operatorName: $operatorName}';
  }
}
