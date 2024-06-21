import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';

abstract class AddAssetManager {
  Future<int> add(SingleAsset account);

  Future<void> delete(int key);

  List<SingleAsset> accounts();

  SingleAsset? findById(int? accountId);

  SingleAsset? findBySerialNoAndLocationId(String? serialNo, int? locationId);

  SingleAsset? findByFilepath(String? filePath);

  Iterable<SingleAsset> export();

  Future<void> update(SingleAsset accountModel);

  Future<void> clear();
}
