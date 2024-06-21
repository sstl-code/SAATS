// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'app_metadatum.dart';

// **************************************************************************
// TypeAdapterGenerator
// **************************************************************************

class AppMetadataAdapter extends TypeAdapter<AppMetadatum> {
  @override
  final int typeId = 7;

  @override
  AppMetadatum read(BinaryReader reader) {
    final numOfFields = reader.readByte();
    final fields = <int, dynamic>{
      for (int i = 0; i < numOfFields; i++) reader.readByte(): reader.read(),
    };
    return AppMetadatum(
      settingKey: fields[0] as String?,
      settingValue: fields[1] as String?,
    );
  }

  @override
  void write(BinaryWriter writer, AppMetadatum obj) {
    writer
      ..writeByte(2)
      ..writeByte(0)
      ..write(obj.settingKey)
      ..writeByte(1)
      ..write(obj.settingValue);
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is AppMetadataAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}
