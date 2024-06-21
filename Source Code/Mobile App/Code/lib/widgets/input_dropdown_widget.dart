import 'package:flutter/material.dart';

class InputDropdown extends StatelessWidget {
  const InputDropdown(
      {Key? key,
      required this.title,
      required this.child,
      this.isMandate = false})
      : super(key: key);
  final String title;
  final Widget child;
  final bool isMandate;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Flexible(
                  child: Text(title,
                      style: TextStyle(
                          fontWeight: FontWeight.bold,
                          color: isMandate
                              ? const Color(0xff0000FF)
                              : const Color(0xff000000),
                          fontSize: 14))),
              Visibility(
                  visible: isMandate,
                  child: Text('*',
                      style: TextStyle(
                          color: Colors.red,
                          fontWeight: FontWeight.bold,
                          fontSize: 14))),
            ],
          ),
          const SizedBox(height: 5),
          child,
        ],
      ),
    );
  }
}
