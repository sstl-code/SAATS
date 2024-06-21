import 'package:ats_system/utils/urls.dart';
import 'package:injectable/injectable.dart';

abstract class IConfig {
  String get baseUrl;

  Map<String, String> get headers;
}

@Injectable(as: IConfig)
class AppConfig extends IConfig {
  @override
  String get baseUrl => Urls.baseUrl;

  @override
  Map<String, String> get headers => {};
}
