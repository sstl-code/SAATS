import 'package:flutter/material.dart';

extension ShowSnackBar on BuildContext {
  showSnackBar(String message) {
    ScaffoldMessenger.of(this).showSnackBar(
      SnackBar(
        margin: const EdgeInsets.all(10),
        behavior: SnackBarBehavior.floating,
        content: Center(
          child: Text(message),
        ),
      ),
    );
  }
}
