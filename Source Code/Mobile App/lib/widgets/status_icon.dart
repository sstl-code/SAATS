import 'package:flutter/material.dart';

class StatusIcon extends StatelessWidget {
  const StatusIcon(
      {Key? key, required this.color, this.size = const Size(20.0, 20.0)})
      : super(key: key);
  final Color color;
  final Size size;

  @override
  Widget build(BuildContext context) {
    return Container(
      height: size.height,
      width: size.width,
      decoration:
          BoxDecoration(shape: BoxShape.circle, color: color, boxShadow: const [
        BoxShadow(
            color: Colors.black45,
            offset: Offset(0.0, 0.5),
            blurRadius: 5.0,
            spreadRadius: 2.0)
      ]),
    );
  }
}
