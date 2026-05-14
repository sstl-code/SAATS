// GENERATED CODE - DO NOT MODIFY BY HAND

// **************************************************************************
// InjectableConfigGenerator
// **************************************************************************

// ignore_for_file: type=lint
// coverage:ignore-file

// ignore_for_file: no_leading_underscores_for_library_prefixes
import 'package:dio/dio.dart' as _i361;
import 'package:get_it/get_it.dart' as _i174;
import 'package:hive_flutter/adapters.dart' as _i744;
import 'package:injectable/injectable.dart' as _i526;
import 'package:shared_preferences/shared_preferences.dart' as _i460;

import '../api_client/api_client.dart' as _i274;
import '../api_client/config.dart' as _i497;
import '../api_client/retrofit_client.dart' as _i238;
import '../core/session_manager/session_manager.dart' as _i896;
import '../repository/internet_connection_service.dart' as _i801;
import '../repository/location_service.dart' as _i132;
import '../repository/navigation_service.dart' as _i727;
import '../screens/add_asset/data/add_asset_repository.dart' as _i743;
import '../screens/asset_audit/data/asset_audit_repository.dart' as _i558;
import '../screens/asset_details/data/asset_repository.dart' as _i471;
import '../screens/asset_details/models/single_asset_model.dart' as _i767;
import '../screens/auth/bloc/auth_bloc.dart' as _i362;
import '../screens/auth/data/login_repository.dart' as _i873;
import '../screens/auth/repo/auth_repo.dart' as _i523;
import '../screens/home/data/home_repository.dart' as _i303;
import '../screens/site_gallery/bloc/capture_file_bloc.dart' as _i484;
import '../screens/site_gallery/bloc/site_gallery_bloc.dart' as _i6;
import '../screens/site_gallery/models/gallery_model.dart' as _i764;
import '../screens/site_gallery/repo/site_gallery_repo.dart' as _i1043;
import '../screens/splash/bloc/app_metadata_bloc.dart' as _i68;
import '../screens/splash/datasource/app_metadata_manager.dart' as _i11;
import '../screens/splash/datasource/local/app_metadata_manager_impl.dart'
    as _i688;
import '../screens/splash/model/common_meta_data/app_metadatum.dart' as _i680;
import '../screens/splash/repo/app_metadata_repo.dart' as _i226;
import '../screens/task_list/data/task_repository.dart' as _i922;
import 'module/app_module.dart' as _i106;
import 'module/hive_module/hive_module.dart' as _i834;

// initializes the registration of main-scope dependencies inside of GetIt
Future<_i174.GetIt> init(
  _i174.GetIt getIt, {
  String? environment,
  _i526.EnvironmentFilter? environmentFilter,
}) async {
  final gh = _i526.GetItHelper(
    getIt,
    environment,
    environmentFilter,
  );
  final appModule = _$AppModule();
  final hiveBoxModule = _$HiveBoxModule();
  await gh.singletonAsync<_i460.SharedPreferences>(
    () => appModule.sharedPreferences,
    preResolve: true,
  );
  await gh.singletonAsync<_i744.Box<_i764.GalleryModel>>(
    () => hiveBoxModule.accountBox,
    preResolve: true,
  );
  await gh.singletonAsync<_i744.Box<_i767.SingleAsset>>(
    () => hiveBoxModule.categoryBox,
    preResolve: true,
  );
  await gh.singletonAsync<_i744.Box<_i680.AppMetadatum>>(
    () => hiveBoxModule.metadataBox,
    preResolve: true,
  );
  gh.singleton<_i727.NavigationService>(() => _i727.NavigationService());
  gh.lazySingleton<_i361.Dio>(() => appModule.dio);
  gh.factory<_i471.AssetDetailsService>(() => _i471.AssetDetailsServiceImpl());
  gh.factory<_i743.AddAssetService>(() => _i743.AddAssetServiceImpl());
  gh.factory<_i801.InternetConnectionService>(
      () => _i801.InternetConnectionImpl());
  gh.factory<_i922.MyTaskService>(() => _i922.MyTaskServiceImpl());
  gh.factory<_i497.IConfig>(() => _i497.AppConfig());
  gh.factory<_i558.AssetAuditService>(() => _i558.AssetAuditServiceImpl());
  gh.factory<_i132.LocationService>(() => _i132.LocationImpl());
  gh.factory<_i303.HomeRepository>(() => _i303.HomeRepositoryImpl());
  gh.lazySingleton<_i896.SessionManager>(
      () => _i896.SessionManager(gh<_i460.SharedPreferences>()));
  gh.factory<_i873.LoginApiService>(() => _i873.LoginApiImpl());
  gh.singleton<_i11.AppMetaDataManager>(
    () => _i688.LocalAppMetadataManagerImpl(
        metadataBox: gh<_i744.Box<_i680.AppMetadatum>>()),
    instanceName: 'local-app-metadata',
  );
  gh.factory<_i274.BaseHttpService>(() => _i274.HttpServiceImpl(
      internetConnection: gh<_i801.InternetConnectionService>()));
  gh.factory<_i238.RetrofitClient>(() => _i238.UserAuthClient(
        dio: gh<_i361.Dio>(),
        config: gh<_i497.IConfig>(),
      ));
  gh.factory<_i523.AuthRepo>(
      () => _i523.Auth(authClient: gh<_i238.RetrofitClient>()));
  gh.factory<_i1043.SiteGalleryRepo>(
      () => _i1043.Auth(authClient: gh<_i238.RetrofitClient>()));
  gh.factory<_i484.CaptureFileBloc>(() => _i484.CaptureFileBloc(
        gh<_i1043.SiteGalleryRepo>(),
        gh<_i801.InternetConnectionService>(),
      ));
  gh.factory<_i6.SiteGalleryBloc>(() => _i6.SiteGalleryBloc(
        gh<_i1043.SiteGalleryRepo>(),
        gh<_i801.InternetConnectionService>(),
      ));
  gh.factory<_i226.AppMetaDataRepo>(
      () => _i226.MetaData(retrofitClient: gh<_i238.RetrofitClient>()));
  gh.factory<_i362.AuthBloc>(() => _i362.AuthBloc(
        gh<_i523.AuthRepo>(),
        gh<_i801.InternetConnectionService>(),
      ));
  gh.factory<_i68.AppMetaDataBloc>(() => _i68.AppMetaDataBloc(
        gh<_i226.AppMetaDataRepo>(),
        gh<_i801.InternetConnectionService>(),
      ));
  return getIt;
}

class _$AppModule extends _i106.AppModule {}

class _$HiveBoxModule extends _i834.HiveBoxModule {}
