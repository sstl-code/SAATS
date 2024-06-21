import 'package:ats_system/utils/constants.dart';
import 'package:hive/hive.dart';

part 'app_metadatum.g.dart';

@HiveType(typeId: COMMON_APP_META_DATA, adapterName: 'AppMetadataAdapter')
class AppMetadatum extends HiveObject {
  @HiveField(0)
  String? settingKey;
  @HiveField(1)
  String? settingValue;

  AppMetadatum({this.settingKey, this.settingValue});

  factory AppMetadatum.fromJson(Map<String, dynamic> json) {
    return AppMetadatum(
      settingKey: json['setting_key'] as String?,
      settingValue: json['setting_value'] as String?,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'setting_key': settingKey,
      'setting_value': settingValue,
    };
  }
}
