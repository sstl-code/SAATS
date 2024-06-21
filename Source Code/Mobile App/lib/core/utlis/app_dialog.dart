import 'package:flutter/material.dart';

appDialog(BuildContext context, Widget dialogWidget,
    {bool barrierDismissible = false}) {
  showDialog(
    context: context,
    barrierDismissible: barrierDismissible,
    builder: (BuildContext context) => dialogWidget,
  );
}
