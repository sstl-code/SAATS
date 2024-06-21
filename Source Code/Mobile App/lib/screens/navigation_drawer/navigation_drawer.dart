import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/proxy/presentation/proxy_settings.dart';
import 'package:ats_system/screens/asset_audit/asset_audit_page.dart';
import 'package:ats_system/screens/auth/data/login_provider.dart';
import 'package:ats_system/screens/auth/login_page.dart';
import 'package:ats_system/screens/home/components/change_password_dialog.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/home/home_page.dart';
import 'package:ats_system/screens/navigation_drawer/widgets/drawer_header.dart';
import 'package:ats_system/screens/site_gallery/presentation/site_gallery.dart';
import 'package:ats_system/screens/splash/datasource/app_metadata_manager.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/app_metadatum.dart';
import 'package:ats_system/screens/task_list/task_list_page.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class CustomNavigationDrawer extends StatefulWidget {
  const CustomNavigationDrawer(
      {Key? key, this.isFromAsset = false, this.siteData})
      : super(key: key);
  final bool isFromAsset;
  final SiteData? siteData;

  @override
  State<CustomNavigationDrawer> createState() => _CustomNavigationDrawerState();
}

class _CustomNavigationDrawerState extends State<CustomNavigationDrawer>
    with WidgetsBindingObserver {
  final SessionManager _session = locator<SessionManager>();
  final AppMetaDataManager dataSource =
      locator.get<AppMetaDataManager>(instanceName: 'local-app-metadata');

  void _gotoLogin(BuildContext context) {
    Navigator.of(context)
        .pushNamedAndRemoveUntil(LoginPage.routeName, (route) => false);
  }

  void _showLogoutDialog(BuildContext context) {
    CustomDialogBox.appDialog(
        context,
        AlertDialog(
          shape:
              RoundedRectangleBorder(borderRadius: BorderRadius.circular(10.0)),
          title: const Text('Are you sure?'),
          content: const Text('Do you want to logout?'),
          actions: <Widget>[
            TextButton(
                onPressed: () => Navigator.of(context).pop(false),
                child: const Text(Strings.btnNo)),
            TextButton(
                onPressed: () => _logout(context),
                child: const Text(Strings.btnYes)),
          ],
        ),
        barrierDismissible: true);
  }

  void _logout(BuildContext context) async {
    Provider.of<LoginProvider>(context, listen: false).clearAll();
    _session.clearPref();
    _gotoLogin(context);
  }

  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Drawer(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          mainAxisAlignment: MainAxisAlignment.start,
          children: [
            const CustomDrawerHeader(),
            Expanded(
              child: Container(
                child: SingleChildScrollView(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      const SizedBox(
                        height: 10,
                      ),
                      GestureDetector(
                          onTap: () {
                            context.read<HomeProvider>().selectedSite = null;
                            context.read<HomeProvider>().setTaskCount(0);
                            Navigator.of(context).pushNamed(HomePage.routeName);
                          },
                          child: const _CustomItem(
                              title: Strings.appBarHome,
                              image: 'assets/images/icon_home.png')),
                      const Divider(),
                      GestureDetector(
                          onTap: widget.isFromAsset
                              ? () {
                                  Navigator.of(context).pop();
                                  Navigator.of(context).pushNamed(
                                      TaskListPage.routeName,
                                      arguments: widget.siteData!);
                                }
                              : () => ToastMessage.showMessage(
                                  'Please go to any site.', kToastErrorColor),
                          child: Selector<HomeProvider, int>(
                              selector: (context, prov) => prov.taskCount,
                              builder: (context, count, child) => _CustomItem(
                                  title: 'Task List',
                                  image: 'assets/images/icon_bell.png',
                                  taskCount: count != 0 ? count : null))),
                      const Divider(),
                      Visibility(
                        visible: _session.isSupervisor(),
                        child: Column(
                          children: [
                            GestureDetector(
                                onTap: () {
                                  if (widget.siteData == null) {
                                    ToastMessage.showMessage(
                                        'Please go to any site.',
                                        kToastErrorColor);
                                  } else {
                                    Navigator.of(context).pop();
                                    Navigator.of(context).pushNamed(
                                        AssetAuditPage.routeName,
                                        arguments: widget.siteData);
                                  }
                                },
                                child: const _CustomItem(
                                    title: 'Site Audit',
                                    image: 'assets/images/icon_audit.png')),
                            const Divider(),
                          ],
                        ),
                      ),
                      GestureDetector(
                          onTap: () {
                            if (widget.siteData == null) {
                              ToastMessage.showMessage(
                                  'Please go to any site.', kToastErrorColor);
                            } else {
                              Navigator.of(context).pop();
                              Navigator.of(context).pushNamed(
                                  SiteGalleryScreen.routeName,
                                  arguments: widget.siteData?.tlLocationId);
                            }
                          },
                          child: const _CustomItem(
                              title: 'Site Gallery',
                              image: 'assets/images/icon_site_gallery.png')),
                      const Divider(),
                      GestureDetector(
                          onTap: () => CustomDialogBox.appDialog(
                              context,
                              const CustomDialog(
                                title: 'Change Password',
                                body: ChangePasswordDialog(),
                                footer: SizedBox(),
                              )),
                          child: const _CustomItem(
                              title: 'Change Password',
                              image: 'assets/images/icon_lock.png')),
                      const Divider(),
                      if (!kReleaseMode)
                        GestureDetector(
                            onTap: () => CustomDialogBox.appDialog(
                                context,
                                const CustomDialog(
                                  title: 'Proxy Settings',
                                  body: ProxySettingsWidget(),
                                  footer: SizedBox(),
                                )),
                            child: const _CustomItem(
                                title: 'Proxy Settings',
                                image: 'assets/images/icon_proxy.png')),

                      const Divider(),
                      GestureDetector(
                          onTap: () => _showLogoutDialog(context),
                          child: const _CustomItem(
                              title: 'Logout',
                              image: 'assets/images/icon_logout.png')),

                      // )
                    ],
                  ),
                ),
              ),
            ),
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Column(
                      mainAxisAlignment: MainAxisAlignment.start,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Released date:',
                          style: TextStyle(color: kPrimaryColor, fontSize: 13),
                        ),
                        const SizedBox(
                          height: 3,
                        ),
                        FutureBuilder<AppMetadatum?>(
                            future: getValueByKey('Released_Date'),
                            builder: (context, snapshot) {
                              if (snapshot.hasData) {
                                AppMetadatum? metaData = snapshot.data!;
                                return Text(
                                  metaData.settingValue ?? 'N/A',
                                  style: TextStyle(color: grey, fontSize: 12),
                                );
                              } else {
                                return SizedBox();
                              }
                            })
                      ],
                    ),
                    Column(
                      mainAxisAlignment: MainAxisAlignment.end,
                      crossAxisAlignment: CrossAxisAlignment.end,
                      children: [
                        Text(
                          'App version:',
                          style: TextStyle(color: kPrimaryColor, fontSize: 13),
                        ),
                        const SizedBox(
                          height: 3,
                        ),
                        FutureBuilder<AppMetadatum?>(
                            future: getValueByKey('App_Version'),
                            builder: (context, snapshot) {
                              if (snapshot.hasData) {
                                AppMetadatum? metaData = snapshot.data!;
                                return Text(
                                  metaData.settingValue ?? 'N/A',
                                  style: TextStyle(color: grey, fontSize: 12),
                                );
                              } else {
                                return SizedBox();
                              }
                            })
                      ],
                    ),
                  ]),
            ),
          ],
        ),
      ),
    );
  }

  Future<AppMetadatum?> getValueByKey(String? key) async {
    return dataSource.getValueByKey(key);
  }
}

class _CustomItem extends StatelessWidget {
  const _CustomItem(
      {Key? key, required this.image, required this.title, this.taskCount})
      : super(key: key);
  final String title, image;
  final int? taskCount;

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.only(left: 15, top: 2, bottom: 2),
      margin: const EdgeInsets.all(5),
      child: Stack(
        clipBehavior: Clip.none,
        children: [
          Row(
            children: [
              Image.asset(
                image,
                height: 20,
                width: 20,
                color: kPrimaryColor,
              ), // Icon(Icons.home),
              const SizedBox(width: 10),
              Text(title),
            ],
          ),
          Visibility(
            visible: taskCount != null,
            child: Positioned(
                left: -10,
                top: -10,
                child: Container(
                    padding: const EdgeInsets.all(7),
                    decoration: const BoxDecoration(
                        shape: BoxShape.circle, color: Colors.orange),
                    child: Text('$taskCount',
                        style: const TextStyle(fontSize: 10)))),
          ),
        ],
      ),
    );
  }
}
