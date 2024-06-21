import 'package:flutter/material.dart';
import 'package:flutter/services.dart';

class SatsTextFormField extends StatelessWidget {
  const SatsTextFormField({
    super.key,
    required this.controller,
    required this.hintText,
    this.keyboardType = TextInputType.none,
    this.validator,
    this.onChanged,
    this.enabled = true,
    this.focusNode,
    this.maxLength,
    this.maxLines,
    this.label,
    this.inputFormatters,
    this.counterText,
    this.autovalidateMode,
    this.textCapitalization = TextCapitalization.sentences,
  });

  final String? Function(String?)? validator;
  final Function(String)? onChanged;
  final TextEditingController controller;
  final String? counterText;
  final bool? enabled;
  final String hintText;
  final List<TextInputFormatter>? inputFormatters;
  final TextInputType keyboardType;
  final AutovalidateMode? autovalidateMode;
  final String? label;
  final int? maxLength;
  final int? maxLines;
  final TextCapitalization textCapitalization;
  final FocusNode? focusNode;

  @override
  Widget build(BuildContext context) {
    return TextFormField(
      maxLength: maxLength,
      maxLines: maxLines,
      autovalidateMode: autovalidateMode,
      enabled: enabled,
      focusNode: focusNode,
      controller: controller,
      keyboardType: keyboardType,
      textCapitalization: textCapitalization,
      decoration: InputDecoration(
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(8.0),
        ),
        hintText: hintText,
        label: label != null ? Text(label!) : null,
      ),
      validator: validator,
      onChanged: onChanged,
      inputFormatters: inputFormatters,
    );
  }
}
