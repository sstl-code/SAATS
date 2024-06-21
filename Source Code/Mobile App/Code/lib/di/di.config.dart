// GENERATED CODE - DO NOT MODIFY BY HAND

// **************************************************************************
// InjectableConfigGenerator
// **************************************************************************

// ignore_for_file: type=lint
// coverage:ignore-file

// ignore_for_file: no_leading_underscores_for_library_prefixes
import 'package:dio/dio.dart' as _i26;
import 'package:get_it/get_it.dart' as _i1;
import 'package:hive_flutter/adapters.dart' as _i6;
import 'package:injectable/injectable.dart' as _i2;
import 'package:shared_preferences/shared_preferences.dart' as _i20;

import '../api_client/api_client.dart' as _i25;
import '../api_client/config.dart' as _i13;
import '../api_client/dio_provider.dart' as _i38;
import '../api_client/retrofit_client.dart' as _i27;
import '../core/session_manager/session_manager.dart' as _i28;
import '../core/session_manager/shared_preference.dart' as _i37;
import '../repository/internet_connection_service.dart' as _i14;
import '../repository/location_service.dart' as _i15;
import '../repository/navigation_service.dart' as _i18;
import '../repository/package_info_service.dart' as _i19;
import '../screens/add_asset/data/add_asset_repository.dart' as _i3;
import '../screens/add_asset/data_source/add_asset_manager.dart' as _i21;
import '../screens/add_asset/data_source/local/local_add_asset_manager_impl.dart'
    as _i22;
import '../screens/asset_audit/data/asset_audit_repository.dart' as _i4;
import '../screens/asset_details/data/asset_repository.dart' as _i5;
import '../screens/asset_details/models/single_asset_model.dart' as _i8;
import '../screens/auth/bloc/auth_bloc.dart' as _i35;
import '../screens/auth/data/login_repository.dart' as _i16;
import '../screens/auth/repo/auth_repo.dart' as _i31;
import '../screens/home/data/home_repository.dart' as _i12;
import '../screens/site_gallery/bloc/capture_file_bloc.dart' as _i32;
import '../screens/site_gallery/bloc/site_gallery_bloc.dart' as _i33;
import '../screens/site_gallery/data_source/gallery_manager.dart' as _i10;
import '../screens/site_gallery/data_source/local/local_account_manager_impl.dart'
    as _i11;
import '../screens/site_gallery/models/gallery_model.dart' as _i9;
import '../screens/site_gallery/repo/site_gallery_repo.dart' as _i29;
import '../screens/splash/bloc/app_metadata_bloc.dart' as _i34;
import '../screens/splash/datasource/app_metadata_manager.dart' as _i23;
import '../screens/splash/datasource/local/local_app_metadata_manager_impl.dart'
    as _i24;
import '../screens/splash/model/common_meta_data/app_metadatum.dart' as _i7;
import '../screens/splash/repo/app_metadata_repo.dart' as _i30;
import '../screens/task_list/data/task_repository.dart' as _i17;
import 'module/hive_module/hive_module.dart' as _i36;

