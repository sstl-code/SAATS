import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:freezed_annotation/freezed_annotation.dart';
import 'package:hive_flutter/adapters.dart';

part 'gallery_model.freezed.dart';
part 'gallery_model.g.dart';

@unfreezed
class GalleryModel extends HiveObject with _$GalleryModel {
  @HiveType(typeId: 0, adapterName: 'GalleryModelAdapter')
  factory GalleryModel({
    @HiveField(0) GalleryType? galleryType,
    @HiveField(1) String? filePath,
    @HiveField(2) String? thumbnailPath,
    @HiveField(3) String? description,
    @HiveField(4) int? siteId,
    @HiveField(5) int? superId,
  }) = _GalleryModel;

  GalleryModel._();

  factory GalleryModel.fromJson(Map<String, dynamic> json) =>
      _$GalleryModelFromJson(json);
}
