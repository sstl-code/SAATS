import 'package:flutter/material.dart';

class CustomDrawer extends Drawer {
  const CustomDrawer({Key? key, required this.widget}) : super(key: key);
  final Widget widget;

  @override
  Widget build(BuildContext context) {
    final DrawerThemeData drawerTheme = DrawerTheme.of(context);
    return Material(
      color: Colors.transparent,
      child: Container(
        constraints:
            BoxConstraints.expand(width: width ?? drawerTheme.width ?? 346.0),
        decoration: BoxDecoration(
          border: Border.all(color: Colors.white70.withAlpha(100), width: 1.5),
          borderRadius: const BorderRadius.only(
              topRight: Radius.circular(20), bottomRight: Radius.circular(20)),
          boxShadow: [
            BoxShadow(
                color: Colors.white54.withAlpha(10),
                blurRadius: 10.0,
                spreadRadius: 0.0)
          ],
          color: Colors.white54.withAlpha(40),
        ),
        child: widget,
      ),
    );
  }

  @override
  Widget? get child => super.child;
}
