import 'package:ats_system/proxy/data/proxy_settings_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/input_text_widget.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class ProxySettingsWidget extends StatefulWidget {
  const ProxySettingsWidget({Key? key}) : super(key: key);

  @override
  State<ProxySettingsWidget> createState() => _ProxySettingsWidgetState();
}

class _ProxySettingsWidgetState extends State<ProxySettingsWidget> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<ProxySettingsProvider>().setProxyFromSessionManager();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<ProxySettingsProvider>(
      builder: (context, provider, state) {
        return ListView(
          shrinkWrap: true,
          physics: BouncingScrollPhysics(),
          children: [
            InputText(
                title: 'IP Address',
                controller: provider.ipAddress,
                inputType: TextInputType.numberWithOptions(decimal: true),
                onChanged: (_) {},
                error: null),
            InputText(
                title: 'Port',
                controller: provider.port,
                inputType: TextInputType.number,
                onChanged: (_) {},
                error: null),
            const SizedBox(height: 10),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                    onPressed: () async {
                      FocusScope.of(context).unfocus();
                      if (provider.ipAddress.text.trim().isEmpty) {
                        ToastMessage.showMessage(
                            'IP Address cannot be empty', kToastErrorColor);
                      } else if (provider.port.text.trim().isEmpty) {
                        ToastMessage.showMessage(
                            'Port cannot be empty', kToastErrorColor);
                      } else {
                        provider
                            .setProxySettings()
                            .then((value) => Navigator.pop(context));
                      }
                      // if (provider.assetNameController.text.trim().isEmpty) {
                      //   ToastMessage.showMessage(
                      //       'Asset name cannot be empty.', kToastErrorColor);
                      // } else {
                      //   final assetAttributes = provider.attributeList
                      //       .where((e) =>
                      //           e.attributeCatagory == 0 &&
                      //           e.display?.toUpperCase() == 'YES')
                      //       .toList();
                      //   var isValidated = await provider
                      //       .validateDynamicAttributes(assetAttributes);

                      //   if (isValidated == true) {
                      //     var model = await provider
                      //         .getUpdateDynamicAttributesModel(assetAttributes);

                      //     checkPermission(
                      //       permission: Permission.location,
                      //       onPermissionDeniedPermenanty: () {
                      //         showPermissionRequiredDialog(
                      //             context, locationPermissionMessage);
                      //       },
                      //       onPermissionGranted: () {
                      //         provider.editAsset(model).then((value) {
                      //           ToastMessage.showMessage(
                      //               value.message,
                      //               value.status == SUCCESS_RESPONSE_CODE
                      //                   ? kToastSuccessColor
                      //                   : kToastErrorColor);
                      //           if (value.status == SUCCESS_RESPONSE_CODE) {
                      //             Navigator.pop(context);
                      //           }
                      //         }).whenComplete(() {
                      //           setState(() {
                      //             provider.setAssetUpdating(false);
                      //           });
                      //         });
                      //       },
                      //       onPermissionDenied: () {
                      //         context
                      //             .showSnackBar(pleaseAllowLocationPermission);
                      //       },
                      //     );
                      //   }
                      // }
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
