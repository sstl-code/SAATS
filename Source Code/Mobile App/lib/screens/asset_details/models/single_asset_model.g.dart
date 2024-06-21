// GENERATED CODE - DO NOT MODIFY BY HAND

part of 'single_asset_model.dart';

// **************************************************************************
// TypeAdapterGenerator
// **************************************************************************

class SingleAssetAdapter extends TypeAdapter<SingleAsset> {
  @override
  final int typeId = 2;

  @override
  SingleAsset read(BinaryReader reader) {
    final numOfFields = reader.readByte();
    final fields = <int, dynamic>{
      for (int i = 0; i < numOfFields; i++) reader.readByte(): reader.read(),
    };
    return SingleAsset(
      masterId: fields[0] as int?,
      taAssetId: fields[1] as int?,
      taAssetTypeMasterId: fields[2] as dynamic,
      taAssetTypeCode: fields[3] as String?,
      taAssetManufactureSerialNo: fields[4] as String?,
      taAssetName: fields[5] as String?,
      taAssetDescription: fields[6] as dynamic,
      taAssetTagNumber: fields[7] as String?,
      taAssetParentId: fields[8] as int?,
      taAssetLocationId: fields[9] as int?,
      taAssetCatagory: fields[10] as String?,
      taCreationDate: fields[11] as String?,
      taAssetReason: fields[12] as dynamic,
      taAssetImage: fields[13] as String?,
      taAssetActiveInactiveStatus: fields[14] as dynamic,
      taLastAuditDate: fields[15] as dynamic,
      operatorId: fields[16] as int?,
      assetType: fields[17] as String?,
      parentAssetName: fields[18] as String?,
      operators: fields[19] as String?,
      atIsChildAvailable: fields[20] as int?,
      typeAttr: (fields[23] as List?)?.cast<AssetTypeAttr>(),
      childs: (fields[24] as List?)?.cast<SingleAsset>(),
      latitude: fields[21] as double?,
      longitude: fields[22] as double?,
    )
      ..superId = fields[25] as int?
      ..parentSerialNo = fields[26] as String?
      ..attributes = (fields[27] as List).cast<AssetAttribute>()
      ..assetTypeList = (fields[28] as List).cast<AssetType?>()
      ..selectedAssetType = fields[29] as AssetType?
      ..pickedFilePath = fields[30] as String?;
  }

  @override
  void write(BinaryWriter writer, SingleAsset obj) {
    writer
      ..writeByte(31)
      ..writeByte(0)
      ..write(obj.masterId)
      ..writeByte(1)
      ..write(obj.taAssetId)
      ..writeByte(2)
      ..write(obj.taAssetTypeMasterId)
      ..writeByte(3)
      ..write(obj.taAssetTypeCode)
      ..writeByte(4)
      ..write(obj.taAssetManufactureSerialNo)
      ..writeByte(5)
      ..write(obj.taAssetName)
      ..writeByte(6)
      ..write(obj.taAssetDescription)
      ..writeByte(7)
      ..write(obj.taAssetTagNumber)
      ..writeByte(8)
      ..write(obj.taAssetParentId)
      ..writeByte(9)
      ..write(obj.taAssetLocationId)
      ..writeByte(10)
      ..write(obj.taAssetCatagory)
      ..writeByte(11)
      ..write(obj.taCreationDate)
      ..writeByte(12)
      ..write(obj.taAssetReason)
      ..writeByte(13)
      ..write(obj.taAssetImage)
      ..writeByte(14)
      ..write(obj.taAssetActiveInactiveStatus)
      ..writeByte(15)
      ..write(obj.taLastAuditDate)
      ..writeByte(16)
      ..write(obj.operatorId)
      ..writeByte(17)
      ..write(obj.assetType)
      ..writeByte(18)
      ..write(obj.parentAssetName)
      ..writeByte(19)
      ..write(obj.operators)
      ..writeByte(20)
      ..write(obj.atIsChildAvailable)
      ..writeByte(21)
      ..write(obj.latitude)
      ..writeByte(22)
      ..write(obj.longitude)
      ..writeByte(23)
      ..write(obj.typeAttr)
      ..writeByte(24)
      ..write(obj.childs)
      ..writeByte(25)
      ..write(obj.superId)
      ..writeByte(26)
      ..write(obj.parentSerialNo)
      ..writeByte(27)
      ..write(obj.attributes)
      ..writeByte(28)
      ..write(obj.assetTypeList)
      ..writeByte(29)
      ..write(obj.selectedAssetType)
      ..writeByte(30)
      ..write(obj.pickedFilePath);
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is SingleAssetAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}

class AssetTypeAttrAdapter extends TypeAdapter<AssetTypeAttr> {
  @override
  final int typeId = 3;

