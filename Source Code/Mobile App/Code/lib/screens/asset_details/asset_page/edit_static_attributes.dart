import 'package:ats_system/core/utlis/permission_manager.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/screens/asset_details/widgets/attributes_widget.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/snack_bar.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/input_dropdown_widget.dart';
import 'package:ats_system/widgets/input_text_widget.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:provider/provider.dart';

class EditStaticAttributesWidget extends StatefulWidget {
  const EditStaticAttributesWidget({Key? key, required this.assetId})
      : super(key: key);
  final int assetId;

  @override
  State<EditStaticAttributesWidget> createState() =>
      _EditStaticAttributesWidgetState();
}

class _EditStaticAttributesWidgetState extends State<EditStaticAttributesWidget>
    with WidgetsBindingObserver {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<AssetDetailsProvider>().setAssetName();
    });
  }

  @override
  void dispose() {
    WidgetsBinding.instance.removeObserver(this);
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<AssetDetailsProvider>(
      builder: (context, provider, state) {
        return ListView(
          shrinkWrap: true,
          physics: BouncingScrollPhysics(),
          children: [
            Row(mainAxisAlignment: MainAxisAlignment.spaceBetween, children: [
              Expanded(
                child: InputText(
                    title: 'Asset Name',
                    controller: provider.assetNameController,
                    onChanged: (_) {},
                    error: null),
              ),
              (provider.singleAssetModel?.data?.taAssetCatagory
                          ?.toUpperCase() ==
                      'ACTIVE')
                  ? Expanded(
                      child: (provider.operatorList.isEmpty)
                          ? SizedBox()
                          : InputDropdown(
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
                                  onChanged: (Operator? newValue) => setState(
                                      () => provider.operator = newValue!),
                                ),
                              ),
                            ),
                    )
                  : SizedBox()
            ]),
            const SizedBox(height: 10),
            AttributesWidget(
                data: provider.attributeList
                    .where((element) =>
                        element.attributeCatagory == 0 &&
                        element.display?.toUpperCase() == "YES")
                    .toList()),
            const SizedBox(height: 10),
            (provider.isAssetUpdating)
                ? Column(
                    children: [
                      ProgressBar(),
                      const SizedBox(height: 10),
                    ],
                  )
                : Container(),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                    onPressed: () async {
                      FocusScope.of(context).unfocus();
                      if (provider.assetNameController.text.trim().isEmpty) {
                        ToastMessage.showMessage(
                            'Asset name cannot be empty.', kToastErrorColor);
                      } else {
                        final assetAttributes = provider.attributeList
                            .where((e) =>
                                e.attributeCatagory == 0 &&
                                e.display?.toUpperCase() == 'YES')
                            .toList();
                        var isValidated = await provider
                            .validateDynamicAttributes(assetAttributes);

                        if (isValidated == true) {
                          var model = await provider
                              .getUpdateDynamicAttributesModel(assetAttributes);

                          checkPermission(
                            permission: Permission.location,
                            onPermissionDeniedPermenanty: () {
                              showPermissionRequiredDialog(
                                  context, locationPermissionMessage);
                            },
                            onPermissionGranted: () {
                              provider.editAsset(model).then((value) {
                                ToastMessage.showMessage(
                                    value.message,
                                    value.status == SUCCESS_RESPONSE_CODE
                                        ? kToastSuccessColor
                                        : kToastErrorColor);
                                if (value.status == SUCCESS_RESPONSE_CODE) {
                                  Navigator.pop(context);
                                }
                              }).whenComplete(() {
                                setState(() {
                                  provider.setAssetUpdating(false);
                                });
                              });
                            },
                            onPermissionDenied: () {
                              context
                                  .showSnackBar(pleaseAllowLocationPermission);
                            },
                          );
                        }
                      }
                    },
                    child: const Text(Strings.btnSubmit)),
                const SizedBox(width: 10),
                ElevatedButton(
                    onPressed: () => Navigator.of(context).pop(),
                    child: const Text('Cancel')),
                const SizedBox(height: 10),
              ],
            ),
          ],
        );
      },
    );
  }
}
