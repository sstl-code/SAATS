import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/asset_audit/audit_active_tab.dart';
import 'package:ats_system/screens/asset_audit/audit_passive_tab.dart';
import 'package:ats_system/screens/asset_audit/data/asset_audit_provider.dart';
import 'package:ats_system/screens/navigation_drawer/navigation_drawer.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class AssetAuditPage extends StatefulWidget {
  static const String routeName = '/assetAudit';

  const AssetAuditPage({Key? key, required this.siteData}) : super(key: key);
  final SiteData siteData;

  @override
  State<AssetAuditPage> createState() => _AssetAuditPageState();
}

class _AssetAuditPageState extends State<AssetAuditPage>
    with SingleTickerProviderStateMixin {
  late TabController _tabController;

  List<Tab> tabs = const [
    Tab(text: Strings.passiveAsset),
    Tab(text: Strings.activeAsset)
  ];
  late List<Widget> widgets;

  final ScrollController scrollController = ScrollController();

  @override
  void initState() {
    widgets = [AuditPassiveTab(), AuditActiveTab()];
    _tabController = TabController(length: widgets.length, vsync: this);
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context
          .read<AssetAuditProvider>()
          .initializeAssetAudit(widget.siteData.tlLocationId);
    });
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () async {
        final provider = context.read<AssetAuditProvider>();
        if (provider.isParentSubmitted)
          return true;
        else
          return false;
      },
      child: Scaffold(
        appBar: AppBar(
          centerTitle: false,
          title: Row(
            crossAxisAlignment: CrossAxisAlignment.end,
            children: [
              Expanded(
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.spaceAround,
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text('Asset Audit'),
                    SizedBox(
                      height: 3,
                    ),
                    Text(
                        '${widget.siteData.tlLocationCode}, ${widget.siteData.tlLocationName}',
                        style:
                            const TextStyle(color: Colors.white, fontSize: 12))
                  ],
                ),
              ),
              Visibility(
                visible: (widget.siteData.lastAuditDate != null),
                child: Flexible(
                  fit: FlexFit.tight,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.end,
                    mainAxisAlignment: MainAxisAlignment.end,
                    children: [
                      const Text(
                        'Last Audited on:',
                        style: const TextStyle(
                            fontWeight: FontWeight.bold,
                            fontStyle: FontStyle.italic,
                            fontSize: 14),
                      ),
                      SizedBox(
                        height: 2,
                      ),
                      Text(widget.siteData.lastAuditDate ?? 'N/A',
                          style: const TextStyle(
                              color: Colors.white,
                              fontSize: 13,
                              fontWeight: FontWeight.normal,
                              fontStyle: FontStyle.italic))
                    ],
                  ),
                ),
              ),
            ],
          ),
        ),
        drawer: CustomNavigationDrawer(
            isFromAsset: true, siteData: widget.siteData),
        body: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Scrollbar(
            controller: scrollController,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                Container(
                  margin: const EdgeInsets.symmetric(
                      vertical: 5.0, horizontal: 10.0),
                  decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(10.0),
                      border:
                          Border.all(color: kPrimaryColor.withOpacity(0.3))),
                  child: TabBar(
                      indicatorSize: TabBarIndicatorSize.tab,
                      controller: _tabController,
                      indicator: BoxDecoration(
                          borderRadius: BorderRadius.circular(10.0),
                          color: kPrimaryColor),
                      labelColor: Colors.white,
                      unselectedLabelColor: Colors.black,
                      tabs: tabs),
                ),
                Expanded(
                    child: TabBarView(
                        controller: _tabController, children: widgets)),
                const SizedBox(height: 10),
                Align(
                    alignment: Alignment.center,
                    child: ElevatedButton(
                        onPressed: () {
                          final provider = context.read<AssetAuditProvider>();
                          bool isTagged = true;
                          final list = provider.allDataList;
                          for (var l in list) {
                            if (l.category == null) continue;
                            if (l.isAudited == 'N' || l.isAudited == 'O') {
                              ToastMessage.showMessage(
                                  'Please scan all the tags.',
                                  kToastErrorColor);
                              isTagged = false;
                              break;
                            }
                          }

                          if (isTagged) {
                            context
                                .read<AssetAuditProvider>()
                                .submitAssetAudit(widget.siteData.tlLocationId)
                                .then((response) {
                              ToastMessage.showMessage(
                                  response.message,
                                  response.status == SUCCESS_RESPONSE_CODE
                                      ? kToastSuccessColor
                                      : kToastErrorColor);
                              if (response.status == SUCCESS_RESPONSE_CODE) {
                                context
                                    .read<AssetAuditProvider>()
                                    .isParentSubmitted = true;
                                Navigator.pop(context);
                              }
                            });
                          }
                        },
                        child: const Text(Strings.btnSubmit))),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
