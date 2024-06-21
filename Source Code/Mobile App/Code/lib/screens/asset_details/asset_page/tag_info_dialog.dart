import 'package:ats_system/utils/strings.dart';
import 'package:flutter/material.dart';

class TagInfoDialog extends StatelessWidget {
  const TagInfoDialog(
      {Key? key, required this.onPressedYes, required this.onPressedNo})
      : super(key: key);
  final VoidCallback onPressedYes;
  final VoidCallback onPressedNo;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(10.0),
      child: Column(crossAxisAlignment: CrossAxisAlignment.start, children: [
        const Text(
          'Have you attached the TAG to the Asset as per Defined Operating Procedure?',
          style: TextStyle(fontSize: 16),
        ),
        const SizedBox(height: 30),
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            ElevatedButton(
                onPressed: onPressedYes, child: const Text(Strings.btnYes)),
            const SizedBox(width: 10),
            ElevatedButton(
                onPressed: onPressedNo, child: const Text(Strings.btnNo)),
          ],
        )
      ]),
    );
  }
}
