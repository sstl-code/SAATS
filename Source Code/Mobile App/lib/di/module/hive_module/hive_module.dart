import 'package:ats_system/core/enum/box_types.dart';
import 'package:ats_system/screens/add_asset/models/asset_type_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:ats_system/screens/site_gallery/models/gallery_model.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/app_metadatum.dart';
import 'package:flutter/foundation.dart';
import 'package:hive_flutter/adapters.dart';
import 'package:injectable/injectable.dart';

@module
abstract class HiveBoxModule {
  @singleton
  @preResolve
  Future<Box<GalleryModel>> get accountBox =>
      Hive.openBox<GalleryModel>(BoxType.gallery.name);

  @singleton
  @preResolve
  Future<Box<SingleAsset>> get categoryBox =>
      Hive.openBox<SingleAsset>(BoxType.addAsset.name);

  @singleton
  @preResolve
  Future<Box<AppMetadatum>> get metadataBox =>
      Hive.openBox<AppMetadatum>(BoxType.commonMetaData.name);
}

class HiveAdapters {
  Future<void> initHive() async {
    await Hive.initFlutter(hivePath);
    Hive..registerAdapter(GalleryModelAdapter());
    Hive..registerAdapter(GalleryTypeAdapter());
    Hive..registerAdapter(SingleAssetAdapter());
    Hive..registerAdapter(AttrMasterAdapter());
    Hive..registerAdapter(AssetTypeAttrAdapter());
    Hive.registerAdapter(AssetTypeAdapter());
    Hive..registerAdapter(AssetAttrAdapter());
    Hive..registerAdapter(AppMetadataAdapter());
  }

  String? get hivePath {
    if (kIsWeb) {
      return 'paisa';
    } else if (TargetPlatform.windows == defaultTargetPlatform) {
      return 'paisa';
    } else {
      return null;
    }
  }
}
