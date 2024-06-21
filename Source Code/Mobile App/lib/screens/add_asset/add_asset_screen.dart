import 'dart:io';

import 'package:ats_system/main.dart';
import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/add_asset/components/add_assets_attributes_widget.dart';
import 'package:ats_system/screens/add_asset/components/draft_row_widget.dart';
import 'package:ats_system/screens/add_asset/components/popup_body_single_text.dart';
import 'package:ats_system/screens/add_asset/data/add_asset_provider.dart';
import 'package:ats_system/screens/add_asset/enum/add_asset_screen_from.dart';
import 'package:ats_system/screens/add_asset/enum/asset_search_enum.dart';
import 'package:ats_system/screens/add_asset/enum/is_child_allowed_to_add.dart';
import 'package:ats_system/screens/add_asset/models/asset_type_model.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/permission_manager.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/tag_asset/tag_asset.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/input_dropdown_widget.dart';
import 'package:ats_system/widgets/input_text_widget.dart';
import 'package:flutter/material.dart';
import 'package:hive_flutter/adapters.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:provider/provider.dart';

class AddAsset extends StatefulWidget {
  const AddAsset({
    Key? key,
    required this.assetTypeId,
    this.category,
    this.parentAssetName,
    this.parentAssetTypeDesc,
    this.parentSerialNumber,
    this.editAssetModel,
    required this.addAssetScreenFrom,
    this.assetId,
  }) : super(key: key);
  final int? assetTypeId, assetId;
  final String? category,
      parentAssetName,
      parentAssetTypeDesc,
      parentSerialNumber;
  final AddAssetType addAssetScreenFrom;
  final SingleAssetModel? editAssetModel;

  @override
  State<AddAsset> createState() => _AddAssetState();
}

class _AddAssetState extends State<AddAsset> with WidgetsBindingObserver {
  final ScrollController _scrollController = ScrollController();
  String? tagNo = '';
  SiteData? selectedSite;

  @override
  void dispose() {
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  void didChangeAppLifecycleState(AppLifecycleState state) async {
    if (state == AppLifecycleState.paused) {
      await context.read<AddAssetProvider>().addAssetToBox();
    } else if (state == AppLifecycleState.resumed) {
      if (context.read<AddAssetProvider>().serialController.text.isNotEmpty) {
        SingleAsset? asset = await context.read<AddAssetProvider>().getAsset();
        if (asset != null) {
          asset.delete();
        }
      }
    }

    super.didChangeAppLifecycleState(state);
  }

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);

    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<AddAssetProvider>().clear();
      selectedSite = context.read<HomeProvider>().selectedSite!;
      context.read<AddAssetProvider>().siteIdController.text =
          selectedSite!.tlLocationCode!;

