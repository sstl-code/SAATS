import 'package:flutter/material.dart';

class InputText extends StatelessWidget {
  const InputText(
      {Key? key,
      required this.title,
      required this.controller,
      required this.onChanged,
      this.error,
      this.enabled = true,
      this.readOnly = false,
      this.inputType,
      this.onTap,
      this.maxLines,
      this.isMandate = false})
      : super(key: key);
  final String title;
  final TextEditingController controller;
  final String? error;
  final void Function(String? text) onChanged;
  final TextInputType? inputType;
  final bool enabled;
  final bool readOnly;
  final VoidCallback? onTap;
  final int? maxLines;
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
                        fontSize: 14,
                        color: enabled
                            ? isMandate
                                ? const Color(0xff0000FF)
                                : const Color(0xff000000)
                            : Colors.grey)),
              ),
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
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 10),
            color: Colors.white,
            child: TextField(
              enabled: enabled,
              controller: controller,
              readOnly: readOnly,
              onTap: onTap,
              maxLines: maxLines,
              decoration: InputDecoration(
                border: InputBorder.none,
                errorText: error,
                isDense: true,
                contentPadding:
                    const EdgeInsets.symmetric(horizontal: 0, vertical: 5),
              ),
              onChanged: onChanged,
              keyboardType: inputType,
            ),
          ),
        ],
      ),
    );
  }
}
