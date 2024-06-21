import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/asset_details/asset_list_page.dart';
import 'package:ats_system/screens/home/components/notify_supervisor_dialog.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class GlobalSearchScreen extends StatefulWidget {
  static const String routeName = '/gloabalSearch';

  const GlobalSearchScreen({Key? key}) : super(key: key);

  @override
  State<GlobalSearchScreen> createState() => _GlobalSearchScreenState();
}

class _GlobalSearchScreenState extends State<GlobalSearchScreen> {
  final TextEditingController controller = TextEditingController();

  @override
  void initState() {
    final provider = Provider.of<HomeProvider>(context, listen: false);
    provider.clearGlobalSearchList();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: bgColor,
      appBar: AppBar(
        title: Text(searchSites),
      ),
      body: Padding(
        padding: const EdgeInsets.all(10.0),
        child: Column(
          children: [
            const SizedBox(height: 5),
            Row(
              children: [
                Expanded(
                  child: Card(
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(appCardCurve),
                    ),
                    elevation: 0,
                    child: Container(
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(appCardCurve),
                        color: white,
                        boxShadow: [
                          BoxShadow(
                            color: Colors.black.withOpacity(0.2),
                            spreadRadius: 0.0,
                            blurRadius: 2.0,
                            offset: Offset(0, 2),
                          ),
                        ],
                      ),
                      child: Padding(
                        padding: const EdgeInsets.only(left: 16.0),
                        child: Row(
                          children: [
                            Icon(
                              Icons.search,
                              color: Colors.grey,
                            ),
                            SizedBox(width: 8.0),
                            Expanded(
                              child: TextField(
                                style: TextStyle(
                                    color: Colors.grey[700], fontSize: 15),
                                controller: controller,
                                autofocus: true,
                                decoration: InputDecoration(
                                  hintText: searchAnySites,
                                  border: InputBorder.none,
                                ),
                                textInputAction: TextInputAction.search,
                                onSubmitted: (value) {
                                  FocusScope.of(context).unfocus();
                                  if (controller.text.trim().isEmpty) {
                                    ToastMessage.showMessage(
                                        Strings.enterSiteIdAddress,
                                        kToastErrorColor);
                                  } else {
                                    context
                                        .read<HomeProvider>()
                                        .globalSearch(controller.text.trim());
                                  }
                                },
                              ),
                            ),
                            IconButton(
                              icon: Icon(
                                Icons.clear,
                                color: Colors.grey,
                              ),
                              onPressed: () {
                                controller.clear();
                              },
                            ),
                          ],
                        ),
                      ),
                    ),
                  ),
                ),
                const SizedBox(
                  width: 5,
                ),
                Container(
                  child: Card(
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(appCardCurve),
                    ),
                    elevation: 0,
                    color: kPrimaryColor,
                    child: Container(
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(appCardCurve),
                        color: kPrimaryColor,
                        boxShadow: [
                          BoxShadow(
                            color: Colors.black.withOpacity(0.2),
                            spreadRadius: 0.0,
                            blurRadius: 2.0,
                            offset: Offset(0, 2),
                          ),
                        ],
                      ),
                      child: IconButton(
                          color: white,
                          onPressed: () {
                            FocusScope.of(context).unfocus();
                            if (controller.text.trim().isEmpty) {
                              ToastMessage.showMessage(
                                  Strings.enterSiteIdAddress, kToastErrorColor);
                            } else {
                              context
                                  .read<HomeProvider>()
                                  .globalSearch(controller.text.trim());
                            }
                          },
                          icon: Icon(Icons.search)),
                    ),
                  ),
                )
              ],
            ),
            SizedBox(
              height: 10,
            ),
            Flexible(
              child: Container(
                child: Consumer<HomeProvider>(
                  builder: (context, provider, child) {
                    if (provider.isGlobalSearchLoading)
                      return const ProgressBar();
                    return provider.globalSiteList.isEmpty
                        ? Padding(
                            padding: const EdgeInsets.all(18.0),
                            child: Center(child: Text(provider.dataFound)),
                          )
                        : Card(
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(appCardCurve),
                            ),
                            color: scaffoldBackgroundColor,
                            elevation: 2.0,
                            child: ClipRRect(
                              borderRadius: BorderRadius.all(
                                Radius.circular(appCardCurve),
                              ),
                              child: SitesWidget(
                                  siteList: provider.globalSiteList),
                            ),
                          );
                  },
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class SitesWidget extends StatelessWidget {
  const SitesWidget({Key? key, required this.siteList}) : super(key: key);

  final List<SiteData> siteList;

  @override
  Widget build(BuildContext context) {
    final hScroll = ScrollController();
    final vScroll = ScrollController();

    List<DataRow> rows = siteList
        .map((e) => DataRow(
                color: MaterialStateProperty.resolveWith((states) =>
                    siteList.indexOf(e) % 2 == 0
                        ? white
                        : scaffoldBackgroundColor),
                cells: [
                  DataCell(
                    Text(
                      e.tlLocationCode!,
                      style: const TextStyle(
                          decoration: TextDecoration.underline,
                          color: Colors.blue,
                          fontWeight: FontWeight.w500),
                    ),
                    onTap: () {
                      context.read<HomeProvider>().selectedSite = e;
                      bool isMySite = context
                          .read<HomeProvider>()
                          .mySiteList
                          .any((element) =>
                              element.tlLocationCode!.trim() ==
                              e.tlLocationCode!.trim());
                      !isMySite && !locator.get<SessionManager>().isSupervisor()
                          ? CustomDialogBox.appDialog(
                              context, NotifySupervisorDialog())
                          : Navigator.of(context)
                              .pushNamed(AssetListPage.routeName);
                    },
                  ),
                  DataCell(Text(e.tlLocationName ?? '', maxLines: 1)),
                  DataCell(Text(e.tlLocationAddress ?? '', maxLines: 1)),
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
                    return scaffoldBackgroundColor;
                  },
                ),
                columnSpacing: 30,
                dividerThickness: 0,
                horizontalMargin: 15,
                dataRowMinHeight: 20,
                dataRowMaxHeight: 40,
                columns: const [
                  DataColumn(
                      label: Text(
                    Constants.siteID,
                    style: TextStyle(
                      fontWeight: FontWeight.w600,
                      color: labelTextColor,
                    ),
                  )),
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
