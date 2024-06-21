import 'package:ats_system/screens/site_gallery/models/gallery_model.dart';

abstract class GalleryManager {
  Future<int> add(GalleryModel account);

  Future<void> delete(int key);

  List<GalleryModel> accounts();

  GalleryModel? findById(int? accountId);

  GalleryModel? findByFilepath(String? filePath);

  Iterable<GalleryModel> export();

  Future<void> update(GalleryModel accountModel);

  Future<void> clear();
}
