import 'dart:io';

import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/core/utlis/permission_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/main_provider.dart';
import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/asset_details/asset_list_page.dart';
import 'package:ats_system/screens/home/components/global_search.dart';
import 'package:ats_system/screens/home/components/notify_supervisor_dialog.dart';
import 'package:ats_system/screens/home/components/rounded_search_bar.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/navigation_drawer/navigation_drawer.dart';
import 'package:ats_system/screens/view_map/presentation/view_map.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/snack_bar.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:location/location.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:provider/provider.dart';

class HomePage extends StatefulWidget {
  static const String routeName = '/homePage';

  const HomePage({Key? key}) : super(key: key);

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  TextEditingController controller = TextEditingController();
  double _distance = initialDistance;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      final provider = Provider.of<HomeProvider>(context, listen: false);
      provider.setTaskCount(0);
      provider.clearHome();
      fetchNearBySites();
      provider.fetchSites();
      context.read<MainProvider>().sessionTimeoutState(true);
    });
  }

  fetchNearBySites() async {
    checkPermission(
      permission: Permission.location,
      onPermissionDeniedPermenanty: () {
        if (Platform.isAndroid) {
          showPermissionRequiredDialog(context, locationPermissionMessage);
        } else if (Platform.isIOS) {
          context
              .showSnackBar("Please allow location permission from settings");
        }
      },
      onPermissionGranted: () {
        context
            .read<HomeProvider>()
            .fetchHomeNearBySites(_distance.toStringAsFixed(2));
      },
      onPermissionDenied: () {
        context.showSnackBar("Please allow location permission");
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () async => CustomDialogBox.appClose(context),
      child: Scaffold(
        backgroundColor: bgColor,
        resizeToAvoidBottomInset: false,
        appBar: AppBar(
            title: Row(
              crossAxisAlignment: CrossAxisAlignment.end,
              children: [
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(Strings.appBarHome),
                      Selector<HomeProvider, LocationData?>(
                        selector: (_, p) => p.data,
                        builder: (_, d, c) => d == null
                            ? Container()
                            : Text(
                                '(Lat:${d.latitude?.toStringAsFixed(4)}, Lng:${d.longitude?.toStringAsFixed(4)})',
                                style: const TextStyle(
                                    fontWeight: FontWeight.normal,
                                    fontStyle: FontStyle.italic,
                                    fontSize: 13),
                              ),
                      ),
                    ],
                  ),
                ),
                Visibility(
                  visible: false,
                  child: Flexible(
                    fit: FlexFit.tight,
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.end,
                      mainAxisAlignment: MainAxisAlignment.end,
                      children: [
                        ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            elevation: 5,
                            backgroundColor: Colors.white,
                            foregroundColor: kPrimaryColor,
                            padding: const EdgeInsets.symmetric(
                                horizontal: 10, vertical: 5),
                            minimumSize: Size.zero,
                          ),
                          onPressed: () => Navigator.pushNamed(
                            context,
                            ViewMapScreen.routeName,
                          ),
                          child: const Text(viewMap),
                        ),
                      ],
                    ),
                  ),
                )
              ],
            ),
            elevation: 5),
        drawer: const CustomNavigationDrawer(),
        body: Consumer<HomeProvider>(
          builder: (context, provider, child) {
            return Padding(
              padding: const EdgeInsets.all(10.0),
              child: Column(
                children: [
                  const SizedBox(height: 5),
                  InkWell(
                    onTap: () {
                      Navigator.pushNamed(
                        context,
                        GlobalSearchScreen.routeName,
                      );
                    },
                    child: RoundedSearchBar(),
                  ),
                  Expanded(
                    child: SingleChildScrollView(
                      scrollDirection: Axis.vertical,
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.start,
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Padding(
                            padding:
                                const EdgeInsets.symmetric(horizontal: 10.0),
                            child: Row(
                              children: [
                                const Text('1 KM',
                                    style: TextStyle(fontSize: 10)),
                                Expanded(
                                  child: Slider(
                                    min: 1,
                                    max: 100,
                                    activeColor: kPrimaryColor,
                                    label: '${_distance.toStringAsFixed(2)} KM',
                                    value: _distance,
                                    divisions: 10,
                                    onChanged: (value) =>
                                        setState(() => _distance = value),
                                    onChangeEnd: (value) {
                                      fetchNearBySites();
                                    },
                                  ),
                                ),
                                const Text('100 KM',
                                    style: TextStyle(fontSize: 10)),
                              ],
                            ),
                          ),
                          const SizedBox(height: 10),
                          SiteTypeWidget(
                              isNearBy: true,
                              title: Strings.nearBySites,
                              list: provider.homeNearBySiteList),
                          const SizedBox(height: 10),
                          SiteTypeWidget(
                              title: Strings.mySites,
                              list: provider.mySiteList),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            );
          },
        ),
      ),
    );
  }
}

class SiteTypeWidget extends StatelessWidget {
  const SiteTypeWidget(
      {Key? key,
      required this.title,
      required this.list,
      this.isNearBy = false})
      : super(key: key);
  final String title;
  final List<SiteData> list;
  final bool isNearBy;

