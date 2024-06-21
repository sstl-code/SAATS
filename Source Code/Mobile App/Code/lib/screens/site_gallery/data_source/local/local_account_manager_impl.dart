import 'package:ats_system/screens/site_gallery/data_source/gallery_manager.dart';
import 'package:ats_system/screens/site_gallery/models/gallery_model.dart';
import 'package:collection/collection.dart';
import 'package:hive_flutter/adapters.dart';
import 'package:injectable/injectable.dart';

@Named("local-gallery")
@Singleton(as: GalleryManager)
class LocalAccountManagerImpl implements GalleryManager {
  LocalAccountManagerImpl({
    required this.accountBox,
  });

  final Box<GalleryModel> accountBox;

  @override
  List<GalleryModel> accounts() => accountBox.values.toList();

  @override
  Future<int> add(GalleryModel account) async {
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
  Iterable<GalleryModel> export() => accountBox.values;

  @override
  GalleryModel? findById(int? accountId) {
    return accountBox.values
        .firstWhereOrNull((element) => element.superId == accountId);
  }

  @override
  GalleryModel? findByFilepath(String? filePath) {
    return accountBox.values
        .firstWhereOrNull((element) => element.filePath == filePath);
  }

  @override
  Future<void> update(GalleryModel accountModel) {
    return accountBox.put(accountModel.superId!, accountModel);
  }
}
