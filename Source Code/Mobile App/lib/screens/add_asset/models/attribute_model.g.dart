// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'attribute_model.dart';

// **************************************************************************
// TypeAdapterGenerator
// **************************************************************************

class AssetAttrAdapter extends TypeAdapter<AssetAttribute> {
  @override
  final int typeId = 5;

  @override
  AssetAttribute read(BinaryReader reader) {
    final numOfFields = reader.readByte();
    final fields = <int, dynamic>{
      for (int i = 0; i < numOfFields; i++) reader.readByte(): reader.read(),
    };
    return AssetAttribute(
      attributeId: fields[0] as int,
      attributeDatatype: fields[1] as String?,
      ataAssetTypeId: fields[2] as int?,
      attributeName: fields[3] as String,
      display: fields[4] as String?,
      status: fields[5] as String?,
      editableNonEditableFlag: fields[6] as String?,
      requieredNotRequiredFlag: fields[7] as String?,
      attributeCatagory: fields[8] as int?,
      assetType: fields[9] as String?,
      ataFlov: fields[10] as String?,
      value: fields[11] as String?,
    );
  }

  @override
  void write(BinaryWriter writer, AssetAttribute obj) {
    writer
      ..writeByte(12)
      ..writeByte(0)
      ..write(obj.attributeId)
      ..writeByte(1)
      ..write(obj.attributeDatatype)
      ..writeByte(2)
      ..write(obj.ataAssetTypeId)
      ..writeByte(3)
      ..write(obj.attributeName)
      ..writeByte(4)
      ..write(obj.display)
      ..writeByte(5)
      ..write(obj.status)
      ..writeByte(6)
      ..write(obj.editableNonEditableFlag)
      ..writeByte(7)
      ..write(obj.requieredNotRequiredFlag)
      ..writeByte(8)
      ..write(obj.attributeCatagory)
      ..writeByte(9)
      ..write(obj.assetType)
      ..writeByte(10)
      ..write(obj.ataFlov)
      ..writeByte(11)
      ..write(obj.value);
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is AssetAttrAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}
