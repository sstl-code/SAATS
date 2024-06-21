import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/task_list/data/task_provider.dart';
import 'package:ats_system/screens/task_list/models/task_model.dart';
import 'package:ats_system/screens/task_list/srn/asset_deallocation_widget.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/item_widget.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:dynamic_height_grid_view/dynamic_height_grid_view.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class SRNPage extends StatefulWidget {
  static const String routeName = '/srnPage';

  const SRNPage({Key? key, required this.task, required this.siteData})
      : super(key: key);
  final Task task;
  final SiteData siteData;

  @override
  State<SRNPage> createState() => _SRNPageState();
}

class _SRNPageState extends State<SRNPage> {
  final ScrollController _scrollController = ScrollController();
  final TextEditingController _remarksController = TextEditingController();

  void _showDialog(BuildContext context) {
    CustomDialogBox.appDialog(
        context,
        CustomDialog(
          title: 'SRN Confirmation',
          body: AssetDeallocationWidget(),
          footer: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Align(
                alignment: Alignment.center,
                child: ElevatedButton(
                    onPressed: () {
                      context
                          .read<TaskProvider>()
                          .updateSRN(
                              context
                                  .read<TaskProvider>()
                                  .singleAssetModel!
                                  .data!
                                  .taAssetId!,
                              _remarksController.text)
                          .then((response) {
                        ToastMessage.showMessage(
                            response.message,
                            response.status == SUCCESS_RESPONSE_CODE
                                ? kToastSuccessColor
                                : kToastErrorColor);
                        if (response.status == SUCCESS_RESPONSE_CODE) {
                          _remarksController.clear();

                          context
                              .read<TaskProvider>()
                              .fetchTasks(widget.siteData.tlLocationCode!)
                              .then((value) => context
                                  .read<HomeProvider>()
                                  .setTaskCount(value.length));
                          setState(() => _remarksController.clear());
                          Navigator.pop(context);
                          Navigator.pop(context);
                        }
                      });
                    },
                    child: const Text(Strings.btnYes)),
              ),
              const SizedBox(width: 10),
              Align(
                alignment: Alignment.center,
                child: ElevatedButton(
                    onPressed: () {
                      Navigator.pop(context);
                    },
                    child: const Text(Strings.btnNo)),
              ),
            ],
          ),
        ));
  }

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<TaskProvider>().clearData();
      context
          .read<TaskProvider>()
          .fetchSRN(widget.task.f2AManufactureSerialNo!, widget.task.f2ASiteId);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: scaffoldBackgroundColor,
      appBar: AppBar(
          title: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              Text(
                  'SRN# ${(widget.task.f2AFileName?.split('/').last)?.split('.').first ?? ''}'),
              const Text('Asset Deallocation',
                  style: TextStyle(color: Colors.white, fontSize: 12)),
            ],
          ),
          elevation: 0,
          centerTitle: false),
      body: Consumer<TaskProvider>(builder: (context, provider, child) {
        final model = provider.statList;
        return provider.isSRNLoading
            ? const ProgressBar()
            : Scrollbar(
                controller: _scrollController,
                child: SingleChildScrollView(
                  controller: _scrollController,
                  padding: const EdgeInsets.all(8.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      DynamicHeightGridView(
                        crossAxisCount: 2,
                        crossAxisSpacing: 5,
                        mainAxisSpacing: 15,
                        shrinkWrap: true,
                        physics: const NeverScrollableScrollPhysics(),
                        itemCount: model.length,
                        builder: (context, index) => ItemWidget(
                            title: model.elementAt(index).key,
                            value: model.elementAt(index).value.toString()),
                      ),
                      const SizedBox(height: 10.0),
                      MediaQuery.removePadding(
                        context: context,
                        removeTop: true,
                        child: Selector<TaskProvider, List<AssetTypeAttr>>(
                          selector: (c, p) => p.srnStatAttributes ?? [],
                          builder: (_, attributes, c) {
                            return DynamicHeightGridView(
                                itemCount: attributes.length,
                                crossAxisCount: 2,
                                shrinkWrap: true,
                                physics: const NeverScrollableScrollPhysics(),
                                builder: (bean, index) {
                                  final d = attributes.elementAt(index);
                                  AttrMaster? master = d.typeAttrMaster;
                                  if (master != null) {
                                    return ItemWidget(
                                        title:
                                            master.ataAssetTypeAttributeName ??
                                                '',
                                        value:
                                            d.atAssetAttributeValueText ?? '');
                                  } else {
                                    return SizedBox();
                                  }
                                });
                          },
                        ),
                      ),
                      _InputText(
                          title: "Site Address",
                          value: widget.siteData.tlLocationAddress ?? ''),
                      _InputDropdown(
                          title: Constants.remarks,
                          child: Container(
                            constraints: const BoxConstraints(minHeight: 150),
                            color: Colors.white,
                            child: TextField(
                              controller: _remarksController,
                              keyboardType: TextInputType.multiline,
                              maxLines: null,
                              decoration: const InputDecoration(
                                  border: InputBorder.none,
                                  hintStyle: TextStyle(fontSize: 36.0)),
                            ),
                          )),
                      const SizedBox(height: 10.0),
                      const Divider(thickness: 1),
                      const SizedBox(height: 10.0),
                      Selector<TaskProvider, List<AssetTypeAttr>>(
                        selector: (c, p) => p.srnDynaAttributes ?? [],
                        builder: (_, attributes, c) {
                          return (attributes.isNotEmpty == true)
                              ? Column(
                                  children: [
                                    const Text(Constants.dynamicAttributes,
                                        textAlign: TextAlign.center,
                                        style: TextStyle(
                                            fontSize: 18,
                                            fontWeight: FontWeight.w600)),
                                    const SizedBox(height: 10.0),
                                    DynamicHeightGridView(
                                        itemCount: attributes.length,
                                        crossAxisCount: 2,
                                        shrinkWrap: true,
                                        physics:
                                            const NeverScrollableScrollPhysics(),
                                        builder: (bean, index) {
                                          final d = attributes.elementAt(index);
                                          AttrMaster? master = d.typeAttrMaster;
                                          if (master != null) {
                                            return ItemWidget(
                                                title: master
                                                        .ataAssetTypeAttributeName ??
                                                    '',
                                                value:
                                                    d.atAssetAttributeValueText ??
                                                        '');
                                          } else {
                                            return SizedBox();
                                          }
                                        }),
                                    const SizedBox(height: 10.0),
                                    const Divider(thickness: 1),
                                    const SizedBox(height: 10.0),
                                  ],
                                )
                              : SizedBox();
                        },
                      ),
                      Center(
                        child: const Text('Are these Asset Details matching?',
                            style: TextStyle(
                                fontSize: 18, fontWeight: FontWeight.bold)),
                      ),
                      const SizedBox(height: 20.0),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Expanded(
                            child: ElevatedButton(
                                onPressed: () {
                                  FocusScope.of(context).unfocus();
                                  _showDialog(context);
                                },
                                child: const Text(Strings.btnYes)),
                          ),
                          const SizedBox(width: 20.0),
                          Expanded(
                            child: ElevatedButton(
                                onPressed: () {
                                  context
                                      .read<HomeProvider>()
                                      .sendMail('srnNotMatching',
                                          assetId: provider.singleAssetModel
                                              ?.data?.taAssetId)
                                      .then((value) {
                                    if (value.statusCode ==
                                        SUCCESS_RESPONSE_CODE) {
                                      Navigator.of(context).pop();
                                    }
                                  });
                                },
                                child: const Text(Strings.btnNo)),
                          ),
                        ],
                      ),
                      const SizedBox(height: 20.0),
                    ],
                  ),
                ),
              );
      }),
    );
  }
}

class _InputText extends StatelessWidget {
  const _InputText({Key? key, required this.title, required this.value})
      : super(key: key);
  final String title;
  final String value;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          Text(title,
              style:
                  const TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
          const SizedBox(height: 5),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
            color: Colors.white,
            child: Text(value),
          ),
        ],
      ),
    );
  }
}

class _InputDropdown<T> extends StatelessWidget {
  const _InputDropdown({Key? key, required this.title, required this.child})
      : super(key: key);
  final String title;
  final Widget child;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(title,
              style:
                  const TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
          const SizedBox(height: 5),
          child,
        ],
      ),
    );
  }
}
