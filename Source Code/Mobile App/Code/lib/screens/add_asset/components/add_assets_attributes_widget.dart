import 'package:ats_system/screens/add_asset/data/add_asset_provider.dart';
import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/widgets/input_dropdown_widget.dart';
import 'package:ats_system/widgets/input_text_widget.dart';
import 'package:dynamic_height_grid_view/dynamic_height_grid_view.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class AddAssetsAttributesWidget extends StatelessWidget {
  const AddAssetsAttributesWidget({Key? key, required this.data})
      : super(key: key);
  final List<AssetAttribute> data;

  @override
  Widget build(BuildContext context) {
    if (data.isEmpty) return Container();

    return Consumer<AddAssetProvider>(builder: (context, provider, child) {
      return MediaQuery.removePadding(
        context: context,
        removeTop: true,
        child: DynamicHeightGridView(
          itemCount: data.length,
          crossAxisCount: 2,
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          builder: (_, index) {
            final v = data.elementAt(index);
            // print('Length of data is ${v}');
            // if (v.display?.toUpperCase() == 'YES') {
            //   return Text(
            //     'v.attributeName.trim()',
            //   );
            // } else {
            //   return Text(
            //     'dwdwq v.attributeName.trim()',
            //   );
            // }
            if (v.attributeDatatype == 'FLoV') {
              final list = v.ataFlovWithDefaultValue
                  .split(',')
                  .map((e) => e.trim())
                  .toList();
              if (list.isEmpty)
                return Container(
                  color: Colors.amber,
                );
              return Visibility(
                visible: v.display?.toUpperCase() == 'YES',
                child: InputDropdown(
                  title: v.attributeName,
                  isMandate: v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                  child: Container(
                    color: Colors.white,
                    padding: const EdgeInsets.all(3),
                    child: DropdownButton<String>(
                      padding: EdgeInsets.zero,
                      isDense: true,
                      underline: const SizedBox(),
                      isExpanded: true,
                      key: ValueKey(v.attributeName),
                      items: list
                          .map((e) => DropdownMenuItem<String>(
                              value: e, child: Text(e.toString())))
                          .toList(),
                      onChanged: (value) =>
                          provider.setFlovValue(v.attributeName, value!),
                      value: (list.contains(
                              provider.flovValueList[v.attributeName]))
                          ? provider.flovValueList[v.attributeName]
                          : null,
                    ),
                  ),
                ),
              );
            } else if (v.attributeDatatype == 'Alphanumeric') {
              return Visibility(
                visible: v.display?.toUpperCase() == 'YES',
                child: InputText(
                  title: v.attributeName.trim(),
                  controller: provider.controllers[v.attributeName.trim()]!,
                  onChanged: (_) {},
                  isMandate: v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                  maxLines: 1,
                  error: null,
                ),
              );
            } else if (v.attributeDatatype == 'Numeric') {
              return Visibility(
                visible: v.display?.toUpperCase() == 'YES',
                child: InputText(
                  title: v.attributeName,
                  controller: provider.controllers[v.attributeName]!,
                  onChanged: (_) {},
                  isMandate: v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                  maxLines: 1,
                  inputType: TextInputType.number,
                  error: null,
                ),
              );
            } else if (v.attributeDatatype == 'Free-flow') {
              return Visibility(
                visible: v.display?.toUpperCase() == 'YES',
                child: InputText(
                  title: v.attributeName,
                  isMandate: v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                  controller: provider.controllers[v.attributeName]!,
                  onChanged: (_) {},
                  error: null,
                ),
              );
            } else if (v.attributeDatatype == 'Date') {
              return Visibility(
                visible: v.display?.toUpperCase() == 'YES',
                child: InputText(
                  title: v.attributeName,
                  controller: provider.controllers[v.attributeName]!,
                  onChanged: (_) {},
                  isMandate: v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                  readOnly: true,
                  onTap: () => provider.selectDate(
                      context, provider.controllers[v.attributeName]!),
                  error: null,
                ),
              );
            }
            return Container(
              color: Colors.amber,
            );
          },
        ),
      );
    });
  }
}
