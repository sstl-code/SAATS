import 'dart:io';

import 'package:ats_system/core/widgets/dialog_header.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';

class CustomDialogBox {
  static void appDialog(BuildContext context, Widget dialogWidget,
      {bool barrierDismissible = false}) {
    showDialog(
      context: context,
      barrierDismissible: barrierDismissible,
      builder: (BuildContext context) => dialogWidget,
    );
  }

  static Future<bool> appClose(BuildContext context) async => await showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(10.0)),
            title: const Text('Are you sure?'),
            content: const Text('Do you want to exit an app?'),
            actions: <Widget>[
              TextButton(
                  onPressed: () => Navigator.of(context).pop(false),
                  child: const Text(Strings.btnNo)),
              TextButton(
                  onPressed: () => exit(0), child: const Text(Strings.btnYes)),
            ],
          );
        },
      );

  static Future<bool> pageDismissDialog(BuildContext context) async =>
      await showDialog(
        context: context,
        barrierDismissible: false,
        builder: (BuildContext context) {
          return CustomDialog(
            title: Strings.dialogTitleMessage,
            body: AddAssetMessageDialog(),
            footer: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                    onPressed: () {
                      Navigator.of(
                        context,
                      ).pop(true);
                    },
                    child: const Text('Yes')),
                const SizedBox(width: 10),
                ElevatedButton(
                    onPressed: () {
                      Navigator.of(context).pop(false);
                    },
                    child: const Text('No')),
              ],
            ),
          );
        },
      );

  static showPermissionDialog(BuildContext context) {
    Widget cancelButton = TextButton(
        child: const Text(Strings.btnCancel),
        onPressed: () => Navigator.pop(context));
    //Widget noButton = TextButton(child: const Text("Close App"), onPressed: () => exit(0));
    Widget yesButton = TextButton(
        child: const Text("App Settings"), onPressed: () => openAppSettings());
    showDialog(
        context: context,
        builder: (_) => AlertDialog(
              title: const Text("Permission Needed"),
              content: const Text(
                  'This app needs your permission, to allow the permission go to app settings.'),
              actions: [cancelButton, yesButton],
            ));
  }
}

class CustomDialog extends StatelessWidget {
  const CustomDialog(
      {Key? key,
      required this.title,
      required this.body,
      required this.footer,
      this.bodyPadding = 16,
      this.setStandardPadding = true})
      : super(key: key);
  final String title;
  final bool setStandardPadding;
  final double bodyPadding;
  final Widget body;
  final Widget footer;
  @override
  Widget build(BuildContext context) {
    return Dialog(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(16.0),
      ),
      child: Material(
        type: MaterialType.transparency,
        child: Ink(
          decoration: BoxDecoration(
            color: scaffoldBackgroundColor,
            borderRadius: BorderRadius.circular(12.0),
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              DialogHeaderWidget(title: title),
              Flexible(
                child: (setStandardPadding)
                    ? Padding(
                        padding: EdgeInsets.all(bodyPadding),
                        child: body,
                      )
                    : body,
              ),
              if (footer.runtimeType != SizedBox)
                Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: footer,
                )
            ],
          ),
        ),
      ),
    );
  }
}

class AddAssetMessageDialog extends StatelessWidget {
  const AddAssetMessageDialog({Key? key}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return ListView(
        shrinkWrap: true,
        physics: BouncingScrollPhysics(),
        children: [
          const Text(
            'Entered or modified data will be discarded.',
            style: TextStyle(fontSize: 16),
          ),
          const SizedBox(height: 20),
          const Text('Are you sure you want to close the screen?',
              style: TextStyle(fontSize: 16)),
        ]);
  }
}