      context.read<AddAssetProvider>().parentAssetSerialNumberController.text =
          widget.parentSerialNumber!;
      context.read<AddAssetProvider>().parentAssetId = widget.assetId;
      context.read<AddAssetProvider>().parentAssetTypeController.text =
          widget.parentAssetTypeDesc!;
      if (widget.editAssetModel != null) {
        context.read<AddAssetProvider>().serialController.text =
            widget.editAssetModel?.data?.taAssetManufactureSerialNo ?? '';
        context.read<AddAssetProvider>().prepopulateData(
              parentAssetId: widget.assetTypeId,
              result: widget.editAssetModel,
              addAssetScreenFrom: widget.addAssetScreenFrom,
              category:
                  widget.editAssetModel?.data?.taAssetCatagory?.toUpperCase(),
            );
      }
    });
  }

  @override
  Widget build(BuildContext _context) {
    return ChangeNotifierProvider.value(
      value: context.read<AddAssetProvider>(),
      child: Consumer<AddAssetProvider>(
        builder: (context, provider, child) {
          if (widget.addAssetScreenFrom ==
              AddAssetType.addParentFromAssetListing) {
            provider.parentAssetController.text = '-';
          } else {
            if (widget.parentAssetName == null ||
                widget.parentAssetName?.isEmpty == true) {
              provider.parentAssetController.text = '-';
            } else {
              provider.parentAssetController.text = widget.parentAssetName!;
            }
          }
          return WillPopScope(
            onWillPop: () async {
              if (provider.isShowDataWillbeLosedDialog()) {
                bool shouldExit = await showDialog(
                  context: context,
                  barrierDismissible: false,
                  builder: (BuildContext context) {
                    return CustomDialog(
                      title: addAssetDraftTitle,
                      body: PopupBodySingleTextDialog(
                        desc: addAssetDraftDesc,
                      ),
                      footer: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          ElevatedButton(
                              onPressed: () async {
                                await provider.addAssetToBox();
                                Navigator.of(
                                  context,
                                ).pop(true);
                              },
                              child: const Text('Yes')),
                          const SizedBox(width: 10),
                          ElevatedButton(
                              onPressed: () {
                                Navigator.of(context).pop(true);
                              },
                              child: const Text('No')),
                        ],
                      ),
                    );
                  },
                );
                return shouldExit;
              }

              return Future.value(true);
            },
            child: Scaffold(
              backgroundColor: scaffoldBackgroundColor,
              appBar: AppBar(
                  title: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text((widget.addAssetScreenFrom ==
                              AddAssetType.addParentFromAssetListing)
                          ? Strings.appBarAddNewAsset
                          : Strings.appBarChildAsset),
                      if (widget.addAssetScreenFrom ==
                          AddAssetType.addParentFromAssetListing)
                        Text(
                            '${selectedSite?.tlLocationCode}, ${selectedSite?.tlLocationName}',
                            style: const TextStyle(fontSize: 11))
                    ],
                  ),
                  elevation: 0,
                  centerTitle: false),
              body: Scrollbar(
                controller: _scrollController,
                child: SingleChildScrollView(
                  controller: _scrollController,
                  padding: const EdgeInsets.all(8.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                      if (widget.addAssetScreenFrom ==
                              AddAssetType.addChildFromViewScreen ||
                          widget.addAssetScreenFrom ==
                              AddAssetType.addChildFromAddAssetScreen)
                        Column(
                          children: [
                            Row(
                              children: [
                                Expanded(
                                    child: InputText(
                                  title: Constants.parentSerialNumber,
                                  controller: provider
                                      .parentAssetSerialNumberController,
                                  enabled: false,
                                  onChanged: (value) {},
                                )),
                                Expanded(
                                    child: InputText(
                                  title: Constants.parentAssetType,
                                  controller:
                                      provider.parentAssetTypeController,
                                  enabled: false,
                                  onChanged: (value) {},
                                )),
                              ],
                            ),
                            Row(
                              children: [
                                Expanded(
                                    child: InputText(
                                  title: Constants.parentAssetName,
                                  controller: provider.parentAssetController,
                                  inputType: TextInputType.number,
                                  error: provider.parentAssetError,
                                  enabled: false,
                                  onChanged: (value) {
                                    if (value != null &&
                                        provider.parentAssetError != null)
                                      setState(() =>
                                          provider.parentAssetError = null);
                                  },
                                )),
                                Expanded(
                                    child: InputText(
                                  title: Constants.siteID,
                                  controller: provider.siteIdController,
                                  error: provider.siteIdError,
                                  enabled: false,
                                  onChanged: (value) {
                                    if (value != null &&
                                        provider.siteIdError != null)
                                      setState(
                                          () => provider.siteIdError = null);
                                  },
                                )),
                              ],
                            ),
                            const SizedBox(height: 5),
                            Divider(
                              thickness: 1,
                            ),
                            const SizedBox(height: 5),
                          ],
                        ),

                      ///Drafts
                      ValueListenableBuilder<Box<SingleAsset>>(
                          valueListenable:
                              locator.get<Box<SingleAsset>>().listenable(),
                          builder: (context, box, child) {
                            final List<SingleAsset> draftList =
                                box.values.toList();

                            List<SingleAsset>? draftListByLocation = draftList
                                .where((item) =>
                                    item.taAssetLocationId ==
                                        selectedSite?.tlLocationId &&
                                    item.parentSerialNo ==
                                        widget.parentSerialNumber)
                                .toList();

                            return (draftListByLocation.isNotEmpty == true)
                                ? Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Padding(
                                        padding: const EdgeInsets.all(8.0),
                                        child: Text(
                                          'Drafts',
                                          style: TextStyle(
                                              fontSize: 17,
                                              fontWeight: FontWeight.w600),
                                        ),
                                      ),
                                      AddAssetDraftWidget(
                                        draftList: draftListByLocation,
                                        onTap: (bean) async {
                                          await provider.prepopulateData(
                                            parentAssetId: widget.assetTypeId,
                                            result:
                                                SingleAssetModel(data: bean),
                                            addAssetScreenFrom:
                                                widget.addAssetScreenFrom,
                                            category:
                                                SingleAssetModel(data: bean)
                                                    .data
                                                    ?.taAssetCatagory
                                                    ?.toUpperCase(),
                                          );
                                          bean.delete();
                                        },
                                      ),
                                    ],
                                  )
                                : SizedBox();
                          }),

                      /// Serial No
                      Row(
                        crossAxisAlignment: CrossAxisAlignment.end,
                        children: [
                          Expanded(
                            child: InputText(
                              title: Constants.serialNo,
                              controller: provider.serialController,
                              error: provider.serialError,
                              maxLines: 1,
                              isMandate: true,
                              onChanged: (value) {
                                provider.clear();

                                if (value != null &&
                                    provider.serialError != null) {
                                  setState(() => provider.serialError = null);
                                }
                              },
                            ),
                          ),
                          Container(
                            height: 31,
                            margin: EdgeInsets.only(bottom: 8),
                            child: ElevatedButton(
                                onPressed: () async {
                                  FocusScope.of(_context).unfocus();

                                  if (provider.serialController.text.isEmpty) {
                                    setState(() => provider.serialError =
                                        Strings.emptyField);
                                  } else {
                                    var result = await provider.fetchBySerialNo(
                                      tlLocationId: context
                                          .read<HomeProvider>()
                                          .selectedSite
                                          ?.tlLocationId,
                                    );

                                    if (result?.status ==
                                        AssetSearchStatus.allowToAdd.value) {
                                      provider.setCategory(
                                        addAssetScreenFrom:
                                            widget.addAssetScreenFrom,
                                        category: widget.category,
                                        assetTypeId: widget.assetTypeId,
                                      );
                                    } else if (result?.status ==
                                        AssetSearchStatus
                                            .dontAllowToAdd.value) {
                                      ToastMessage.showMessage(
                                          'Asset with same Serial no. already exists in this site.',
                                          kToastErrorColor);
                                    } else if (result?.status ==
                                        AssetSearchStatus
                                            .allowToAddByPrePopulating.value) {
                                      var desc = assetFoundInOtherSite;
                                      if (widget.addAssetScreenFrom ==
                                          AddAssetType
                                              .addParentFromAssetListing) {
                                        if (result?.data?.taAssetParentId ==
                                            0) {
                                          desc = assetFoundInOtherSite;
                                        } else {
                                          desc = assetFoundInOtherSiteAsChild;
                                        }
                                      } else {
                                        if (result?.data?.taAssetParentId ==
                                            0) {
                                          desc = assetFoundInOtherSiteAsParent;
                                        } else {
                                          desc = assetFoundInOtherSite;
                                        }
                                      }
                                      CustomDialogBox.appDialog(
                                          context,
                                          CustomDialog(
                                            title: 'Asset found in other site',
                                            body: PopupBodySingleTextDialog(
                                              desc: desc,
                                            ),
                                            footer: Row(
                                              mainAxisAlignment:
                                                  MainAxisAlignment.center,
                                              children: [
                                                ElevatedButton(
                                                    onPressed: () {
                                                      Navigator.of(context)
                                                          .pop();

                                                      provider.prepopulateData(
                                                        parentAssetId:
                                                            widget.assetTypeId,
                                                        result: result,
                                                        addAssetScreenFrom: widget
                                                            .addAssetScreenFrom,
                                                        category: result?.data
                                                            ?.taAssetCatagory
                                                            ?.toUpperCase(),
                                                      );
                                                    },
                                                    child: const Text(
                                                        Strings.btnYes)),
                                                const SizedBox(width: 10),
                                                ElevatedButton(
                                                    onPressed: () {
                                                      Navigator.of(context)
                                                          .pop();
                                                    },
                                                    child: const Text(
                                                        Strings.btnNo)),
                                              ],
                                            ),
                                          ));
                                    }
                                  }
                                },
                                child: const Text(Strings.btnVerify)),
                          ),
                        ],
                      ),

                      /// Category
                      Visibility(
                          visible: provider.categoryList.isNotEmpty,
                          child: InputDropdown(
                            title: 'Category',
                            isMandate: true,
                            child: Container(
                              color: Colors.white,
                              padding: const EdgeInsets.all(3),
                              child: (provider.categoryList.isEmpty)
                                  ? Container()
                                  : DropdownButton<String>(
                                      isDense: true,
                                      underline: const SizedBox(),
                                      value: provider.category?.toUpperCase(),
                                      isExpanded: true,
                                      items: provider.categoryList
                                          .map<DropdownMenuItem<String>>(
                                              (String value) {
                                        return DropdownMenuItem<String>(
                                          value: value,
                                          child: Text(value,
                                              style: Theme.of(context)
                                                  .textTheme
                                                  .bodyMedium),
                                        );
                                      }).toList(),
                                      onChanged: (String? newValue) =>
                                          provider.selectCategory(newValue!,
                                              id: widget.assetTypeId),
                                    ),
                            ),
                          )),

                      /// Asset Type
                      if (provider.assetTypeList.isNotEmpty)
                        Visibility(
                            visible: provider.assetTypeList.isNotEmpty,
                            child: InputDropdown(
                              title: Constants.assetType,
                              isMandate: true,
                              child: Container(
                                color: Colors.white,
                                padding: const EdgeInsets.all(3),
                                child: DropdownButton<AssetType?>(
                                  padding: EdgeInsets.zero,
                                  isDense: true,
                                  underline: const SizedBox(),
                                  value: provider.assetType,
                                  isExpanded: true,
                                  hint: Text('Select asset type'),
                                  items: provider.assetTypeList
                                      .map<DropdownMenuItem<AssetType>>(
                                          (AssetType? value) {
                                    return DropdownMenuItem<AssetType>(
                                      value: value,
                                      child: Text(value?.atAssetTypeName ?? '',
                                          style: Theme.of(context)
                                              .textTheme
                                              .bodyMedium),
                                    );
                                  }).toList(),
                                  onChanged: (provider.category == null)
                                      ? null
                                      : (AssetType? type) {
                                          provider.setAssetType(type!);
                                        },
                                ),
                              ),
                            )),

                      Visibility(
                          visible: provider.showAll,
                          child: Column(
                            children: [
                              Row(
                                children: [
                                  Expanded(
                                      child: InputText(
                                    title: Constants.assetName,
                                    controller: provider.nameController,
                                    error: provider.nameError,
                                    isMandate: true,
                                    onChanged: (value) {
                                      if (value != null &&
                                          provider.nameError != null)
                                        setState(
                                            () => provider.nameError = null);
                                    },
                                  )),
                                  Expanded(
                                      child: InputText(
                                    readOnly: true,
                                    onTap: () {},
                                    controller:
                                        provider.assetTagNumberController,
                                    title: Constants.assetTagNo,
                                    onChanged: (_) {},
                                    error: null,
                                  )),
                                ],
                              ),
                              (provider.operatorList.isEmpty)
                                  ? SizedBox()
                                  : Visibility(
                                      visible: provider.category == 'ACTIVE',
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
                                            items: provider.operatorList.map<
                                                    DropdownMenuItem<Operator>>(
                                                (Operator value) {
                                              return DropdownMenuItem<Operator>(
                                                value: value,
                                                child: Text(
                                                    value.operatorName ?? '',
                                                    style: Theme.of(context)
                                                        .textTheme
                                                        .bodyMedium),
                                              );
                                            }).toList(),
                                            onChanged: (Operator? newValue) =>
                                                setState(() => provider
                                                    .operator = newValue!),
                                          ),
                                        ),
                                      ),
                                    ),
                              AddAssetsAttributesWidget(
                                  data: provider.statAttributes),
                              Visibility(
                                visible: provider.dynaAttributes.isNotEmpty,
                                child: Column(
                                  children: [
                                    const Divider(thickness: 1),
                                    const SizedBox(height: 10),
                                    const Text(Constants.dynamicAttributes,
                                        textAlign: TextAlign.center,
                                        style: TextStyle(
                                            fontSize: 18,
                                            fontWeight: FontWeight.bold)),
                                    const SizedBox(height: 10),
                                    AddAssetsAttributesWidget(
                                        data: provider.dynaAttributes),
                                  ],
                                ),
                              ),
                              Selector<AddAssetProvider, List<SingleAsset>>(
                                selector: (context, p) => p.assetList,
                                builder: (context, assetList, child) {
                                  return Column(
                                    children: [
                                      if (assetList.isNotEmpty ||
                                          provider.isChildAllowedToAdd ==
                                              IsChildAllowedToAdd
                                                  .allowToAddChild.value)
                                        Column(
                                          children: [
                                            const SizedBox(height: 10),
                                            const Divider(thickness: 1),
                                            const SizedBox(height: 10),
                                          ],
                                        ),
                                      Stack(
                                        children: [
                                          if (provider.isChildAllowedToAdd ==
                                              IsChildAllowedToAdd
                                                  .allowToAddChild.value)
                                            Positioned(
                                              top: 0,
                                              right: 0,
                                              bottom: 0,
                                              child: ElevatedButton(
                                                  onPressed: () async {
                                                    final result =
                                                        await Navigator
                                                            .pushNamed(
                                                                context,
                                                                AddAssetScreen
                                                                    .routeName,
                                                                arguments: {
                                                          'addAssetScreenFrom':
                                                              AddAssetType
                                                                  .addChildFromAddAssetScreen,
                                                          'assetTypeId': provider
                                                              .assetType
                                                              ?.atAssetTypeId,
                                                          'category':
                                                              provider.category,
                                                          'parentAssetName':
                                                              provider
                                                                  .nameController
                                                                  .text,
                                                          'parentAssetTypeDesc':
                                                              provider.assetType
                                                                  ?.atAssetTypeName,
                                                          'parentSerialNumber':
                                                              provider
                                                                  .serialController
                                                                  .text,
                                                        });

                                                    if (result != null) {
                                                      provider.addChild(result
                                                          as SingleAsset);
                                                    }
                                                  },
                                                  child: const Text(
                                                      Strings.btnAdd)),
                                            ),
                                          if (assetList.isNotEmpty ||
                                              provider.isChildAllowedToAdd ==
                                                  IsChildAllowedToAdd
                                                      .allowToAddChild.value)
                                            Center(
                                              child: Container(
                                                padding: EdgeInsets.all(5),
                                                child: Text('Child Assets',
                                                    textAlign: TextAlign.center,
                                                    style: TextStyle(
                                                        fontSize: 18,
                                                        fontWeight:
                                                            FontWeight.w600)),
                                              ),
                                            ),
                                        ],
                                      ),
                                      Selector<AddAssetProvider,
                                          List<SingleAsset>>(
                                        selector: (context, p) => p.assetList,
                                        builder: (context, assetList, child) {
                                          return ListView.separated(
                                            shrinkWrap: true,
                                            separatorBuilder:
                                                (BuildContext context,
                                                    int index) {
                                              return Divider();
                                            },
                                            itemCount: assetList.length,
                                            physics:
                                                NeverScrollableScrollPhysics(),
                                            itemBuilder: (BuildContext context,
                                                int index) {
                                              var bean = assetList[index];
                                              return ListTile(
                                                subtitle: Text(
                                                    'Sl# ${assetList[index].taAssetManufactureSerialNo}'),
                                                leading: SizedBox(
                                                  width: 50.0,
                                                  height: 50.0,
                                                  child: ClipRRect(
                                                    borderRadius:
                                                        BorderRadius.circular(
                                                            10.0),
                                                    child: (bean.taAssetImage !=
                                                            null)
                                                        ? (bean.taAssetImage!)
                                                                    .startsWith(
                                                                        'http://') ||
                                                                (bean.taAssetImage!)
                                                                    .startsWith(
                                                                        'https://')
                                                            ? Image.network(
                                                                bean.taAssetImage!,
                                                                fit:
                                                                    BoxFit.fill,
                                                              )
                                                            : Image.file(
                                                                File(bean
                                                                    .taAssetImage!),
                                                                fit:
                                                                    BoxFit.fill,
                                                              )
                                                        : Image.asset(
                                                            'assets/images/no_image.png',
                                                            fit: BoxFit.cover,
                                                          ),
                                                  ),
                                                ),
                                                trailing: Row(
                                                  mainAxisSize:
                                                      MainAxisSize.min,
                                                  children: [
                                                    IconButton(
                                                      icon: Icon(Icons.edit),
                                                      onPressed: () async {
                                                        final result =
                                                            await Navigator
                                                                .pushNamed(
                                                                    context,
                                                                    AddAssetScreen
                                                                        .routeName,
                                                                    arguments: {
                                                              'addAssetScreenFrom':
                                                                  AddAssetType
                                                                      .addChildFromAddAssetScreen,
                                                              'assetTypeId':
                                                                  provider
                                                                      .assetType
                                                                      ?.atAssetTypeId,
                                                              'category':
                                                                  provider
                                                                      .category,
                                                              'parentAssetName':
                                                                  provider
                                                                      .nameController
                                                                      .text,
                                                              'parentAssetTypeDesc':
                                                                  provider
                                                                      .assetType
                                                                      ?.atAssetTypeName,
                                                              'parentSerialNumber':
                                                                  provider
                                                                      .serialController
                                                                      .text,
                                                              'editAssetModel':
                                                                  SingleAssetModel(
                                                                      data:
                                                                          bean),
                                                            });

                                                        if (result != null) {
                                                          provider.updateChild(
                                                              result
                                                                  as SingleAsset,
                                                              index);
                                                        }
                                                      },
                                                    ),
                                                    IconButton(
                                                      icon: Icon(Icons.cancel),
                                                      onPressed: () {
                                                        provider
                                                            .deleteAsset(bean);
                                                      },
                                                    ),
                                                  ],
                                                ),
                                                title: Text(provider
                                                    .assetList[index]
                                                    .assetType!),
                                              );
                                            },
                                          );
                                        },
                                      ),
                                      const SizedBox(height: 5),
                                      const Divider(thickness: 1),
                                    ],
                                  );
                                },
                              ),
                              const SizedBox(height: 15),
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Expanded(
                                    child: ElevatedButton(
                                        style: ElevatedButton.styleFrom(
                                          padding: EdgeInsets.symmetric(
                                              vertical: 12),
                                        ),
                                        onPressed: () async {
                                          PermissionManager
                                                  .hasCameraPermission()
                                              .then((value) {
                                            if (value) {
                                              CustomDialogBox.appDialog(
                                                  _context,
                                                  CustomDialog(
                                                    title: Strings
                                                        .dialogTitleMessage,
                                                    body: PopupBodySingleTextDialog(
                                                        desc:
                                                            'Have you attached the TAG to the Asset as per Defined Operating Procedure?'),
                                                    footer: Row(
                                                      mainAxisAlignment:
                                                          MainAxisAlignment
                                                              .center,
                                                      children: [
                                                        ElevatedButton(
                                                            onPressed: () {
                                                              Navigator.pop(
                                                                  _context);

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
                                                                  _context);
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
                                                              _context),
                                                  permission: [
                                                    Permission.camera
                                                  ]);
                                            }
                                          });
                                        },
                                        child: const Text(Strings.btnTag)),
                                  ),
                                  const SizedBox(width: 20),
                                  Expanded(
                                    child: ElevatedButton(
                                      style: ElevatedButton.styleFrom(
                                        padding:
                                            EdgeInsets.symmetric(vertical: 12),
                                      ),
                                      onPressed: (provider
                                                  .assetTagNumberController
                                                  .text
                                                  .isNotEmpty ==
                                              true)
                                          ? () async {
                                              FocusManager.instance.primaryFocus
                                                  ?.unfocus();

                                              bool isValidated =
                                                  await provider.isValidated();
                                              if (isValidated) {
                                                SingleAsset model = await provider
                                                    .getRequestModel(
                                                        locationId:
                                                            selectedSite!
                                                                .tlLocationId);

                                                if ((widget.addAssetScreenFrom ==
                                                        AddAssetType
                                                            .addChildFromViewScreen ||
                                                    widget.addAssetScreenFrom ==
                                                        AddAssetType
                                                            .addParentFromAssetListing)) {
                                                  provider
                                                      .addAsset(model)
                                                      .then((response) {
                                                    if (response.status ==
                                                        SUCCESS_RESPONSE_CODE) {
                                                      ToastMessage.showMessage(
                                                          response.message,
                                                          kToastSuccessColor);
                                                      Navigator.pop(
                                                          _context, true);
                                                    } else {
                                                      ToastMessage.showMessage(
                                                          response.message,
                                                          kToastErrorColor);
                                                    }
                                                  });
                                                } else {
                                                  Navigator.pop(context, model);
                                                }
                                              }
                                            }
                                          : null,
                                      child: (provider.isLoading)
                                          ? SizedBox(
                                              width: 18.0,
                                              height: 18.0,
                                              child: CircularProgressIndicator(
                                                color: Colors.white,
                                                strokeWidth: 2,
                                              ),
                                            )
                                          : Text('Submit'),
                                    ),
                                  ),
                                ],
                              ),
                              SizedBox(
                                height: 10,
                              ),
                              Container(
                                width: double.infinity,
                                child: OutlinedButton(
                                  style: OutlinedButton.styleFrom(
                                    padding: EdgeInsets.symmetric(vertical: 12),
                                    side: BorderSide(color: kPrimaryColor),
                                  ),
                                  child: Text(
                                    'Save as draft',
                                    style: TextStyle(
                                        color: kPrimaryColor,
                                        fontWeight: FontWeight.normal),
                                  ),
                                  onPressed: () async {
                                    bool result =
                                        await provider.addAssetToBox();
                                    if (result) {
                                      Navigator.of(
                                        context,
                                      ).pop(true);
                                    }
                                  },
                                ),
                              )
                            ],
                          )),
                    ],
                  ),
                ),
              ),
            ),
          );
        },
      ),
    );
  }
}

