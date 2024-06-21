import 'package:ats_system/main_provider.dart';
import 'package:ats_system/screens/asset_audit/audit_details/audit_details_page.dart';
import 'package:ats_system/screens/asset_audit/child_asset_audit/child_asset_audit_page.dart';
import 'package:ats_system/screens/asset_audit/components/raise_ticket_dialog.dart';
import 'package:ats_system/screens/asset_audit/components/re_tag_asset_dialog.dart';
import 'package:ats_system/screens/asset_audit/data/asset_audit_provider.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:ats_system/widgets/status_icon.dart';
import 'package:flutter/material.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:provider/provider.dart';

class AuditPassiveTab extends StatefulWidget {
  const AuditPassiveTab({Key? key}) : super(key: key);

  @override
  State<AuditPassiveTab> createState() => _AuditPassiveTabState();
}

class _AuditPassiveTabState extends State<AuditPassiveTab> {
  final ScrollController scrollController = ScrollController();

  void _scanQR(BuildContext context, AssetDataModel data) {
    context.read<MainProvider>().sessionTimeoutState(false);

    FlutterBarcodeScanner.scanBarcode(
            '#ff6666', Strings.btnCancel, true, ScanMode.QR)
        .then((value) async {
      context.read<MainProvider>().sessionTimeoutState(true);

      if (value == data.parentTag) {
        await Future.delayed(
            const Duration(milliseconds: 200),
            () => Navigator.pushNamed(context, AuditDetailsPage.routeName,
                arguments: {'assetId': data, 'fromParent': true}));
      } else {
        ToastMessage.showMessage('Tag No does not match.', kToastErrorColor);
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Consumer<AssetAuditProvider>(builder: (context, provider, child) {
      return provider.isLoading
          ? const ProgressBar()
          : SingleChildScrollView(
              controller: scrollController,
              child: ListView.separated(
                  physics: const NeverScrollableScrollPhysics(),
                  separatorBuilder: (context, index) => const Divider(),
                  shrinkWrap: true,
                  itemCount: provider.passiveList.length,
                  itemBuilder: (context, index) {
                    final data = provider.passiveList.elementAt(index);
                    return Padding(
                      padding: const EdgeInsets.all(5.0),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: [
                          Row(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Padding(
                                padding: const EdgeInsets.only(top: 1.0),
                                child: StatusIcon(
                                    size: const Size(15, 15),
                                    color: data.isAudited == 'Y'
                                        ? Colors.green
                                        : data.isAudited == 'O'
                                            ? Colors.orange
                                            : Colors.red),
                              ),
                              const SizedBox(width: 10.0),
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text(data.assetName ?? '',
                                      style: const TextStyle(
                                          fontWeight: FontWeight.bold)),
                                  const SizedBox(height: 5.0),
                                  Text(
                                      'SL# ${data.taAssetManufactureSerialNo ?? ''}, TAG# ${data.parentTag ?? ''}'),
                                ],
                              ),
                              const SizedBox(width: 10.0),
                            ],
                          ),
                          const SizedBox(height: 5.0),
                          Padding(
                            padding: const EdgeInsets.only(left: 25.0),
                            child: SingleChildScrollView(
                              scrollDirection: Axis.horizontal,
                              child: Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  ElevatedButton(
                                    onPressed: data.isAudited == 'Y'
                                        ? null
                                        : () => _scanQR(context, data),
                                    style: ElevatedButton.styleFrom(
                                        minimumSize: Size.zero,
                                        padding: const EdgeInsets.all(5.0)),
                                    child: const Text('Scan'),
                                  ),
                                  const SizedBox(width: 10),
                                  ElevatedButton(
                                    onPressed: () async {
                                      CustomDialogBox.appDialog(
                                          context,
                                          CustomDialog(
                                            title: Strings.dialogTitleMessage,
                                            body: RaiseTicketDialog(),
                                            footer: Row(
                                              mainAxisAlignment:
                                                  MainAxisAlignment.center,
                                              children: [
                                                ElevatedButton(
                                                    onPressed: () {
                                                      context
                                                          .read<HomeProvider>()
                                                          .sendMail(
                                                              'assetMissing',
                                                              assetId: data
                                                                  .taAssetId,
                                                              location: context
                                                                  .read<
                                                                      HomeProvider>()
                                                                  .selectedSite
                                                                  ?.tlLocationId)
                                                          .then((value) {
                                                        if (value.statusCode ==
                                                            SUCCESS_RESPONSE_CODE) {
                                                          provider.updateAuditList(
                                                              data.taAssetId,
                                                              'assetMissing');
                                                          Navigator.of(context)
                                                              .pop();
                                                        }
                                                      });
                                                    },
                                                    child: const Text(
                                                        Strings.btnOk)),
                                                const SizedBox(width: 10),
                                                ElevatedButton(
                                                    onPressed: () {
                                                      Navigator.pop(context);
                                                    },
                                                    child: const Text(
                                                        Strings.btnCancel)),
                                              ],
                                            ),
                                          ));
                                    },
                                    style: ElevatedButton.styleFrom(
                                        minimumSize: Size.zero,
                                        padding: const EdgeInsets.all(5.0)),
                                    child: const Text('Asset Missing'),
                                  ),
                                  const SizedBox(width: 10),
                                  ElevatedButton(
                                    onPressed: () {
                                      CustomDialogBox.appDialog(
                                          context,
                                          CustomDialog(
                                            title:
                                                'Raise ticket to Re-Tag Asset',
                                            body: ReTagAssetDialog(),
                                            footer: Row(
                                                mainAxisAlignment:
                                                    MainAxisAlignment.center,
                                                children: [
                                                  ElevatedButton(
                                                      onPressed: () {
                                                        context
                                                            .read<
                                                                HomeProvider>()
                                                            .sendMail(
                                                                'tagMissing',
                                                                assetId: data
                                                                    .taAssetId,
                                                                location: context
                                                                    .read<
                                                                        HomeProvider>()
                                                                    .selectedSite
                                                                    ?.tlLocationId)
                                                            .then((value) {
                                                          if (value
                                                                  .statusCode ==
                                                              SUCCESS_RESPONSE_CODE) {
                                                            provider.updateAuditList(
                                                                data.taAssetId,
                                                                'tagMissing');
                                                            Navigator.of(
                                                                    context)
                                                                .pop();
                                                          }
                                                        });
                                                      },
                                                      child: const Text(
                                                          Strings.btnOk)),
                                                  const SizedBox(width: 10),
                                                  ElevatedButton(
                                                      onPressed: () {
                                                        Navigator.pop(context);
                                                      },
                                                      child: const Text(
                                                          Strings.btnCancel)),
                                                ]),
                                          ));
                                    },
                                    style: ElevatedButton.styleFrom(
                                        minimumSize: Size.zero,
                                        padding: const EdgeInsets.all(5.0)),
                                    child: const Text('Tag Missing'),
                                  ),
                                  const SizedBox(width: 10),
                                  ElevatedButton(
                                    onPressed: data.childs.isNotEmpty
                                        ? () {
                                            Navigator.pushNamed(context,
                                                ChildAssetAuditPage.routeName,
                                                arguments: {
                                                  'auditData': data,
                                                  'siteData': context
                                                      .read<HomeProvider>()
                                                      .selectedSite
                                                }).then(
                                                (value) => setState(() {}));
                                          }
                                        : null,
                                    style: ElevatedButton.styleFrom(
                                        minimumSize: Size.zero,
                                        padding: const EdgeInsets.all(5.0)),
                                    child: const Text('Child'),
                                  ),
                                ],
                              ),
                            ),
                          ),
                        ],
                      ),
                    );
                  }),
            );
    });
  }
}
