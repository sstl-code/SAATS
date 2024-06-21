import 'package:ats_system/screens/asset_details/models/single_asset_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';

class AddAssetDraftWidget extends StatefulWidget {
  const AddAssetDraftWidget(
      {required this.draftList, required this.onTap, super.key});
  final List<SingleAsset> draftList;
  final Function(SingleAsset) onTap;

  @override
  State<AddAssetDraftWidget> createState() => _AddAssetDraftWidgetState();
}

class _AddAssetDraftWidgetState extends State<AddAssetDraftWidget> {
  @override
  Widget build(BuildContext context) {
    return ListView.builder(
        itemCount: widget.draftList.length,
        shrinkWrap: true,
        itemBuilder: (context, index) {
          SingleAsset bean = widget.draftList[index];
          String? title = 'N/A';
          if (bean.assetType == null && bean.taAssetName == null) {
            title = 'N/A';
          } else if (bean.assetType == null && bean.taAssetName != null) {
            title =
                (bean.taAssetName?.isEmpty == true) ? 'N/A' : bean.taAssetName;
          } else if (bean.assetType != null && bean.taAssetName == null) {
            title = (bean.assetType.toString().isEmpty == true)
                ? 'N/A'
                : bean.assetType.toString();
          } else {
            title = '${bean.assetType}-${bean.taAssetName}';
          }
          return Card(
            shadowColor: kPrimaryColor,
            color: Colors.white,
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(10.0),
            ),
            elevation: 0.5,
            child: GestureDetector(
              child: ListTile(
                onTap: () {
                  widget.onTap(bean);
                },
                leading: Container(
                  height: double.infinity,
                  child: SvgPicture.asset(
                    colorFilter: ColorFilter.mode(
                      kPrimaryColor, // Set the desired color
                      BlendMode.srcIn,
                    ),
                    'assets/images/draft_three_dots.svg',
                    height: 20,
                    width: 10,
                  ),
                ),
                title: Text(
                  title ?? 'N/A',
                  style: TextStyle(fontWeight: FontWeight.w400),
                ),
                subtitle: Text(
                  'Sl.No: #${bean.taAssetManufactureSerialNo ?? 'N/A'}',
                  overflow: TextOverflow.ellipsis,
                ),
                trailing: IconButton(
                  icon: Icon(Icons.delete_outline),
                  color: kPrimaryColor,
                  onPressed: () {
                    bean.delete();
                  },
                ),
              ),
            ),
          );
        });
  }
}
