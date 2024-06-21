// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'gallery_type.dart';

// **************************************************************************
// TypeAdapterGenerator
// **************************************************************************

class GalleryTypeAdapter extends TypeAdapter<GalleryType> {
  @override
  final int typeId = 1;

  @override
  GalleryType read(BinaryReader reader) {
    switch (reader.readByte()) {
      case 0:
        return GalleryType.photo;
      case 1:
        return GalleryType.video;
      default:
        return GalleryType.photo;
    }
  }

  @override
  void write(BinaryWriter writer, GalleryType obj) {
    switch (obj) {
      case GalleryType.photo:
        writer.writeByte(0);
        break;
      case GalleryType.video:
        writer.writeByte(1);
        break;
    }
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is GalleryTypeAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}
