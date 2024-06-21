import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/add_asset/components/popup_body_single_text.dart';
import 'package:ats_system/screens/add_asset/models/add_asset_request_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/task_list/data/task_provider.dart';
import 'package:ats_system/screens/task_list/models/task_model.dart';
import 'package:ats_system/screens/task_list/stn/widgets/stn_attributes_widget.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/tag_asset/tag_asset.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/input_dropdown_widget.dart';
import 'package:ats_system/widgets/input_text_widget.dart';
import 'package:ats_system/widgets/item_widget.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:dynamic_height_grid_view/dynamic_height_grid_view.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class STNPage extends StatefulWidget {
  static const String routeName = '/stnPage';

  const STNPage({Key? key, required this.task, required this.siteData})
      : super(key: key);
  final Task task;
  final SiteData siteData;

  @override
  State<STNPage> createState() => _STNPageState();
}

class _STNPageState extends State<STNPage> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<TaskProvider>().clearData();
      context
          .read<TaskProvider>()
          .fetchSTN(widget.task.f2AManufactureSerialNo!, widget.task.f2ASiteId);
    });
  }

  @override
  Widget build(BuildContext context_) {
    return Scaffold(
      backgroundColor: scaffoldBackgroundColor,
      appBar: AppBar(
          title: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              Text(
                  'STN# ${(widget.task.f2AFileName?.split('/').last)?.split('.').first ?? ''}'),
              const Text('Add New Asset',
                  style: TextStyle(color: Colors.white, fontSize: 12)),
            ],
          ),
          elevation: 0,
          centerTitle: false),
      body: Consumer<TaskProvider>(builder: (context, provider, child) {
        final model = provider.statList;
        return provider.isSRNLoading
            ? const ProgressBar()
            : SingleChildScrollView(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      MediaQuery.removePadding(
                        context: context,
                        removeTop: true,
                        child: DynamicHeightGridView(
                          crossAxisCount: 2,
                          shrinkWrap: true,
                          physics: const NeverScrollableScrollPhysics(),
                          itemCount: model.length,
                          builder: (context, index) {
                            if (model.elementAt(index).key ==
                                Constants.assetName) {
                              return InputText(
                                title: model.elementAt(index).key,
                                controller: provider.assetNameController,
                                onChanged: (_) {},
                                isMandate: true,
                                maxLines: 1,
                                error: null,
                              );
                            } else {
                              return ItemWidget(
                                  title: model.elementAt(index).key,
                                  value:
                                      model.elementAt(index).value.toString());
                            }
                          },
                        ),
                      ),
                      Visibility(
                        visible: provider
                                .singleAssetModel?.data?.taAssetCatagory
                                ?.toUpperCase() ==
                            'ACTIVE',
                        child: InputDropdown(
                          title: 'Operator',
                          isMandate: true,
                          child: Container(
                            color: Colors.white,
                            padding: const EdgeInsets.all(3),
                            child: DropdownButton<Operator>(
                              isDense: true,
                              underline: const SizedBox(),
                              value: provider.operator,
                              isExpanded: true,
                              items: provider.operatorList
                                  .map<DropdownMenuItem<Operator>>(
                                      (Operator value) {
                                return DropdownMenuItem<Operator>(
                                  value: value,
                                  child: Text(value.operatorName ?? '',
                                      style: Theme.of(context)
                                          .textTheme
                                          .bodyMedium),
                                );
                              }).toList(),
                              onChanged: (Operator? newValue) =>
                                  setState(() => provider.operator = newValue!),
                            ),
                          ),
                        ),
                      ),
                      MediaQuery.removePadding(
                        context: context,
                        removeTop: true,
                        child: Selector<TaskProvider, List<AssetAttribute>>(
                          selector: (c, p) => p.statAttributes,
                          builder: (_, attributes, c) {
                            return StnAttributesWidget(data: attributes);
                          },
                        ),
                      ),
                      const SizedBox(height: 15.0),
                      _InputText(
                          title: Constants.siteAddress,
                          value: widget.siteData.tlLocationAddress ?? ''),
                      _InputDropdown(
                          title: Constants.remarks,
                          child: Container(
                            constraints: const BoxConstraints(minHeight: 150),
                            padding: const EdgeInsets.symmetric(horizontal: 5),
                            color: Colors.white,
                            child: TextField(
                              controller: provider.remarksController,
                              keyboardType: TextInputType.multiline,
                              maxLines: null,
                              decoration: const InputDecoration(
                                  border: InputBorder.none,
                                  hintStyle: TextStyle(fontSize: 36.0)),
                            ),
                          )),
                      const SizedBox(height: 15.0),
                      const Divider(thickness: 1),
                      const SizedBox(height: 10.0),
                      const Text(Constants.dynamicAttributes,
                          textAlign: TextAlign.center,
                          style: TextStyle(
                              fontSize: 18, fontWeight: FontWeight.w600)),
                      const SizedBox(height: 10.0),
                      Selector<TaskProvider, List<AssetAttribute>>(
                        selector: (c, p) => p.dynaAttributes,
                        builder: (_, attributes, c) {
                          return StnAttributesWidget(data: attributes);
                        },
                      ),
                      const SizedBox(height: 10.0),
                      const Divider(thickness: 1),
                      const SizedBox(height: 10.0),
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
                              onPressed: () async {
                                FocusScope.of(context).unfocus();

                                CustomDialogBox.appDialog(
                                    context,
                                    CustomDialog(
                                      title: Strings.dialogTitleMessage,
                                      body: PopupBodySingleTextDialog(
                                        desc:
                                            'Have you attached the TAG to the Asset as per Defined Operating Procedure?',
                                      ),
                                      footer: Row(
                                        mainAxisAlignment:
                                            MainAxisAlignment.center,
                                        children: [
                                          ElevatedButton(
                                              onPressed: () {
                                                Navigator.pop(context);
                                                scanQR(
                                                  context: context,
                                                  onImageCaputedFailed: () {
                                                    provider.clearImage();
                                                  },
                                                  onImageCaptured: (p0) {
                                                    provider.setImageFile(p0);
                                                  },
                                                  onQrScanned: (p0) {
                                                    provider.setQrCode(p0);
                                                  },
                                                  onQRScanFailed: () {
                                                    provider.clearTagging();
                                                  },
                                                );
                                              },
                                              child:
                                                  const Text(Strings.btnYes)),
                                          const SizedBox(width: 10),
                                          ElevatedButton(
                                              onPressed: () {
                                                Navigator.pop(context);
                                              },
                                              child: const Text(Strings.btnNo)),
                                        ],
                                      ),
                                    ));
                              },
                              child: const Text('Scan'),
                            ),
                          ),
                          const SizedBox(width: 20),
                          Expanded(
                            child: ElevatedButton(
                                onPressed: (provider.qrCode?.isNotEmpty == true)
                                    ? () async {
                                        FocusScope.of(context).unfocus();

                                        bool isValidated =
                                            await provider.isValidated();
                                        if (isValidated) {
                                          AddAssetRequestModel model =
                                              await provider.getRequestModel();

                                          provider
                                              .updateSTN(model)
                                              .then((value) {
                                            ToastMessage.showMessage(
                                                value.message,
                                                value.status ==
                                                        SUCCESS_RESPONSE_CODE
                                                    ? kToastSuccessColor
                                                    : kToastErrorColor);
                                            if (value.status ==
                                                SUCCESS_RESPONSE_CODE) {
                                              provider.clearData();
                                              provider.assetNameController
                                                  .clear();
                                              provider.remarksController
                                                  .clear();

                                              context_
                                                  .read<TaskProvider>()
                                                  .fetchTasks(widget
                                                      .siteData.tlLocationCode!)
                                                  .then((value) {
                                                context_
                                                    .read<HomeProvider>()
                                                    .setTaskCount(value.length);
                                                Navigator.pop(context_);
                                              });
                                              ;
                                            }
                                          });
                                        }
                                      }
                                    : null,
                                child: (provider.isSubmitted)
                                    ? SizedBox(
                                        width: 18.0,
                                        height: 18.0,
                                        child: CircularProgressIndicator(
                                          color: Colors.white,
                                          strokeWidth: 2,
                                        ),
                                      )
                                    : Text('Submit')),
                          )
                        ],
                      ),
                      const SizedBox(height: 20.0),
                    ]),
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
      padding: const EdgeInsets.only(bottom: 8.0, left: 8.0, right: 8.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          Text(title,
              style:
                  const TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
          const SizedBox(height: 5),
          Container(
            padding: const EdgeInsets.all(5),
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
