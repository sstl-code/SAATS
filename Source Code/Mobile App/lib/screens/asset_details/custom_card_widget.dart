import 'package:ats_system/screens/asset_details/asset_page/asset_page.dart';
import 'package:ats_system/screens/asset_details/models/asset_details_model.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:flutter/material.dart';
import 'package:scrollable_positioned_list/scrollable_positioned_list.dart';

class CustomCardWidget extends StatefulWidget {
  const CustomCardWidget(
      {Key? key,
      required this.map,
      required this.index,
      required this.itemScrollController})
      : super(key: key);
  final Map<String, List<AssetDataModel>> map;
  final int index;
  final ItemScrollController itemScrollController;

  @override
  State<CustomCardWidget> createState() => _CustomCardWidgetState();
}

class _CustomCardWidgetState extends State<CustomCardWidget>
    with SingleTickerProviderStateMixin {
  late AnimationController _controller;
  bool _isRotated = false;
  Color color = Colors.red;

  //String name = '';
  List<AssetDataModel> values = [];

  String _image(String assetName) {
    switch (assetName) {
      case 'AIR CONDITIONER':
        return 'assets/images/icon_ac.png';
      case 'Air Conditioner':
        return 'assets/images/icon_ac.png';
      case 'BATTERY':
        return 'assets/images/icon_battery.png';
      case 'Battery':
        return 'assets/images/icon_battery.png';
      case 'SOLAR PANEL':
        return 'assets/images/icon_server.png';
      case 'Solar Panel':
        return 'assets/images/icon_server.png';
      case 'TOWER':
        return 'assets/images/icon_ac.png';
      case 'Tower':
        return 'assets/images/icon_ac.png';
      default:
        return 'assets/images/icon_machine.png';
    }
  }

  void _setColor(List<AssetDataModel> values) {
    int count = 0;
    int total = values.length;
    for (var v in values) {
      if (v.parentTag != null) count++;
    }
    double percent = (count * 100) / total;
    if (percent == 100) {
      color = Colors.green;
    } else if (percent < 100 && percent > 50) {
      color = Colors.orange;
    } else {
      color = Colors.red;
    }
  }

  @override
  void initState() {
    _controller = AnimationController(
        vsync: this,
        duration: const Duration(milliseconds: 300),
        upperBound: 0.5);
    super.initState();
    values = widget.map.values.elementAt(widget.index);
    _setColor(values);
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final height = MediaQuery.of(context).size.height;
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: Stack(
        children: [
          /// Expanded card
          AnimatedOpacity(
            duration: const Duration(milliseconds: 500),
            opacity: _isRotated ? 1 : 0,
            child: Visibility(
                visible: _isRotated,
                child: Container(
                  padding: const EdgeInsets.all(8.0),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(15),
                    color: Colors.blue.shade100,
                    boxShadow: const [
                      BoxShadow(
                          color: Colors.grey,
                          spreadRadius: 2,
                          blurRadius: 5.0,
                          offset: Offset(2, 2))
                    ],
                  ),
                  child: Column(
                    children: [
                      SizedBox(height: height * 0.075),
                      ListView.separated(
                          shrinkWrap: true,
                          physics: const NeverScrollableScrollPhysics(),
                          separatorBuilder: (context, index) =>
                              const Divider(color: Colors.white),
                          itemCount: values.length,
                          itemBuilder: (context, index) {
                            final value = values.elementAt(index);
                            return Stack(
                              children: [
                                Visibility(
                                  visible: value.childs.isNotEmpty,
                                  child: Positioned(
                                      top: 5,
                                      right: 5,
                                      child: CircleAvatar(
                                          backgroundColor: Colors.black,
                                          maxRadius: 18,
                                          child: Image.asset(
                                              'assets/images/icon_group.png'))),
                                ),
                                Container(
                                  alignment: Alignment.center,
                                  padding: const EdgeInsets.all(5.0),
                                  child: Column(children: [
                                    Text.rich(TextSpan(
                                        text: '${Constants.serialNo} : ',
                                        style: const TextStyle(
                                            fontWeight: FontWeight.w600),
                                        children: [
                                          TextSpan(
                                            text: value
                                                .taAssetManufactureSerialNo,
                                            style: const TextStyle(
                                                fontWeight: FontWeight.normal),
                                          )
                                        ])),
                                    Text.rich(TextSpan(
                                        text: '${Constants.assetTagNo} : ',
                                        style: const TextStyle(
                                            fontWeight: FontWeight.w600),
                                        children: [
                                          TextSpan(
                                              text: value.parentTag ?? '-',
                                              style: const TextStyle(
                                                  fontWeight:
                                                      FontWeight.normal))
                                        ])),
                                    if (value.category?.toUpperCase() ==
                                        'ACTIVE')
                                      Text.rich(TextSpan(
                                          text: 'Operator : ',
                                          style: const TextStyle(
                                              fontWeight: FontWeight.w600),
                                          children: [
                                            TextSpan(
                                                text: value.operators ?? '',
                                                style: const TextStyle(
                                                    fontWeight:
                                                        FontWeight.normal))
                                          ])),
                                    ElevatedButton(
                                        onPressed: () {
                                          Navigator.pushNamed(
                                              context, AssetPage.routeName,
                                              arguments: {
                                                'assetId': value.taAssetId,
                                                'assetTypeMasterId':
                                                    value.masterId,
                                                'assetName': value.assetName,
                                                'assetTypeName':
                                                    value.assetTypeName,
                                              });
                                        },
                                        child: const Text(Strings.viewDetails)),
                                  ]),
                                ),
                              ],
                            );
                          }),
                    ],
                  ),
                )),
          ),

          /// Top part
          Container(
            padding: const EdgeInsets.all(15.0),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(15),
              color: const Color(0xff3D4EB4),
              boxShadow: const [
                BoxShadow(
                    color: Colors.grey,
                    spreadRadius: 2,
                    blurRadius: 5.0,
                    offset: Offset(2, 2))
              ],
            ),
            child: GestureDetector(
              onTap: () {
                setState(() {
                  widget.itemScrollController.scrollTo(
                      index: widget.index,
                      duration: const Duration(milliseconds: 200));
                  if (_isRotated) {
                    _controller.reverse(from: 0.5);
                  } else {
                    _controller.forward(from: 0.0);
                  }
                  _isRotated = !_isRotated;
                });
              },
              child: Row(
                children: [
                  /// Color Status
                  Container(
                      decoration:
                          BoxDecoration(shape: BoxShape.circle, color: color),
                      width: 20,
                      height: 20),
                  Expanded(
                      flex: 1,
                      child: Image.asset(
                          _image(widget.map.keys.elementAt(widget.index)),
                          height: 25,
                          width: 25,
                          color: Colors.white)),
                  Expanded(
                      flex: 2,
                      child: Text(widget.map.keys.elementAt(widget.index),
                          style: const TextStyle(color: Colors.white))),
                  Expanded(
                      flex: 1,
                      child: Text(
                          '${widget.map.values.elementAt(widget.index).length}',
                          style: const TextStyle(color: Colors.white),
                          textAlign: TextAlign.center)),
                  RotationTransition(
                      turns: Tween(begin: 0.0, end: 1.0).animate(_controller),
                      child: const Icon(Icons.arrow_drop_down_sharp,
                          color: Colors.white)),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
