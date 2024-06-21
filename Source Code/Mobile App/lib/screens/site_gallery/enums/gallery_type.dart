import 'package:hive/hive.dart';

part 'gallery_type.g.dart';

@HiveType(typeId: 1, adapterName: 'GalleryTypeAdapter')
enum GalleryType {
  @HiveField(0)
  photo('Photo'),
  @HiveField(1)
  video('Video');

  final String value;
  const GalleryType(this.value);
}
