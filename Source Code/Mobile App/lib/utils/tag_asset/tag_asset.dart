import 'dart:io';

import 'package:ats_system/main_provider.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:provider/provider.dart';

void scanQR({
  required BuildContext context,
  required Function(String) onQrScanned,
  required Function() onQRScanFailed,
  required Function(File) onImageCaptured,
  required Function() onImageCaputedFailed,
}) {
  context.read<MainProvider>().sessionTimeoutState(false);

  try {
    FlutterBarcodeScanner.scanBarcode(
            '#ff6666', Strings.btnCancel, true, ScanMode.QR)
        .then((value) {
      context.read<MainProvider>().sessionTimeoutState(true);

      CustomDialogBox.appDialog(
          context,
          CustomDialog(
            title: 'Asset Tagging',
            body: TagDialogWidget(
              qrCodeValue: value,
              onImageCaptured: (value) {
                onImageCaptured(value);
              },
              onImageCaputedFailed: () {
                onImageCaputedFailed();
              },
            ),
            footer: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                    onPressed: () async {
                      if (value != '-1') {
                        onQrScanned(value);
                      }
                      Navigator.pop(context);
                    },
                    child: const Text(Strings.btnOk)),
                const SizedBox(width: 10),
                ElevatedButton(
                    onPressed: () {
                      Navigator.pop(context);
                    },
                    child: const Text(Strings.btnCancel))
              ],
            ),
          ));
    });
  } on PlatformException {
    onQRScanFailed();
    onImageCaputedFailed();
    ToastMessage.showMessage('Failed to perform tagging.', kToastErrorColor);
  }
}

class TagDialogWidget extends StatefulWidget with WidgetsBindingObserver {
  const TagDialogWidget(
      {required this.qrCodeValue,
      required this.onImageCaptured,
      required this.onImageCaputedFailed,
      super.key});
  final void Function(File) onImageCaptured;
  final Function() onImageCaputedFailed;
  final String qrCodeValue;

  @override
  State<TagDialogWidget> createState() => _TagDialogWidgetState();
}

class _TagDialogWidgetState extends State<TagDialogWidget> {
  File? imageFile;
  @override
  Widget build(BuildContext context) {
    return ListView(
      shrinkWrap: true,
      physics: BouncingScrollPhysics(),
      children: [
        Row(children: [
          const Text(Constants.assetTagNo,
              style: TextStyle(fontWeight: FontWeight.bold)),
          const SizedBox(width: 10),
          Expanded(
            child: Container(
              color: Colors.grey.shade300,
              padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
              child:
                  Text((widget.qrCodeValue == '-1') ? '' : widget.qrCodeValue),
            ),
          ),
        ]),
        const SizedBox(height: 10),
        Row(
          children: [
            ElevatedButton(
                style: ElevatedButton.styleFrom(
                  padding: EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                ),
                onPressed: () async {
                  context.read<MainProvider>().sessionTimeoutState(false);
                  var imageFile = await CommonMethods.pickImage();

                  setState(() {
                    this.imageFile = imageFile;
                  });
                  if (imageFile != null) {
                    widget.onImageCaptured(imageFile);
                  } else {
                    widget.onImageCaputedFailed();
                  }
                  context.read<MainProvider>().sessionTimeoutState(true);
                },
                child: const Text('Add Image')),
            const SizedBox(width: 5),
            imageFile == null
                ? const Icon(Icons.image, size: 30)
                : Row(
                    children: [
                      Image.memory(imageFile!.readAsBytesSync(),
                          height: 40, width: 40, fit: BoxFit.cover),
                      const SizedBox(width: 5),
                      Container(
                          color: Colors.grey,
                          child: const Text(
                            'Image Captured',
                            style: TextStyle(fontSize: 13),
                          ))
                    ],
                  ),
          ],
        ),
        const SizedBox(height: 10),
        Selector<AssetDetailsProvider, bool>(
            builder: (context, value, child) =>
                value ? const ProgressBar() : Container(),
            selector: (context, provider) => provider.isAssetTagLoading),
      ],
    );
  }
}
