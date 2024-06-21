import 'package:ats_system/utils/log_util.dart';
import 'package:injectable/injectable.dart';
import 'package:package_info_plus/package_info_plus.dart';

abstract class PackageInfoService {
  Future<int> versionCode();
  Future<String> versionName();
}

@Injectable(as: PackageInfoService)
class PackageInfoImpl implements PackageInfoService {
  @override
  Future<int> versionCode() async {
    try {
      final packageInfo = await PackageInfo.fromPlatform();
      return int.parse(packageInfo.buildNumber);
    } catch (e) {
      LogUtil.logPrint('versionCodeException', e.toString());
      return 1;
    }
  }

  @override
  Future<String> versionName() async {
    try {
      final packageInfo = await PackageInfo.fromPlatform();
      return packageInfo.version;
    } catch (e) {
      LogUtil.logPrint('versionCodeException', e.toString());
      return '1.0.0';
    }
  }
}
