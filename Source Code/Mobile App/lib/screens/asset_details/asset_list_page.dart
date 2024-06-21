import 'package:ats_system/screens/add_asset/add_asset_screen.dart';
import 'package:ats_system/screens/add_asset/enum/add_asset_screen_from.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/screens/asset_details/tabs/active_tab.dart';
import 'package:ats_system/screens/asset_details/tabs/passive_tab.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/navigation_drawer/navigation_drawer.dart';
import 'package:ats_system/screens/task_list/data/task_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/widgets/status_icon.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class AssetListPage extends StatefulWidget {
  static const String routeName = '/assetDetails';

  const AssetListPage({super.key});

  @override
  State<AssetListPage> createState() => _AssetListPageState();
}

class _AssetListPageState extends State<AssetListPage> {
  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (context) => AssetDetailsProvider(),
      child: WillPopScope(
          onWillPop: () async {
            context.read<HomeProvider>().setTaskCount(0);

            return Future.value(true);
          },
          child: AssetList()),
    );
  }
}

class AssetList extends StatefulWidget {
  const AssetList({Key? key}) : super(key: key);

  @override
  State<AssetList> createState() => _AssetListState();
}

class _AssetListState extends State<AssetList>
    with SingleTickerProviderStateMixin {
  late TabController _tabController;

  List<Tab> tabs = const [
    Tab(text: Strings.passiveAsset),
    Tab(text: Strings.activeAsset)
  ];
  late List<Widget> widgets;

  @override
  void initState() {
    widgets = [PassiveTab(), ActiveTab()];
    _tabController = TabController(length: widgets.length, vsync: this);
    super.initState();

    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      Provider.of<AssetDetailsProvider>(context, listen: false).getAssetList(
          context.read<HomeProvider>().selectedSite!.tlLocationId);

      context
          .read<TaskProvider>()
          .fetchTasks(
              context.read<HomeProvider>().selectedSite!.tlLocationCode!)
          .then((value) =>
              context.read<HomeProvider>().setTaskCount(value.length));
      ;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<AssetDetailsProvider>(
      builder: (context, provider, state) {
        return Scaffold(
          resizeToAvoidBottomInset: false,
          drawer: CustomNavigationDrawer(
              isFromAsset: true,
              siteData: context.read<HomeProvider>().selectedSite!),
          appBar: AppBar(
              title: Row(
                crossAxisAlignment: CrossAxisAlignment.end,
                children: [
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        const Text('Asset Details'),
                        Text(
                            '${context.read<HomeProvider>().selectedSite!.tlLocationCode}, ${context.read<HomeProvider>().selectedSite!.tlLocationName}',
                            style: const TextStyle(fontSize: 11)),
                        SizedBox(
                          height: 5,
                        )
                      ],
                    ),
                  ),
                  Flexible(
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
                              context, AddAssetScreen.routeName,
                              arguments: {
                                'addAssetScreenFrom':
                                    AddAssetType.addParentFromAssetListing,
                                'parentAssetTypeDesc': '-',
                                'parentSerialNumber': '-',
                              }),
                          child: const Text(Strings.addAsset),
                        ),
                      ],
                    ),
                  )
                ],
              ),
              elevation: 5),
          body: Column(
            children: [
              Container(
                margin:
                    const EdgeInsets.symmetric(vertical: 5.0, horizontal: 10.0),
                decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(10.0),
                    border: Border.all(color: kPrimaryColor.withOpacity(0.3))),
                child: TabBar(
                    controller: _tabController,
                    indicatorSize: TabBarIndicatorSize.tab,
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
              const Divider(color: Colors.grey),
              const SizedBox(height: 10),
              const SingleChildScrollView(
                scrollDirection: Axis.horizontal,
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    _StatusWidget(color: Colors.green, title: 'Tagged'),
                    _StatusWidget(
                        color: Colors.orange, title: 'Partially Tagged'),
                    _StatusWidget(color: Colors.red, title: 'Not Tagged')
                  ],
                ),
              ),
              const SizedBox(height: 10),
            ],
          ),
        );
      },
    );
  }
}

class _StatusWidget extends StatelessWidget {
  const _StatusWidget({Key? key, required this.color, required this.title})
      : super(key: key);
  final Color color;
  final String title;

  @override
  Widget build(BuildContext context) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        StatusIcon(color: color),
        const SizedBox(width: 10),
        Text(title),
        const SizedBox(width: 10),
      ],
    );
  }
}
