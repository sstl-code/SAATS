import 'package:ats_system/utils/strings.dart';
import 'package:flutter/material.dart';

class STNConfirmationDialog extends StatelessWidget {
  const STNConfirmationDialog(
      {Key? key, required this.onPressedYes, required this.onPressedNo})
      : super(key: key);
  final VoidCallback onPressedYes;
  final VoidCallback onPressedNo;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(35.0),
      child: Column(crossAxisAlignment: CrossAxisAlignment.center, children: [
        const Text('Is this asset Tagged ?', style: TextStyle(fontSize: 16)),
        const SizedBox(height: 30),
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Align(
              alignment: Alignment.center,
              child: ElevatedButton(
                  onPressed: onPressedYes, child: const Text(Strings.btnYes)),
            ),
            const SizedBox(width: 10),
            Align(
              alignment: Alignment.center,
              child: ElevatedButton(
                  onPressed: onPressedNo, child: const Text(Strings.btnNo)),
            ),
          ],
        )
      ]),
    );
  }
}
