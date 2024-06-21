// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'gallery_model.dart';

// **************************************************************************
// TypeAdapterGenerator
// **************************************************************************

class GalleryModelAdapter extends TypeAdapter<_$GalleryModelImpl> {
  @override
  final int typeId = 0;

  @override
  _$GalleryModelImpl read(BinaryReader reader) {
    final numOfFields = reader.readByte();
    final fields = <int, dynamic>{
      for (int i = 0; i < numOfFields; i++) reader.readByte(): reader.read(),
    };
    return _$GalleryModelImpl(
      galleryType: fields[0] as GalleryType?,
      filePath: fields[1] as String?,
      thumbnailPath: fields[2] as String?,
      description: fields[3] as String?,
      siteId: fields[4] as int?,
      superId: fields[5] as int?,
    );
  }

  @override
  void write(BinaryWriter writer, _$GalleryModelImpl obj) {
    writer
      ..writeByte(6)
      ..writeByte(0)
      ..write(obj.galleryType)
      ..writeByte(1)
      ..write(obj.filePath)
      ..writeByte(2)
      ..write(obj.thumbnailPath)
      ..writeByte(3)
      ..write(obj.description)
      ..writeByte(4)
      ..write(obj.siteId)
      ..writeByte(5)
      ..write(obj.superId);
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is GalleryModelAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}

// **************************************************************************
// JsonSerializableGenerator
// **************************************************************************

_$GalleryModelImpl _$$GalleryModelImplFromJson(Map<String, dynamic> json) =>
    _$GalleryModelImpl(
      galleryType:
          $enumDecodeNullable(_$GalleryTypeEnumMap, json['galleryType']),
      filePath: json['filePath'] as String?,
      thumbnailPath: json['thumbnailPath'] as String?,
      description: json['description'] as String?,
      siteId: json['siteId'] as int?,
      superId: json['superId'] as int?,
    );

Map<String, dynamic> _$$GalleryModelImplToJson(_$GalleryModelImpl instance) =>
    <String, dynamic>{
      'galleryType': _$GalleryTypeEnumMap[instance.galleryType],
      'filePath': instance.filePath,
      'thumbnailPath': instance.thumbnailPath,
      'description': instance.description,
      'siteId': instance.siteId,
      'superId': instance.superId,
    };

const _$GalleryTypeEnumMap = {
  GalleryType.photo: 'photo',
  GalleryType.video: 'video',
};
