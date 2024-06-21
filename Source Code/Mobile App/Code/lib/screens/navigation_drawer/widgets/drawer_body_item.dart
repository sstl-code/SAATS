import 'package:flutter/material.dart';

class DrawerBodyWidget extends StatelessWidget {
  const DrawerBodyWidget(
      {Key? key,
      this.icon,
      required this.text,
      this.imageUrl,
      required this.onTap})
      : super(key: key);
  final IconData? icon;
  final String text;
  final String? imageUrl;
  final GestureTapCallback onTap;
  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: Row(
        children: <Widget>[
          icon == null
              ? imageUrl == null
                  ? Container()
                  : Image.asset(imageUrl!, height: 25, width: 25)
              : Icon(icon),
          Padding(
            padding: const EdgeInsets.only(left: 8.0),
            child: Text(text),
          )
        ],
      ),
      onTap: onTap,
    );
  }
}
