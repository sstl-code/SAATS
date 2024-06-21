import 'package:ats_system/screens/splash/datasource/app_metadata_manager.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/app_metadatum.dart';
import 'package:hive_flutter/adapters.dart';
import 'package:injectable/injectable.dart';

@Named("local-app-metadata")
@Singleton(as: AppMetaDataManager)
class LocalAppMetadataManagerImpl implements AppMetaDataManager {
  LocalAppMetadataManagerImpl({
    required this.metadataBox,
  });

  final Box<AppMetadatum> metadataBox;

  @override
  addAllMetaData(List<AppMetadatum>? list) async {
    await metadataBox.addAll(list ?? []);
  }

  @override
  Future<void> clear() async {
    await metadataBox.clear();
  }

  @override
  add(AppMetadatum item) async {
    await metadataBox.add(item);
  }

  @override
  AppMetadatum? getValueByKey(String? key) {
    return metadataBox.values
        .firstWhere((element) => element.settingKey == key);
  }
}
