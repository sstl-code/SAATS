import 'package:ats_system/screens/splash/model/common_meta_data/app_metadatum.dart';

abstract class AppMetaDataManager {
  Future<void> clear();

  addAllMetaData(List<AppMetadatum>? list);

  add(AppMetadatum list);

  AppMetadatum? getValueByKey(String? key);
}
