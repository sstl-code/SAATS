import 'package:ats_system/di/module/hive_module/hive_module.dart';
import 'package:get_it/get_it.dart';
import 'package:injectable/injectable.dart';

import 'di.config.dart';

@InjectableInit(
  asExtension: false,
  preferRelativeImports: true,
  throwOnMissingDependencies: true,
)
Future<GetIt> configInjector(
  GetIt getIt, {
  String? env,
  EnvironmentFilter? environmentFilter,
}) async {
  await HiveAdapters().initHive();

  return init(
    getIt,
    environmentFilter: environmentFilter,
    environment: env,
  );
}
