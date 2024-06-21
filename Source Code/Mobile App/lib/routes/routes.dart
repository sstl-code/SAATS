import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/add_asset/add_asset_screen.dart';
import 'package:ats_system/screens/asset_audit/asset_audit_page.dart';
import 'package:ats_system/screens/asset_audit/audit_details/audit_child_details_page.dart';
import 'package:ats_system/screens/asset_audit/audit_details/audit_details_page.dart';
import 'package:ats_system/screens/asset_audit/child_asset_audit/child_asset_audit_page.dart';
import 'package:ats_system/screens/asset_details/asset_list_page.dart';
import 'package:ats_system/screens/asset_details/asset_page/asset_page.dart';
import 'package:ats_system/screens/auth/login_page.dart';
import 'package:ats_system/screens/home/components/global_search.dart';
import 'package:ats_system/screens/home/home_page.dart';
import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:ats_system/screens/site_gallery/presentation/capture_photo_or_video.dart';
import 'package:ats_system/screens/site_gallery/presentation/image_viewer.dart';
import 'package:ats_system/screens/site_gallery/presentation/site_gallery.dart';
import 'package:ats_system/screens/site_gallery/presentation/video_player.dart';
import 'package:ats_system/screens/splash/presentation/splash_page.dart';
import 'package:ats_system/screens/task_list/srn/srn_page.dart';
import 'package:ats_system/screens/task_list/stn/stn_page.dart';
import 'package:ats_system/screens/task_list/task_list_page.dart';
import 'package:ats_system/screens/view_map/presentation/view_map.dart';
import 'package:flutter/material.dart';

class Routes {
  static Route<dynamic> generateRoute(RouteSettings routeSettings) {
    switch (routeSettings.name) {
      case SplashPage.routeName:
        return FadeTransitionRoute(pageName: const SplashPage());
      case LoginPage.routeName:
        return FadeTransitionRoute(pageName: const LoginPage());
      case HomePage.routeName:
        return FadeTransitionRoute(pageName: const HomePage());
      case GlobalSearchScreen.routeName:
        return FadeTransitionRoute(pageName: const GlobalSearchScreen());
      case AssetListPage.routeName:
        return FadeTransitionRoute(pageName: AssetListPage());
      case AssetPage.routeName:
        final map = routeSettings.arguments as Map;
        return FadeTransitionRoute(
            pageName: AssetPage(
                assetId: map['assetId'],
                masterId: map['assetTypeMasterId'],
                assetName: map['assetName'],
                assetTypeName: map['assetTypeName']));
      case ChildAssetAuditPage.routeName:
        final map = routeSettings.arguments as Map<String, dynamic>;
        return FadeTransitionRoute(
            pageName: ChildAssetAuditPage(
                auditData: map['auditData'], siteData: map['siteData']));
      case AuditDetailsPage.routeName:
        final map = routeSettings.arguments as Map<String, dynamic>;
        return FadeTransitionRoute(
          pageName: AuditDetailsPage(
              assetDataModel: map['assetId'],
              isFromParent: map['fromParent'] ?? true,
              parentAssetId: map['parentAssetId']),
        );
      case AuditChildDetailsPage.routeName:
        final map = routeSettings.arguments as Map<String, dynamic>;
        return FadeTransitionRoute(
          pageName: AuditChildDetailsPage(
              assetDataModel: map['assetId'],
              isFromParent: map['fromParent'] ?? true,
              parentAssetId: map['parentAssetId']),
        );

      case AddAssetScreen.routeName:
        final map = routeSettings.arguments as Map;

        return FadeTransitionRoute(
            pageName: AddAssetScreen(
          addAssetScreenFrom: map['addAssetScreenFrom'],
          assetTypeId: map['assetTypeId'],
          assetId: map['assetId'],
          category: map['category'],
          parentAssetName: map['parentAssetName'],
          parentAssetTypeDesc: map['parentAssetTypeDesc'],
          parentSerialNumber: map['parentSerialNumber'],
          editAssetModel: map['editAssetModel'],
        ));
      case TaskListPage.routeName:
        final siteData = routeSettings.arguments as SiteData;
        return FadeTransitionRoute(pageName: TaskListPage(siteData: siteData));
      case STNPage.routeName:
        final map = routeSettings.arguments as Map<String, dynamic>;
        return FadeTransitionRoute(
            pageName: STNPage(task: map['task'], siteData: map['siteData']));
      case SRNPage.routeName:
        final map = routeSettings.arguments as Map<String, dynamic>;
        return FadeTransitionRoute(
            pageName: SRNPage(task: map['task'], siteData: map['siteData']));
      case AssetAuditPage.routeName:
        final site = routeSettings.arguments as SiteData;
        return FadeTransitionRoute(pageName: AssetAuditPage(siteData: site));
      case ViewMapScreen.routeName:
        return FadeTransitionRoute(pageName: ViewMapScreen());
      case SiteGalleryScreen.routeName:
        final siteId = routeSettings.arguments as int;
        return FadeTransitionRoute(pageName: SiteGalleryScreen(siteId: siteId));
      case CameraScreen.routeName:
        final map = routeSettings.arguments as Map<String, dynamic>;
        return FadeTransitionRoute(
            pageName: CameraScreen(
          galleryType: map['galleryType'] as GalleryType,
          siteId: map['siteId'],
        ));
      case VideoPlayerScreen.routeName:
        final videoUrl = routeSettings.arguments as String;
        return FadeTransitionRoute(
            pageName: VideoPlayerScreen(
          videoUrl: videoUrl,
        ));
      case ImageViewer.routeName:
        final map = routeSettings.arguments as Map<String, dynamic>;
        return FadeTransitionRoute(
            pageName: ImageViewer(
          imageUrls: map['mediaList'],
          initialIndex: map['initialIndex'],
        ));
      default:
        return FadeTransitionRoute(
            pageName: SafeArea(
          child: Scaffold(
              appBar: AppBar(),
              body: const Center(child: Text('404. \nScreen does not exist!'))),
        ));
    }
  }
}

class CustomMaterialRoutes extends MaterialPageRoute {
  final Widget pageName;

  CustomMaterialRoutes({required this.pageName})
      : super(builder: (_) => pageName);
}

class FadeTransitionRoute<T> extends PageRouteBuilder<T> {
  final Widget pageName;
  final RouteSettings? setting;

  FadeTransitionRoute({required this.pageName, this.setting})
      : super(
          settings: setting,
          pageBuilder: (context, animation, secondaryAnimation) => pageName,
          transitionsBuilder: (context, animation, secondaryAnimation, child) {
            const begin = 0.0;
            const end = 1.0;
            const curve = Curves.easeInOut;

            var tween =
                Tween(begin: begin, end: end).chain(CurveTween(curve: curve));

            var fadeAnimation = animation.drive(tween);

            return FadeTransition(opacity: fadeAnimation, child: child);
          },
        );
}
