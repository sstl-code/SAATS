// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'asset_type_model.dart';

// **************************************************************************
// TypeAdapterGenerator
// **************************************************************************

class AssetTypeAdapter extends TypeAdapter<AssetType> {
  @override
  final int typeId = 6;

  @override
  AssetType read(BinaryReader reader) {
    final numOfFields = reader.readByte();
    final fields = <int, dynamic>{
      for (int i = 0; i < numOfFields; i++) reader.readByte(): reader.read(),
    };
    return AssetType(
      atAssetTypeName: fields[0] as String,
      atAssetTypeId: fields[1] as int,
      assetTypeCategory: fields[2] as String,
      isChildAvailable: fields[3] as int?,
    );
  }

  @override
  void write(BinaryWriter writer, AssetType obj) {
    writer
      ..writeByte(4)
      ..writeByte(0)
      ..write(obj.atAssetTypeName)
      ..writeByte(1)
      ..write(obj.atAssetTypeId)
      ..writeByte(2)
      ..write(obj.assetTypeCategory)
      ..writeByte(3)
      ..write(obj.isChildAvailable);
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is AssetTypeAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}
