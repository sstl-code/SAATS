import 'package:ats_system/screens/add_asset/data_source/add_asset_manager.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:collection/collection.dart';
import 'package:hive_flutter/adapters.dart';
import 'package:injectable/injectable.dart';

@Named("local-add-asset")
@Singleton(as: AddAssetManager)
class LocalAddAssetManagerImpl implements AddAssetManager {
  LocalAddAssetManagerImpl({
    required this.accountBox,
  });

  final Box<SingleAsset> accountBox;

  @override
  List<SingleAsset> accounts() => accountBox.values.toList();

  @override
  Future<int> add(SingleAsset account) async {
    final int id = await accountBox.add(account);
    account.superId = id;
    await account.save();
    return id;
  }

  @override
  Future<void> clear() => accountBox.clear();

  @override
  Future<void> delete(int key) async => accountBox.delete(key);

  @override
  Iterable<SingleAsset> export() => accountBox.values;

  @override
  SingleAsset? findById(int? accountId) {
    return accountBox.values
        .firstWhereOrNull((element) => element.superId == accountId);
  }

  @override
  SingleAsset? findBySerialNoAndLocationId(String? serialNo, int? locationId) {
    return accountBox.values.firstWhereOrNull((element) =>
        element.taAssetManufactureSerialNo == serialNo &&
        element.taAssetLocationId == locationId);
  }

  @override
  Future<void> update(SingleAsset accountModel) {
    return accountBox.put(accountModel.superId!, accountModel);
  }

  @override
  SingleAsset? findByFilepath(String? filePath) {
    throw UnimplementedError();
  }
}
