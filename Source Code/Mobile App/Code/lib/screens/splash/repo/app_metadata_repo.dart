import 'package:ats_system/api_client/retrofit_client.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/common_meta_data.dart';
import 'package:injectable/injectable.dart';

abstract class AppMetaDataRepo {
  Future<CommonMetaData> getAppMetaData();
}

@Injectable(as: AppMetaDataRepo)
class MetaData extends AppMetaDataRepo {
  final RetrofitClient retrofitClient;
  MetaData({
    required this.retrofitClient,
  });

  @override
  Future<CommonMetaData> getAppMetaData() async {
    return await retrofitClient.getAppMetaData();
  }
}
