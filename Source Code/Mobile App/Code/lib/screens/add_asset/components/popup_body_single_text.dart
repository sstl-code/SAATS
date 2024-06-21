import 'package:flutter/material.dart';

class PopupBodySingleTextDialog extends StatelessWidget {
  const PopupBodySingleTextDialog({Key? key, required this.desc})
      : super(key: key);

  final String desc;

  @override
  Widget build(BuildContext context) {
    return ListView(
        shrinkWrap: true,
        physics: BouncingScrollPhysics(),
        children: [
          Text(desc,
              style: TextStyle(fontSize: 16, fontWeight: FontWeight.normal)),
        ]);
  }
}