  @override
  Widget build(BuildContext context) {
    return Card(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(0.0),
      ),
      color: scaffoldBackgroundColor,
      elevation: 2.0,
      child: ClipRRect(
        borderRadius: BorderRadius.all(
          Radius.circular(0.0),
        ),
        child: Container(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.start,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Padding(
                padding: const EdgeInsets.only(left: 15.0, top: 15, right: 15),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(title,
                        style: const TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.w900,
                            color: kPrimaryColor)),
                    SizedBox(
                      height: 10,
                    ),
                  ],
                ),
              ),
              SitesWidget(
                siteList: list,
                isNearBy: isNearBy,
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class SitesWidget extends StatelessWidget {
  const SitesWidget({Key? key, required this.siteList, this.isNearBy = false})
      : super(key: key);

  final List<SiteData> siteList;
  final bool isNearBy;

  @override
  Widget build(BuildContext context) {
    return (isNearBy)
        ? Consumer<HomeProvider>(builder: (context, provider, child) {
            if (provider.isHomeNearSiteLoading)
              return Padding(
                padding: const EdgeInsets.all(50.0),
                child: ProgressBar(),
              );
            else {
              if (provider.homeNearBySiteList.isEmpty) {
                return Container(
                  width: double.infinity,
                  child: Padding(
                    padding: const EdgeInsets.all(50.0),
                    child: Align(child: Text('No Nearby Sites Found!')),
                  ),
                );
              } else {
                return Datatable(
                  siteList: siteList,
                  isNearBy: isNearBy,
                );
              }
            }
          })
        : Consumer<HomeProvider>(builder: (context, provider, child) {
            if (provider.isMySiteLoading)
              return Padding(
                padding: const EdgeInsets.all(50.0),
                child: ProgressBar(),
              );
            else {
              if (provider.mySiteList.isEmpty) {
                return Container(
                  width: double.infinity,
                  child: Padding(
                    padding: const EdgeInsets.all(50.0),
                    child: Align(child: Text('No Sites Found!')),
                  ),
                );
              } else {
                return Datatable(
                  siteList: siteList,
                  isNearBy: isNearBy,
                );
              }
            }
          });
  }
}

class Datatable extends StatelessWidget {
  Datatable({super.key, required this.siteList, this.isNearBy = false});
  final List<SiteData> siteList;
  final bool isNearBy;
  final hScroll = ScrollController();
  final vScroll = ScrollController();
  @override
  Widget build(BuildContext context) {
    List<DataRow> rows = siteList
        .map((e) => DataRow(
                color: MaterialStateProperty.resolveWith((states) {
                  return siteList.indexOf(e) % 2 == 0
                      ? scaffoldBackgroundColor
                      : white;
                }),
                cells: [
                  DataCell(
                    Text(
                      e.tlLocationCode!,
                      style: const TextStyle(
                          decoration: TextDecoration.underline,
                          color: Colors.blue,
                          decorationColor: Colors.blue,
                          fontWeight: FontWeight.w500),
                    ),
                    onTap: () {
                      context.read<HomeProvider>().selectedSite = e;

                      if (isNearBy) {
                        bool isMySite = context
                            .read<HomeProvider>()
                            .mySiteList
                            .any((element) =>
                                element.tlLocationCode!.trim() ==
                                e.tlLocationCode!.trim());
                        !isMySite &&
                                !locator.get<SessionManager>().isSupervisor()
                            ? CustomDialogBox.appDialog(
                                context, NotifySupervisorDialog())
                            : Navigator.of(context)
                                .pushNamed(AssetListPage.routeName);
                      } else {
                        Navigator.of(context)
                            .pushNamed(AssetListPage.routeName);
                      }
                    },
                  ),
                  DataCell(Text(e.tlLocationName ?? '')),
                  DataCell(ConstrainedBox(
                      constraints: BoxConstraints(maxWidth: 450, minWidth: 200),
                      child: Text(e.tlLocationAddress ?? '', maxLines: 1))),
                ]))
        .toList();

    return MediaQuery(
      data: MediaQuery.of(context).removePadding(removeBottom: true),
      child: Scrollbar(
        controller: vScroll,
        thumbVisibility: true,
        child: SingleChildScrollView(
          controller: vScroll,
          scrollDirection: Axis.vertical,
          child: Scrollbar(
            controller: hScroll,
            thumbVisibility: true,
            child: SingleChildScrollView(
              controller: hScroll,
              scrollDirection: Axis.horizontal,
              child: DataTable(
                headingRowColor: MaterialStateColor.resolveWith(
                  (states) {
                    return white;
                  },
                ),
                columnSpacing: 30,
                dividerThickness: 0,
                horizontalMargin: 15,
                dataRowMinHeight: 20,
                dataRowMaxHeight: 40,
                columns: [
                  DataColumn(
                    label: Text(
                      Constants.siteID,
                      style: TextStyle(
                        fontWeight: FontWeight.w600,
                        color: labelTextColor,
                      ),
                    ),
                  ),
                  DataColumn(
                      label: Text(
                    Constants.siteName,
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                      color: labelTextColor,
                    ),
                  )),
                  DataColumn(
                      label: Text(
                    Constants.siteAddress,
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                      color: labelTextColor,
                    ),
                  )),
                ],
                rows: rows,
              ),
            ),
          ),
        ),
      ),
    );
  }
}
