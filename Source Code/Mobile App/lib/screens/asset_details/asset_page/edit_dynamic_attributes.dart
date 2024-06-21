import 'package:ats_system/core/utlis/permission_manager.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/screens/asset_details/widgets/attributes_widget.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/snack_bar.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:provider/provider.dart';

class EditDynamicAttributesWidget extends StatefulWidget {
  const EditDynamicAttributesWidget({Key? key, required this.assetId})
      : super(key: key);
  final int assetId;

  @override
  State<EditDynamicAttributesWidget> createState() =>
      _EditDynamicAttributesWidgetState();
}

class _EditDynamicAttributesWidgetState
    extends State<EditDynamicAttributesWidget> with WidgetsBindingObserver {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addObserver(this);
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<AssetDetailsProvider>().assetNameController =
          TextEditingController();
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
            AttributesWidget(
                data: provider.attributeList
                    .where((element) =>
                        element.attributeCatagory != 0 &&
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
                      final assetAttributes = provider.attributeList
                          .where((e) =>
                              e.attributeCatagory != 0 &&
                              e.display?.toUpperCase() == 'YES')
                          .toList();

                      var isValidated = await provider
                          .validateDynamicAttributes(assetAttributes);

                      if (isValidated) {
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
                            context.showSnackBar(pleaseAllowLocationPermission);
                          },
                        );
                      }
                    },
                    child: const Text(Strings.btnSubmit)),
                const SizedBox(width: 10),
                ElevatedButton(
                    onPressed: () => Navigator.of(context).pop(),
                    child: const Text(Strings.btnCancel)),
                const SizedBox(height: 10),
              ],
            ),
            const SizedBox(height: 10),
          ],
        );
      },
    );
  }
}
