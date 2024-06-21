import 'package:ats_system/screens/add_asset/add_asset_screen.dart';
import 'package:ats_system/screens/add_asset/components/popup_body_single_text.dart';
import 'package:ats_system/screens/add_asset/enum/add_asset_screen_from.dart';
import 'package:ats_system/screens/add_asset/enum/is_child_allowed_to_add.dart';
import 'package:ats_system/screens/asset_details/asset_page/edit_dynamic_attributes.dart';
import 'package:ats_system/screens/asset_details/asset_page/edit_static_attributes.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/permission_manager.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/tag_asset/tag_asset.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/item_widget.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:ats_system/widgets/view_image_widget.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dynamic_height_grid_view/dynamic_height_grid_view.dart';
import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:provider/provider.dart';

class AssetPage extends StatefulWidget {
  static const String routeName = '/assetPage';

  const AssetPage(
      {Key? key,
      required this.assetId,
      required this.masterId,
      required this.assetName,
      required this.assetTypeName})
      : super(key: key);
  final int assetId, masterId;
  final String assetName, assetTypeName;

  @override
  State<AssetPage> createState() => _AssetPageState();
}

class _AssetPageState extends State<AssetPage> with WidgetsBindingObserver {
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (context) => AssetDetailsProvider(),
      child: Consumer<AssetDetailsProvider>(
        builder: (context, provider, child) {
          return ViewAssetWidget(
              assetId: widget.assetId,
              masterId: widget.masterId,
              assetName: widget.assetName,
              assetTypeName: widget.assetTypeName);
        },
      ),
    );
  }
}

class ViewAssetWidget extends StatefulWidget {
  @override
  State<ViewAssetWidget> createState() => _ViewAssetWidgetState();

  const ViewAssetWidget({
    Key? key,
    required this.assetId,
    required this.masterId,
    required this.assetName,
    required this.assetTypeName,
  }) : super(key: key);
  final int assetId, masterId;
  final String assetName, assetTypeName;
}

class _ViewAssetWidgetState extends State<ViewAssetWidget> {
  final _scrollController = ScrollController();

