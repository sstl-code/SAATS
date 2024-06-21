import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/navigation_drawer/navigation_drawer.dart';
import 'package:ats_system/screens/task_list/data/task_provider.dart';
import 'package:ats_system/screens/task_list/srn/srn_page.dart';
import 'package:ats_system/screens/task_list/stn/stn_page.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class TaskListPage extends StatefulWidget {
  static const String routeName = '/taskList';

  const TaskListPage({Key? key, required this.siteData}) : super(key: key);
  final SiteData siteData;

  @override
  State<TaskListPage> createState() => _TaskListPageState();
}

class _TaskListPageState extends State<TaskListPage>
    with WidgetsBindingObserver, SingleTickerProviderStateMixin {
  final TextEditingController searchController = TextEditingController();

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context
          .read<TaskProvider>()
          .fetchTasks(widget.siteData.tlLocationCode!)
          .then((value) =>
              context.read<HomeProvider>().setTaskCount(value.length));
      ;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
          centerTitle: false,
          title: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              const Text('Task List'),
              Text(
                  '${widget.siteData.tlLocationCode} ${widget.siteData.tlLocationAddress}',
                  style: const TextStyle(fontSize: 12))
            ],
          )),
      drawer:
          CustomNavigationDrawer(isFromAsset: true, siteData: widget.siteData),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          /// Task List
          Consumer<TaskProvider>(builder: (context, provider, child) {
            return provider.isLoading
                ? const Expanded(child: ProgressBar())
                : provider.taskList.isEmpty
                    ? const Expanded(
                        child: Center(child: Text('Data not found.')))
                    : Expanded(
                        child: SingleChildScrollView(
                          child: ListView.builder(
                              shrinkWrap: true,
                              physics: const NeverScrollableScrollPhysics(),
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 10, vertical: 5),
                              itemCount: provider.taskList.length,
                              itemBuilder: (context, index) {
                                final data = provider.taskList.elementAt(index);
                                return GestureDetector(
                                  onTap: () {
                                    data.f2AType!.toLowerCase().contains('stn')
                                        ? Navigator.pushNamed(
                                            context, STNPage.routeName,
                                            arguments: {
                                                'task': provider.taskList
                                                    .elementAt(index),
                                                'siteData': widget.siteData
                                              })
                                        : Navigator.pushNamed(
                                            context, SRNPage.routeName,
                                            arguments: {
                                                'task': provider.taskList
                                                    .elementAt(index),
                                                'siteData': widget.siteData
                                              });
                                  },
                                  child: Card(
                                    elevation: 5,
                                    child: Padding(
                                      padding: const EdgeInsets.all(8.0),
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.stretch,
                                        children: [
                                          Row(children: [
                                            Image.asset(
                                                'assets/images/icon_bell.png',
                                                height: 15,
                                                width: 15,
                                                color: Colors.orange),
                                            const SizedBox(width: 10),
                                            Expanded(
                                                child: Text(
                                                    '${data.f2AType!.toLowerCase().contains('stn') ? 'STN' : 'SRN' ?? ''}# ${(data.f2AFileName?.split('/').last)?.split('.').first ?? ''}'))
                                          ]),
                                          const SizedBox(height: 10),
                                          Row(
                                            children: [
                                              Image.asset(
                                                  'assets/images/icon_serial_no.png',
                                                  height: 15,
                                                  width: 15),
                                              const SizedBox(width: 10),
                                              Text(
                                                  '${Constants.serialNo} : ${data.f2AManufactureSerialNo ?? ""}'),
                                            ],
                                          ),
                                          const SizedBox(height: 10),
                                          Row(
                                              crossAxisAlignment:
                                                  CrossAxisAlignment.start,
                                              children: [
                                                Image.asset(
                                                    'assets/images/icon_location.png',
                                                    height: 15,
                                                    width: 15,
                                                    color: Colors.red),
                                                const SizedBox(width: 10),
                                                Expanded(
                                                    child: Text(
                                                        '${data.f2ASiteCode ?? ''} ${data.f2AAddress ?? ''}'))
                                              ]),
                                        ],
                                      ),
                                    ),
                                  ),
                                );
                              }),
                        ),
                      );
          })
        ],
      ),
    );
  }
}
