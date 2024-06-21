import 'package:ats_system/utils/constants.dart';
import 'package:hive/hive.dart';

part 'asset_type_model.g.dart';

class AssetTypeModel {
  int status;
  List<AssetType> assetType;

  AssetTypeModel({required this.status, required this.assetType});

  factory AssetTypeModel.fromJson(Map<String, dynamic> json) => AssetTypeModel(
        status: json["status"],
        assetType: List<AssetType>.from(
            json["data"].map((x) => AssetType.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "data": List<dynamic>.from(assetType.map((x) => x.toJson())),
      };
}

@HiveType(typeId: ASSET_TYPE, adapterName: 'AssetTypeAdapter')
class AssetType {
  @HiveField(0)
  String atAssetTypeName;
  @HiveField(1)
  int atAssetTypeId;
  @HiveField(2)
  String assetTypeCategory;
  @HiveField(3)
  int? isChildAvailable;

  AssetType(
      {required this.atAssetTypeName,
      required this.atAssetTypeId,
      required this.assetTypeCategory,
      required this.isChildAvailable});

  factory AssetType.fromJson(Map<String, dynamic> json) => AssetType(
        atAssetTypeName: json["at_asset_type_name"],
        atAssetTypeId: json["at_asset_type_id"],
        assetTypeCategory: json["at_asset_type_category"],
        isChildAvailable: json["at_is_child_available"],
      );

  Map<String, dynamic> toJson() => {
        "at_asset_type_name": atAssetTypeName,
        "at_asset_type_id": atAssetTypeId,
        'at_asset_type_category': assetTypeCategory,
        'at_is_child_available': isChildAvailable,
      };
}