  @override
  void initState() {
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<AssetDetailsProvider>().clearAllData();

      context
          .read<AssetDetailsProvider>()
          .initializeAssetPage(widget.assetId, widget.masterId, true);
    });
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (context) => context.read<AssetDetailsProvider>(),
      child: Consumer<AssetDetailsProvider>(
        builder: (context, provider, child) {
          return Scaffold(
              appBar: AppBar(
                titleSpacing: 0.0,
                title: (provider.isAssetLoading)
                    ? SizedBox()
                    : Row(
                        children: [
                          (provider.singleAssetModel?.data?.taAssetImage ==
                                      null ||
                                  provider.singleAssetModel?.data?.taAssetImage
                                          ?.isEmpty ==
                                      true)
                              ? CircleAvatar(
                                  backgroundImage: AssetImage(
                                      'assets/images/no_image.png'), // Replace with your image path
                                  radius: 20,
                                )
                              : GestureDetector(
                                  onTap: () {
                                    CustomDialogBox.appDialog(
                                        context,
                                        CustomDialog(
                                          title: widget.assetName,
                                          body: ImageWidget(
                                              image: provider.singleAssetModel!
                                                  .data!.taAssetImage!),
                                          footer: ElevatedButton(
                                              onPressed: () =>
                                                  Navigator.pop(context),
                                              child:
                                                  const Text(Strings.btnClose)),
                                        ));
                                  },
                                  child: ClipOval(
                                    child: CachedNetworkImage(
                                        height: 40,
                                        width: 40,
                                        imageUrl: provider.singleAssetModel!
                                            .data!.taAssetImage!,
                                        placeholder: (context, url) => Center(
                                              child: SizedBox(
                                                width: 40.0,
                                                height: 40.0,
                                                child:
                                                    new CircularProgressIndicator(),
                                              ),
                                            ),
                                        errorWidget: (context, url, error) =>
                                            Icon(Icons.error),
                                        fit: BoxFit.fill),
                                  ),
                                ),
                          const SizedBox(width: 10),
                          Expanded(
                            child: Tooltip(
                              message: (widget.assetTypeName.isEmpty)
                                  ? widget.assetName
                                  : '${widget.assetTypeName}- ${widget.assetName}',
                              child: Text((widget.assetTypeName.isEmpty)
                                  ? widget.assetName
                                  : '${widget.assetTypeName}- ${widget.assetName}'),
                            ),
                          ),
                        ],
                      ),
              ),
              body: (provider.isAssetLoading)
                  ? ProgressBar()
                  : SingleChildScrollView(
                      controller: _scrollController,
                      child: Padding(
                        padding: const EdgeInsets.all(8.0),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.stretch,
                          children: [
                            /// Static Data
                            Align(
                                alignment: Alignment.centerRight,
                                child: ElevatedButton(
                                    style: ButtonStyle(
                                      padding: MaterialStateProperty.all<
                                          EdgeInsetsGeometry>(EdgeInsets.zero),
                                    ),
                                    onPressed: () {
                                      var data = provider.statList
                                          .where((element) =>
                                              element.datatype == 'FLoV')
                                          .toList();
                                      for (var d in data) {
                                        provider.flovValueList[d.key] =
                                            d.value ?? null;
                                      }
                                      CustomDialogBox.appDialog(
                                          context,
                                          CustomDialog(
                                            title: 'Edit Details',
                                            bodyPadding: 10,
                                            body: ChangeNotifierProvider.value(
                                              value: context
                                                  .read<AssetDetailsProvider>(),
                                              child: EditStaticAttributesWidget(
                                                  assetId: provider
                                                      .singleAssetModel!
                                                      .data!
                                                      .taAssetId!),
                                            ),
                                            footer: SizedBox(),
                                          ));
                                    },
                                    child: const Text('Edit'))),

                            ///Static attributes
                            DynamicHeightGridView(
                              crossAxisCount: 2,
                              shrinkWrap: true,
                              physics: const NeverScrollableScrollPhysics(),
                              itemCount: provider.statList.length,
                              builder: (context, index) => ItemWidget(
                                  title: provider.statList.elementAt(index).key,
                                  value: provider.statList
                                              .elementAt(index)
                                              .value ==
                                          null
                                      ? ''
                                      : provider.statList
                                          .elementAt(index)
                                          .value
                                          .toString()),
                            ),

                            /// Dynamic Attributes
                            if (provider.dynaList.isNotEmpty)
                              DynamicAttributesWidget(
                                assetId:
                                    provider.singleAssetModel?.data?.taAssetId,
                              ),

                            // Child Assets
                            ChildAttributeWidget(
                                assetModel: provider.singleAssetModel),
                            const Divider(thickness: 1),

                            const SizedBox(height: 15),

                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Expanded(
                                    child: ElevatedButton(
                                        onPressed: () async {
                                          PermissionManager
                                                  .hasCameraPermission()
                                              .then((value) {
                                            if (value) {
                                              CustomDialogBox.appDialog(
                                                  context,
                                                  CustomDialog(
                                                    title: Strings
                                                        .dialogTitleMessage,
                                                    body:
                                                        PopupBodySingleTextDialog(
                                                      desc:
                                                          'Have you attached the TAG to the Asset as per Defined Operating Procedure?',
                                                    ),
                                                    footer: Row(
                                                      mainAxisAlignment:
                                                          MainAxisAlignment
                                                              .center,
                                                      children: [
                                                        ElevatedButton(
                                                            onPressed: () {
                                                              Navigator.pop(
                                                                  context);

                                                              scanQR(
                                                                context:
                                                                    context,
                                                                onImageCaputedFailed:
                                                                    () {
                                                                  provider
                                                                      .clearImage();
                                                                },
                                                                onImageCaptured:
                                                                    (p0) {
                                                                  provider
                                                                      .setImageFile(
                                                                          p0);
                                                                },
                                                                onQrScanned:
                                                                    (p0) {
                                                                  provider
                                                                      .setQrCode(
                                                                          p0);
                                                                },
                                                                onQRScanFailed:
                                                                    () {
                                                                  provider
                                                                      .clearTagging();
                                                                },
                                                              );
                                                            },
                                                            child: const Text(
                                                                Strings
                                                                    .btnYes)),
                                                        const SizedBox(
                                                            width: 10),
                                                        ElevatedButton(
                                                            onPressed: () {
                                                              Navigator.pop(
                                                                  context);
                                                            },
                                                            child: const Text(
                                                                Strings.btnNo)),
                                                      ],
                                                    ),
                                                  ));
                                            } else {
                                              PermissionManager().requestPermission(
                                                  onPermissionDenied: () =>
                                                      CustomDialogBox
                                                          .showPermissionDialog(
                                                              context),
                                                  permission: [
                                                    Permission.camera
                                                  ]);
                                            }
                                          });
                                        },
                                        child: const Text(Strings.btnTag))),
                                const SizedBox(width: 20),
                                Expanded(
                                    child: ElevatedButton(
                                  onPressed: (provider.qrCode?.isNotEmpty ==
                                          true)
                                      ? () {
                                          provider
                                              .newImageUpload(
                                                  widget.assetId,
                                                  provider.qrCode,
                                                  provider.imageFile)
                                              .then((value) {
                                            if (value.status ==
                                                SUCCESS_RESPONSE_CODE) {
                                              provider.getSingleAssetDetails(
                                                  widget.assetId, true);
                                            }
                                            ToastMessage.showMessage(
                                                value.message,
                                                value.status ==
                                                        SUCCESS_RESPONSE_CODE
                                                    ? kToastSuccessColor
                                                    : kToastErrorColor);
                                            provider.clearTagging();
                                          });
                                        }
                                      : null,
                                  child: (provider.isAssetTagLoading)
                                      ? SizedBox(
                                          width: 18.0,
                                          height: 18.0,
                                          child: CircularProgressIndicator(
                                            color: Colors.white,
                                            strokeWidth: 2,
                                          ),
                                        )
                                      : Text('Submit'),
                                ))
                              ],
                            )
                          ],
                        ),
                      ),
                    ));
        },
      ),
    );
  }
}