// initializes the registration of main-scope dependencies inside of GetIt
Future<_i1.GetIt> init(
  _i1.GetIt getIt, {
  String? environment,
  _i2.EnvironmentFilter? environmentFilter,
}) async {
  final gh = _i2.GetItHelper(
    getIt,
    environment,
    environmentFilter,
  );
  final hiveBoxModule = _$HiveBoxModule();
  final injectableModule = _$InjectableModule();
  final dioProvider = _$DioProvider();
  gh.factory<_i3.AddAssetService>(() => _i3.AddAssetServiceImpl());
  gh.factory<_i4.AssetAuditService>(() => _i4.AssetAuditServiceImpl());
  gh.factory<_i5.AssetDetailsService>(() => _i5.AssetDetailsServiceImpl());
  await gh.singletonAsync<_i6.Box<_i7.AppMetadatum>>(
    () => hiveBoxModule.metadataBox,
    preResolve: true,
  );
  await gh.singletonAsync<_i6.Box<_i8.SingleAsset>>(
    () => hiveBoxModule.categoryBox,
    preResolve: true,
  );
  await gh.singletonAsync<_i6.Box<_i9.GalleryModel>>(
    () => hiveBoxModule.accountBox,
    preResolve: true,
  );
  gh.singleton<_i10.GalleryManager>(
    _i11.LocalAccountManagerImpl(accountBox: gh<_i6.Box<_i9.GalleryModel>>()),
    instanceName: 'local-gallery',
  );
  gh.factory<_i12.HomeRepository>(() => _i12.HomeRepositoryImpl());
  gh.factory<_i13.IConfig>(() => _i13.AppConfig());
  gh.factory<_i14.InternetConnectionService>(
      () => _i14.InternetConnectionImpl());
  gh.factory<_i15.LocationService>(() => _i15.LocationImpl());
  gh.factory<_i16.LoginApiService>(() => _i16.LoginApiImpl());
  gh.factory<_i17.MyTaskService>(() => _i17.MyTaskServiceImpl());
  gh.singleton<_i18.NavigationService>(_i18.NavigationService());
  gh.factory<_i19.PackageInfoService>(() => _i19.PackageInfoImpl());
  await gh.factoryAsync<_i20.SharedPreferences>(
    () => injectableModule.prefs,
    preResolve: true,
  );
  gh.singleton<_i21.AddAssetManager>(
    _i22.LocalAddAssetManagerImpl(accountBox: gh<_i6.Box<_i8.SingleAsset>>()),
    instanceName: 'local-add-asset',
  );
  gh.singleton<_i23.AppMetaDataManager>(
    _i24.LocalAppMetadataManagerImpl(
        metadataBox: gh<_i6.Box<_i7.AppMetadatum>>()),
    instanceName: 'local-app-metadata',
  );
  gh.factory<_i25.BaseHttpService>(() => _i25.HttpServiceImpl(
      internetConnection: gh<_i14.InternetConnectionService>()));
  gh.singleton<_i26.Dio>(dioProvider.dio(gh<_i13.IConfig>()));
  gh.factory<_i27.RetrofitClient>(() => _i27.UserAuthClient(
        dio: gh<_i26.Dio>(),
        config: gh<_i13.IConfig>(),
      ));
  gh.lazySingleton<_i28.SessionManager>(
      () => _i28.SessionManager(gh<_i20.SharedPreferences>()));
  gh.factory<_i29.SiteGalleryRepo>(
      () => _i29.Auth(authClient: gh<_i27.RetrofitClient>()));
  gh.factory<_i30.AppMetaDataRepo>(
      () => _i30.MetaData(retrofitClient: gh<_i27.RetrofitClient>()));
  gh.factory<_i31.AuthRepo>(
      () => _i31.Auth(authClient: gh<_i27.RetrofitClient>()));
  gh.factory<_i32.CaptureFileBloc>(() => _i32.CaptureFileBloc(
        gh<_i29.SiteGalleryRepo>(),
        gh<_i14.InternetConnectionService>(),
      ));
  gh.factory<_i33.SiteGalleryBloc>(() => _i33.SiteGalleryBloc(
        gh<_i29.SiteGalleryRepo>(),
        gh<_i14.InternetConnectionService>(),
      ));
  gh.factory<_i34.AppMetaDataBloc>(() => _i34.AppMetaDataBloc(
        gh<_i30.AppMetaDataRepo>(),
        gh<_i14.InternetConnectionService>(),
      ));
  gh.factory<_i35.AuthBloc>(() => _i35.AuthBloc(
        gh<_i31.AuthRepo>(),
        gh<_i14.InternetConnectionService>(),
      ));
  return getIt;
}

class _$HiveBoxModule extends _i36.HiveBoxModule {}

class _$InjectableModule extends _i37.InjectableModule {}

class _$DioProvider extends _i38.DioProvider {}