  @override
  AssetTypeAttr read(BinaryReader reader) {
    final numOfFields = reader.readByte();
    final fields = <int, dynamic>{
      for (int i = 0; i < numOfFields; i++) reader.readByte(): reader.read(),
    };
    return AssetTypeAttr(
      atAssetAttributeId: fields[0] as int?,
      atAssetTypeAttributeMasterId: fields[1] as int?,
      atAssetId: fields[2] as int?,
      atAssetAttributeCode: fields[3] as String?,
      atAssetAttributeDescription: fields[4] as String?,
      atCreationDate: fields[5] as String?,
      atAssetAttributeValueText: fields[6] as String?,
      typeAttrMaster: fields[7] as AttrMaster?,
    );
  }

  @override
  void write(BinaryWriter writer, AssetTypeAttr obj) {
    writer
      ..writeByte(8)
      ..writeByte(0)
      ..write(obj.atAssetAttributeId)
      ..writeByte(1)
      ..write(obj.atAssetTypeAttributeMasterId)
      ..writeByte(2)
      ..write(obj.atAssetId)
      ..writeByte(3)
      ..write(obj.atAssetAttributeCode)
      ..writeByte(4)
      ..write(obj.atAssetAttributeDescription)
      ..writeByte(5)
      ..write(obj.atCreationDate)
      ..writeByte(6)
      ..write(obj.atAssetAttributeValueText)
      ..writeByte(7)
      ..write(obj.typeAttrMaster);
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is AssetTypeAttrAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}

class AttrMasterAdapter extends TypeAdapter<AttrMaster> {
  @override
  final int typeId = 4;

  @override
  AttrMaster read(BinaryReader reader) {
    final numOfFields = reader.readByte();
    final fields = <int, dynamic>{
      for (int i = 0; i < numOfFields; i++) reader.readByte(): reader.read(),
    };
    return AttrMaster(
      ataAssetTypeAttributeId: fields[0] as int?,
      ataAssetTypeAttributeCode: fields[1] as String?,
      ataAssetTypeAttributeDescription: fields[2] as String?,
      ataAssetTypeAttributeDatatype: fields[3] as String?,
      ataAssetTypeAttributeMandatoryFlag: fields[4] as String?,
      ataAssetTypeAttributeDefaultValue: fields[5] as dynamic,
      ataAssetTypeId: fields[6] as int?,
      ataAssetTypeAttributeName: fields[7] as String?,
      ataFlov: fields[8] as String?,
      ataDisplay: fields[9] as String?,
      ataStatus: fields[10] as String?,
      ataFieldRequieredNotRequiredFlag: fields[11] as String?,
      ataFieldEditableNonEditableFlag: fields[12] as String?,
      attributeCategory: fields[13] as int?,
    );
  }

  @override
  void write(BinaryWriter writer, AttrMaster obj) {
    writer
      ..writeByte(14)
      ..writeByte(0)
      ..write(obj.ataAssetTypeAttributeId)
      ..writeByte(1)
      ..write(obj.ataAssetTypeAttributeCode)
      ..writeByte(2)
      ..write(obj.ataAssetTypeAttributeDescription)
      ..writeByte(3)
      ..write(obj.ataAssetTypeAttributeDatatype)
      ..writeByte(4)
      ..write(obj.ataAssetTypeAttributeMandatoryFlag)
      ..writeByte(5)
      ..write(obj.ataAssetTypeAttributeDefaultValue)
      ..writeByte(6)
      ..write(obj.ataAssetTypeId)
      ..writeByte(7)
      ..write(obj.ataAssetTypeAttributeName)
      ..writeByte(8)
      ..write(obj.ataFlov)
      ..writeByte(9)
      ..write(obj.ataDisplay)
      ..writeByte(10)
      ..write(obj.ataStatus)
      ..writeByte(11)
      ..write(obj.ataFieldRequieredNotRequiredFlag)
      ..writeByte(12)
      ..write(obj.ataFieldEditableNonEditableFlag)
      ..writeByte(13)
      ..write(obj.attributeCategory);
  }

  @override
  int get hashCode => typeId.hashCode;

  @override
  bool operator ==(Object other) =>
      identical(this, other) ||
      other is AttrMasterAdapter &&
          runtimeType == other.runtimeType &&
          typeId == other.typeId;
}