class ChildAttributeWidget extends StatelessWidget {
  const ChildAttributeWidget({Key? key, required this.assetModel})
      : super(key: key);
  final SingleAssetModel? assetModel;

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        if (assetModel?.data?.childs?.isNotEmpty == true ||
            assetModel?.data?.atIsChildAvailable ==
                IsChildAllowedToAdd.allowToAddChild.value)
          Column(
            children: [
              const SizedBox(height: 10),
              const Divider(thickness: 1),
              const SizedBox(height: 10),
            ],
          ),
        Stack(
          children: [
            if (assetModel?.data?.atIsChildAvailable ==
                IsChildAllowedToAdd.allowToAddChild.value)
              Positioned(
                top: 0,
                right: 0,
                bottom: 0,
                child: ElevatedButton(
                    onPressed: () async {
                      Navigator.pushNamed(context, AddAssetScreen.routeName,
                          arguments: {
                            'addAssetScreenFrom':
                                AddAssetType.addChildFromViewScreen,
                            'category': assetModel?.data?.taAssetCatagory,
                            'assetTypeId':
                                assetModel?.data?.taAssetTypeMasterId,
                            'assetId': assetModel?.data?.taAssetId,
                            'parentAssetName': assetModel?.data?.taAssetName,
                            'parentAssetTypeDesc': assetModel?.data?.assetType,
                            'parentSerialNumber':
                                assetModel?.data?.taAssetManufactureSerialNo,
                          });
                    },
                    child: const Text(Strings.btnAdd)),
              ),
            if (assetModel?.data?.childs?.isNotEmpty == true ||
                assetModel?.data?.atIsChildAvailable ==
                    IsChildAllowedToAdd.allowToAddChild.value)
              Center(
                child: Container(
                  padding: EdgeInsets.all(5),
                  child: Text('Child Assets',
                      textAlign: TextAlign.center,
                      style:
                          TextStyle(fontSize: 18, fontWeight: FontWeight.w600)),
                ),
              ),
          ],
        ),
        if (assetModel?.data?.childs?.isNotEmpty == true)
          Padding(
            padding: const EdgeInsets.only(top: 16.0),
            child: ListView.builder(
                shrinkWrap: true,
                itemCount: assetModel?.data?.childs?.length,
                physics: const NeverScrollableScrollPhysics(),
                itemBuilder: (context, index) {
                  var bean = assetModel?.data?.childs?[index];
                  return GestureDetector(
                    onTap: () {
                      Navigator.pushNamed(context, AssetPage.routeName,
                          arguments: {
                            'assetId': bean?.taAssetId,
                            'assetTypeMasterId': bean?.taAssetTypeMasterId,
                            'assetName': bean?.taAssetName,
                            'assetTypeName': bean?.assetType ?? '',
                          });
                    },
                    child: ListTile(
                      subtitle: Text('Sl# ${bean?.taAssetManufactureSerialNo}'),
                      leading: SizedBox(
                        width: 50.0,
                        height: 50.0,
                        child: ClipRRect(
                          borderRadius: BorderRadius.circular(10.0),
                          child: (bean?.taAssetImage != null)
                              ? CachedNetworkImage(
                                  imageUrl: bean?.taAssetImage ?? '',
                                  fit: BoxFit.fill,
                                  placeholder: (context, url) => Center(
                                    child: SizedBox(
                                      width: 40.0,
                                      height: 40.0,
                                      child: new CircularProgressIndicator(),
                                    ),
                                  ),
                                  errorWidget: (context, url, error) =>
                                      Icon(Icons.error),
                                )
                              : Image.asset(
                                  'assets/images/no_image.png',
                                  fit: BoxFit.cover,
                                ),
                        ),
                      ),
                      trailing: Icon(Icons.keyboard_arrow_right_sharp),
                      title: Row(
                        children: [
                          Text(bean?.assetType ?? 'N/A'),
                          const SizedBox(
                            width: 10,
                          ),
                          Container(
                            height: 12.0,
                            width: 12.0,
                            decoration: BoxDecoration(
                                shape: BoxShape.circle,
                                color: bean?.taAssetTagNumber != null
                                    ? Colors.green
                                    : Colors.red,
                                boxShadow: const [
                                  BoxShadow(
                                      color: Colors.black45,
                                      offset: Offset(0.0, 0.5),
                                      blurRadius: 1.0,
                                      spreadRadius: 0.5)
                                ]),
                          )
                        ],
                      ),
                    ),
                  );
                }),
          ),
        if (assetModel?.data?.childs?.isNotEmpty == true ||
            assetModel?.data?.atIsChildAvailable ==
                IsChildAllowedToAdd.allowToAddChild.value)
          Column(
            children: [
              const SizedBox(height: 10),
            ],
          ),
      ],
    );
  }
}

