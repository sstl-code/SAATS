import 'package:ats_system/screens/add_asset/data/add_asset_provider.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class DetailsConfirmDialog extends StatelessWidget {
  const DetailsConfirmDialog(
      {Key? key, required this.onPressedYes, required this.onPressedNo})
      : super(key: key);
  final VoidCallback onPressedYes;
  final VoidCallback onPressedNo;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(35.0),
      child: Column(crossAxisAlignment: CrossAxisAlignment.center, children: [
        const Text(Strings.areAssetCorrect,
            style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold)),
        const SizedBox(height: 30),
        Selector<AddAssetProvider, bool>(
          selector: (context, p) => p.isLoading,
          builder: (context, isLoading, child) =>
              isLoading ? const ProgressBar() : Container(),
        ),
        const SizedBox(height: 20),
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
