import 'package:ats_system/screens/add_asset/models/attribute_model.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/widgets/input_dropdown_widget.dart';
import 'package:ats_system/widgets/input_text_widget.dart';
import 'package:dynamic_height_grid_view/dynamic_height_grid_view.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class AttributesWidget extends StatefulWidget {
  const AttributesWidget({Key? key, required this.data}) : super(key: key);
  final List<AssetAttribute> data;

  @override
  State<AttributesWidget> createState() => _AttributesWidgetState();
}

class _AttributesWidgetState extends State<AttributesWidget> {
  @override
  Widget build(BuildContext context) {
    if (widget.data.isEmpty) return Container();

    return Consumer<AssetDetailsProvider>(
      builder: (context, provider, state) {
        return MediaQuery.removePadding(
          context: context,
          removeTop: true,
          child: DynamicHeightGridView(
            itemCount: widget.data.length,
            crossAxisCount: 2,
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            builder: (_, index) {
              final v = widget.data.elementAt(index);
              if (v.attributeDatatype == 'FLoV') {
                final list = v.ataFlovWithDefaultValue
                    .split(',')
                    .map((e) => e.trim())
                    .toList();

                if (list.isEmpty) return Container();
                return Visibility(
                  visible: v.display?.toUpperCase() == 'YES',
                  child: InputDropdown(
                    title: v.attributeName,
                    isMandate:
                        v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
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
                        onChanged:
                            v.editableNonEditableFlag?.toUpperCase() == 'NO'
                                ? null
                                : (value) {
                                    setState(() {
                                      provider.setFlovValue(
                                          v.attributeName, value!);
                                    });
                                  },
                        value: list.contains(
                                provider.flovValueList[v.attributeName])
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
                    controller:
                        provider.statControllers[v.attributeName.trim()]!,
                    onChanged: (_) {},
                    isMandate:
                        v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                    enabled: v.editableNonEditableFlag?.toUpperCase() == 'YES',
                    readOnly: v.editableNonEditableFlag?.toUpperCase() != 'YES',
                    maxLines: 1,
                    error: null,
                  ),
                );
              } else if (v.attributeDatatype == 'Numeric') {
                return Visibility(
                  visible: v.display?.toUpperCase() == 'YES',
                  child: InputText(
                    title: v.attributeName,
                    controller: provider.statControllers[v.attributeName]!,
                    onChanged: (_) {},
                    isMandate:
                        v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                    maxLines: 1,
                    enabled: v.editableNonEditableFlag?.toUpperCase() == 'YES',
                    inputType: TextInputType.number,
                    error: null,
                  ),
                );
              } else if (v.attributeDatatype == 'Free-flow') {
                return Visibility(
                  visible: v.display?.toUpperCase() == 'YES',
                  child: InputText(
                    title: v.attributeName,
                    enabled: v.editableNonEditableFlag?.toUpperCase() == 'YES',
                    isMandate:
                        v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                    controller: provider.statControllers[v.attributeName]!,
                    readOnly: v.editableNonEditableFlag?.toUpperCase() != 'YES',
                    onChanged: (_) {},
                    error: null,
                  ),
                );
              } else if (v.attributeDatatype == 'Date') {
                return Visibility(
                  visible: v.display?.toUpperCase() == 'YES',
                  child: InputText(
                    title: v.attributeName,
                    enabled: v.editableNonEditableFlag?.toUpperCase() == 'YES',
                    controller: provider.statControllers[v.attributeName]!,
                    onChanged: (_) {},
                    isMandate:
                        v.requieredNotRequiredFlag?.toUpperCase() == 'YES',
                    readOnly: true,
                    onTap: v.editableNonEditableFlag?.toUpperCase() == 'NO'
                        ? null
                        : () => provider.selectDate(context,
                            provider.statControllers[v.attributeName]!),
                    error: null,
                  ),
                );
              }
              return Container();
            },
          ),
        );
      },
    );
  }
}
