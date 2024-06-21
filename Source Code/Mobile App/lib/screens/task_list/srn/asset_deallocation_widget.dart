import 'package:ats_system/screens/task_list/data/task_provider.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class AssetDeallocationWidget extends StatelessWidget {
  const AssetDeallocationWidget({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ListView(
        shrinkWrap: true,
        physics: BouncingScrollPhysics(),
        children: [
          const Text(
            'Are you sure this Asset has to be deallocated from this site?',
            style: TextStyle(
              fontSize: 16,
            ),
          ),
          Selector<TaskProvider, bool>(
              builder: (context, value, child) =>
                  value ? const ProgressBar() : Container(),
              selector: (context, provider) => provider.isLoading),
        ]);
  }
}
