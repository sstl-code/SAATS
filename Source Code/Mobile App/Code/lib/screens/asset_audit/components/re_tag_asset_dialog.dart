import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class ReTagAssetDialog extends StatelessWidget {
  const ReTagAssetDialog({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ListView(
        shrinkWrap: true,
        physics: BouncingScrollPhysics(),
        children: [
          Text(
            'TAG missing on the Asset. Hence a ticket will be raised.',
            style: TextStyle(fontSize: 16, fontWeight: FontWeight.normal),
          ),
          Selector<HomeProvider, bool>(
              selector: (c, p) => p.isMailLoading,
              builder: (c, v, ch) => v
                  ? Column(
                      children: [ProgressBar(), const SizedBox(height: 10)])
                  : Container()),
        ]);
  }
}