class AddAssetScreen extends StatefulWidget {
  static const String routeName = '/addChildAsset';

  const AddAssetScreen({
    Key? key,
    required this.assetTypeId,
    this.category,
    this.assetId,
    this.parentAssetName,
    this.parentAssetTypeDesc,
    this.parentSerialNumber,
    this.editAssetModel,
    required this.addAssetScreenFrom,
  }) : super(key: key);
  final int? assetTypeId, assetId;
  final String? category,
      parentAssetName,
      parentAssetTypeDesc,
      parentSerialNumber;
  final AddAssetType addAssetScreenFrom;
  final SingleAssetModel? editAssetModel;
  @override
  State<AddAssetScreen> createState() => _AddAssetScreenState();
}

class _AddAssetScreenState extends State<AddAssetScreen> {
  @override
  Widget build(BuildContext _context) {
    return ChangeNotifierProvider(
      create: (context) => AddAssetProvider(),
      child: AddAsset(
        assetTypeId: widget.assetTypeId,
        category: widget.category,
        parentAssetName: widget.parentAssetName,
        parentAssetTypeDesc: widget.parentAssetTypeDesc,
        parentSerialNumber: widget.parentSerialNumber,
        editAssetModel: widget.editAssetModel,
        addAssetScreenFrom: widget.addAssetScreenFrom,
        assetId: widget.assetId,
      ),
    );
  }
}
