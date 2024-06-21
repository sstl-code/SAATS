import 'package:ats_system/main_provider.dart';
import 'package:ats_system/models/site_model.dart';
import 'package:ats_system/screens/asset_audit/audit_details/audit_child_details_page.dart';
import 'package:ats_system/screens/asset_audit/components/raise_ticket_dialog.dart';
import 'package:ats_system/screens/asset_audit/components/re_tag_asset_dialog.dart';
import 'package:ats_system/screens/asset_audit/data/asset_audit_provider.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/status_icon.dart';
import 'package:flutter/material.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import 'package:provider/provider.dart';

class ChildAssetAuditPage extends StatefulWidget {
  static const String routeName = '/childAssetAudit';

  const ChildAssetAuditPage(
      {Key? key, required this.auditData, required this.siteData})
      : super(key: key);
  final AssetDataModel auditData;
  final SiteData siteData;

  @override
  State<ChildAssetAuditPage> createState() => _ChildAssetAuditPageState();
}

class _ChildAssetAuditPageState extends State<ChildAssetAuditPage> {
  final ScrollController scrollController = ScrollController();

  void _scanQR(BuildContext context, AssetDataModel data) {
    context.read<MainProvider>().sessionTimeoutState(false);

    FlutterBarcodeScanner.scanBarcode(
            '#ff6666', Strings.btnCancel, true, ScanMode.QR)
        .then((value) async {
      context.read<MainProvider>().sessionTimeoutState(true);

      if (value == data.parentTag) {
        // context.read<AssetAuditProvider>().setAuditChildDetails(data);
        await Future.delayed(
            const Duration(milliseconds: 200),
            () => Navigator.pushNamed(context, AuditChildDetailsPage.routeName,
                    arguments: {
                      'assetId': data,
                      'fromParent': false,
                      'parentAssetId': widget.auditData.taAssetId
                    }).then((value) => setState(() {})));
      } else {
        ToastMessage.showMessage('Tag No does not match.', kToastErrorColor);
      }
    });
  }

  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () async {
        final provider = context.read<AssetAuditProvider>();
        // if (provider.isChildSubmitted) return true;
        bool isTagged = false;

        context
            .read<AssetAuditProvider>()
            .childSubmit(widget.auditData.taAssetId, context);
        int count =
            widget.auditData.childs.where((e) => e.isAudited == 'Y').length;
        if (count == widget.auditData.childs.length) {
          return false;
        } else if (count > 0) {
          return CustomDialogBox.pageDismissDialog(context);
        } else {
          return true;
        }
        // for (var l in  widget.auditData.childs) {
        //   if (l.isAudited == 'Y') {
        //     isTagged = true;
        //     break;
        //   }
        // }
        // if (isTagged) {
        //   return CustomDialogBox.pageDismissDialog(context);
        // } else {
        //   context.read<AssetAuditProvider>().childSubmit(widget.auditData.taAssetId, context);
        //   return false;
        // }
      },
      child: Scaffold(
        appBar: AppBar(
            centerTitle: false,
            title: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                Text('Child Assets of ${widget.auditData.assetName}'),
                Text(
                    '${widget.siteData.tlLocationCode} ${widget.siteData.tlLocationName}',
                    style: const TextStyle(fontSize: 12))
              ],
            )),
        body: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Scrollbar(
            controller: scrollController,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                SingleChildScrollView(
                  controller: scrollController,
                  child: ListView.separated(
                      physics: const NeverScrollableScrollPhysics(),
                      separatorBuilder: (context, index) => const Divider(),
                      shrinkWrap: true,
                      itemCount: widget.auditData.childs.length,
                      itemBuilder: (context, index) {
                        final data = widget.auditData.childs.elementAt(index);
                        return Padding(
                          padding: const EdgeInsets.symmetric(vertical: 5.0),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.stretch,
                            children: [
                              Row(
                                children: [
                                  StatusIcon(
                                      color: data.isAudited == 'Y'
                                          ? Colors.green
                                          : Colors.red,
                                      size: const Size(15, 15)),
                                  const SizedBox(width: 10.0),
                                  Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
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
                                padding: const EdgeInsets.only(left: 30.0),
                                child: SingleChildScrollView(
                                  scrollDirection: Axis.horizontal,
                                  child: Row(
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
                                        onPressed: () {
                                          CustomDialogBox.appDialog(
                                              context,
                                              CustomDialog(
                                                title:
                                                    Strings.dialogTitleMessage,
                                                body: RaiseTicketDialog(),
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
                                                                  'assetMissing',
                                                                  assetId: data
                                                                      .taAssetId,
                                                                  location: widget
                                                                      .siteData
                                                                      .tlLocationId)
                                                              .then((value) {
                                                            if (value
                                                                    .statusCode ==
                                                                SUCCESS_RESPONSE_CODE) {
                                                              context.read<AssetAuditProvider>().updateChildAuditList(
                                                                  'assetMissing',
                                                                  widget
                                                                      .auditData
                                                                      .taAssetId,
                                                                  assetId: data
                                                                      .taAssetId);
                                                              Navigator.of(
                                                                      context)
                                                                  .pop();
                                                            }
                                                            setState(() {});
                                                          });
                                                        },
                                                        child: const Text(
                                                            Strings.btnOk)),
                                                    const SizedBox(width: 10),
                                                    ElevatedButton(
                                                        onPressed: () {
                                                          Navigator.pop(
                                                              context);
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
                                                                  location: widget
                                                                      .siteData
                                                                      .tlLocationId)
                                                              .then((value) {
                                                            if (value
                                                                    .statusCode ==
                                                                SUCCESS_RESPONSE_CODE) {
                                                              context
                                                                  .read<
                                                                      AssetAuditProvider>()
                                                                  .updateChildAuditList(
                                                                      'tagMissing',
                                                                      widget
                                                                          .auditData
                                                                          .taAssetId,
                                                                      assetId: data
                                                                          .taAssetId);
                                                              Navigator.of(
                                                                      context)
                                                                  .pop();
                                                            }
                                                            setState(() {});
                                                          });
                                                        },
                                                        child: const Text(
                                                            Strings.btnOk)),
                                                    const SizedBox(width: 10),
                                                    ElevatedButton(
                                                        onPressed: () {
                                                          Navigator.pop(
                                                              context);
                                                        },
                                                        child: const Text(
                                                            Strings.btnCancel)),
                                                  ]),
                                            ),
                                          );
                                        },
                                        style: ElevatedButton.styleFrom(
                                            minimumSize: Size.zero,
                                            padding: const EdgeInsets.all(5.0)),
                                        child: const Text('Tag Missing'),
                                      ),
                                    ],
                                  ),
                                ),
                              ),
                            ],
                          ),
                        );
                      }),
                ),
                const SizedBox(height: 10),
                Align(
                  alignment: Alignment.center,
                  child: ElevatedButton(
                      onPressed: () => context
                          .read<AssetAuditProvider>()
                          .childSubmit(widget.auditData.taAssetId, context),
                      child: const Text(Strings.btnOk)),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