class DynamicAttributesWidget extends StatelessWidget {
  const DynamicAttributesWidget({
    Key? key,
    this.assetId,
  }) : super(key: key);
  final int? assetId;

  @override
  Widget build(BuildContext context) {
    return Consumer<AssetDetailsProvider>(
      builder: (context, provider, state) {
        return Column(
          children: [
            const SizedBox(
              height: 10,
            ),
            const Divider(thickness: 1),
            const SizedBox(
              height: 10,
            ),
            Stack(
              children: [
                Center(
                    child: Container(
                  padding: EdgeInsets.all(5),
                  child: Text(Constants.dynamicAttributes,
                      textAlign: TextAlign.center,
                      style:
                          TextStyle(fontSize: 18, fontWeight: FontWeight.w600)),
                )),
                Positioned(
                  top: 0,
                  right: 0,
                  bottom: 0,
                  child: ElevatedButton(
                      onPressed: provider.dynaList.isEmpty
                          ? null
                          : () {
                              var data = provider.dynaList
                                  .where(
                                      (element) => element.datatype == 'FLoV')
                                  .toList();
                              for (var d in data) {
                                provider.flovValueList[d.key] = d.value ?? null;
                              }
                              CustomDialogBox.appDialog(
                                  context,
                                  CustomDialog(
                                    title: Constants.editDynamicAttributes,
                                    body: ChangeNotifierProvider.value(
                                      value:
                                          context.read<AssetDetailsProvider>(),
                                      child: EditDynamicAttributesWidget(
                                          assetId: assetId!),
                                    ),
                                    footer: SizedBox(),
                                  ));
                            },
                      child: const Text('Edit')),
                )
              ],
            ),
            const SizedBox(height: 10),
            DynamicHeightGridView(
              crossAxisCount: 2,
              itemCount: provider.dynaList.length,
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              builder: (context, index) {
                final d = provider.dynaList.elementAt(index);
                return ItemWidget(
                    title: d.key, value: d.value == null ? '' : d.value!);
              },
            ),
          ],
        );
      },
    );
  }
}
