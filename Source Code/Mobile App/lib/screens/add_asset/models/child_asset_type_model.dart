import 'package:ats_system/screens/add_asset/models/asset_type_model.dart';

class ChildAssetTypeModel {
  String status;
  List<AssetType> assetType;

  ChildAssetTypeModel({
    required this.status,
    required this.assetType,
  });

  factory ChildAssetTypeModel.fromJson(Map<String, dynamic> json) =>
      ChildAssetTypeModel(
        status: json["status"],
        assetType: List<AssetType>.from(
            json["asset_type"].map((x) => AssetType.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "asset_type": List<dynamic>.from(assetType.map((x) => x.toJson())),
      };
}
