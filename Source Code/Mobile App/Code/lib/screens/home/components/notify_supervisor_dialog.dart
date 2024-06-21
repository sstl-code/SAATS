import 'package:ats_system/screens/asset_details/asset_list_page.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class NotifySupervisorDialog extends StatelessWidget {
  const NotifySupervisorDialog({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Dialog(
        elevation: 0,
        backgroundColor: Theme.of(context).dialogBackgroundColor,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(0.0)),
        child: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              const SizedBox(height: 30),
              const Text(
                  'You tried to access the details of a Site not assigned you.',
                  textAlign: TextAlign.center,
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
              const SizedBox(height: 10),
              const Divider(),
              const SizedBox(height: 10),
              const Text('Your Supervisor will be notified.',
                  textAlign: TextAlign.center,
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold)),
              const SizedBox(height: 40),
              Selector<HomeProvider, bool>(
                builder: (context, value, child) =>
                    value ? ProgressBar() : Container(),
                selector: (context, provider) => provider.isMailLoading,
              ),
              const SizedBox(width: 10),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  ElevatedButton(
                    onPressed: () {
                      context
                          .read<HomeProvider>()
                          .sendMail('unassignedSite',
                              location: context
                                  .read<HomeProvider>()
                                  .selectedSite
                                  ?.tlLocationId)
                          .then((value) {
                        Navigator.pop(context);
                        Navigator.of(context)
                            .pushNamed(AssetListPage.routeName);
                      });
                    },
                    child: const Text(Strings.btnSubmit),
                  ),
                  const SizedBox(width: 10),
                  ElevatedButton(
                    onPressed: () => Navigator.pop(context),
                    child: const Text(Strings.btnCancel),
                  ),
                ],
              ),
              const SizedBox(height: 10),
            ],
          ),
        ));
  }
}
