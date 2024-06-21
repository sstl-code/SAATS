import 'package:ats_system/screens/asset_audit/audit_details/audit_details_page.dart';
import 'package:ats_system/screens/asset_audit/data/asset_audit_provider.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:dynamic_height_grid_view/dynamic_height_grid_view.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class AuditChildDetailsPage extends StatefulWidget {
  static const String routeName = '/auditChildDetails';
  const AuditChildDetailsPage(
      {Key? key,
      required this.assetDataModel,
      this.parentAssetId,
      this.isFromParent = false})
      : super(key: key);
  final AssetDataModel assetDataModel;
  final int? parentAssetId;
  final bool isFromParent;

  @override
  State<AuditChildDetailsPage> createState() => _AuditChildDetailsPageState();
}

class _AuditChildDetailsPageState extends State<AuditChildDetailsPage> {
  final ScrollController scrollController = ScrollController();

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context
          .read<AssetAuditProvider>()
          .initializeAssetDetails(widget.assetDataModel, false);
      print('widget.assetDataModel : ${widget.assetDataModel}');
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
          title: const Text('Details View for Audit'), centerTitle: false),
      body: Consumer<AssetAuditProvider>(builder: (context, provider, child) {
        final stat = provider.statChildList;
        return provider.isAssetDetailsLoading
            ? const ProgressBar()
            : Scrollbar(
                controller: scrollController,
                child: SingleChildScrollView(
                  controller: scrollController,
                  child: Column(
                    children: [
                      DynamicHeightGridView(
                          crossAxisCount: 2,
                          crossAxisSpacing: 5,
                          mainAxisSpacing: 10,
                          itemCount: stat.length,
                          shrinkWrap: true,
                          physics: const NeverScrollableScrollPhysics(),
                          builder: (context, index) {
                            final d = stat.elementAt(index);
                            return _InputText(
                                title: d.key,
                                value: stat.elementAt(index).value.toString());
                          }),
                      const SizedBox(height: 15),
                      const Text(Constants.dynamicAttributes,
                          textAlign: TextAlign.center,
                          style: TextStyle(
                              fontSize: 18, fontWeight: FontWeight.w600)),
                      const SizedBox(height: 15),
                      const DynamicList(isFromParent: false),
                      const SizedBox(height: 15),
                      const Text('Are these Asset Details matching?',
                          style: TextStyle(
                              fontSize: 16, fontWeight: FontWeight.bold)),
                      const SizedBox(height: 10),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          ElevatedButton(
                              onPressed: () {
                                FocusScope.of(context).unfocus();
                                final provider =
                                    context.read<AssetAuditProvider>();
                                provider.updateChildAuditList(
                                    'matched', widget.parentAssetId!,
                                    assetId: widget.assetDataModel.taAssetId);
                                Future.delayed(
                                    const Duration(milliseconds: 200),
                                    () => ToastMessage.showMessage(
                                        'Asset updated successfully',
                                        kToastSuccessColor));

                                Future.delayed(
                                    const Duration(milliseconds: 200),
                                    () => Navigator.pop(context));
                              },
                              child: const Text(Strings.btnYes)),
                          const SizedBox(width: 10),
                          ElevatedButton(
                              onPressed: () {
                                context
                                    .read<HomeProvider>()
                                    .sendMail('isAssetDetailsMatching',
                                        assetId:
                                            widget.assetDataModel.taAssetId)
                                    .then((value) {
                                  if (value.statusCode ==
                                      SUCCESS_RESPONSE_CODE) {
                                    provider.updateChildAuditList(
                                        'unmatched', widget.parentAssetId!,
                                        assetId:
                                            widget.assetDataModel.taAssetId);
                                    Navigator.of(context).pop();
                                  }
                                });
                              },
                              child: const Text(Strings.btnNo)),
                        ],
                      ),
                      const SizedBox(height: 15),
                    ],
                  ),
                ),
              );
      }),
    );
  }
}

class _InputText extends StatelessWidget {
  const _InputText({Key? key, required this.title, required this.value})
      : super(key: key);
  final String title;
  final String value;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.stretch,
        children: [
          Text(title,
              style:
                  const TextStyle(fontWeight: FontWeight.bold, fontSize: 16)),
          const SizedBox(height: 5),
          Container(
              color: Colors.white,
              padding: const EdgeInsets.all(5),
              child: Text(value)),
        ],
      ),
    );
  }
}
