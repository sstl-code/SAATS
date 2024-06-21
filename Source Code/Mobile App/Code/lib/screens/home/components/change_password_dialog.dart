import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/auth/data/login_provider.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

class ChangePasswordDialog extends StatefulWidget {
  const ChangePasswordDialog({Key? key}) : super(key: key);

  @override
  State<ChangePasswordDialog> createState() => _ChangePasswordDialogState();
}

class _ChangePasswordDialogState extends State<ChangePasswordDialog> {
  final _oldController = TextEditingController();
  final _newController = TextEditingController();
  final _confirmController = TextEditingController();
  bool _isOldVisible = true, _isNewVisible = true, _isConfirmVisible = true;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((timeStamp) {
      context.read<LoginProvider>().initializePassword();
    });
  }

  @override
  void dispose() {
    _oldController.dispose();
    _newController.dispose();
    _confirmController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return ListView(
      shrinkWrap: true,
      physics: BouncingScrollPhysics(),
      children: [
        const Text(Strings.oldPassword,
            style: TextStyle(fontSize: 15, fontWeight: FontWeight.bold)),
        const SizedBox(height: 5),
        Container(
          color: Colors.blue.shade50,
          child: Selector<LoginProvider, String?>(
              selector: (context, provider) => provider.pwError,
              builder: (context, error, child) {
                return TextField(
                  controller: _oldController,
                  obscureText: _isOldVisible,
                  decoration: InputDecoration(
                    errorText: error,
                    errorMaxLines: 3,
                    border: InputBorder.none,
                    suffixIcon: IconButton(
                        onPressed: () {
                          setState(() => _isOldVisible = !_isOldVisible);
                        },
                        icon: Icon(_isOldVisible
                            ? Icons.visibility_off
                            : Icons.visibility)),
                  ),
                );
              }),
        ),
        const SizedBox(height: 10),
        const Text(Strings.newPassword,
            style: TextStyle(fontSize: 15, fontWeight: FontWeight.bold)),
        const SizedBox(height: 5),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 10),
          color: Colors.blue.shade50,
          child: Selector<LoginProvider, String?>(
              selector: (context, provider) => provider.newPwError,
              builder: (context, error, child) {
                return TextField(
                  controller: _newController,
                  obscureText: _isNewVisible,
                  decoration: InputDecoration(
                    border: InputBorder.none,
                    errorText: error,
                    errorMaxLines: 3,
                    suffixIcon: IconButton(
                        onPressed: () {
                          setState(() => _isNewVisible = !_isNewVisible);
                        },
                        icon: Icon(_isNewVisible
                            ? Icons.visibility_off
                            : Icons.visibility)),
                  ),
                );
              }),
        ),
        const SizedBox(height: 10),
        const Text(Strings.confirmPassword,
            style: TextStyle(fontSize: 15, fontWeight: FontWeight.bold)),
        const SizedBox(height: 5),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 10),
          color: Colors.blue.shade50,
          child: Selector<LoginProvider, String?>(
              selector: (context, provider) => provider.cNPwError,
              builder: (context, error, child) {
                return TextField(
                  controller: _confirmController,
                  obscureText: _isConfirmVisible,
                  decoration: InputDecoration(
                    border: InputBorder.none,
                    errorText: error,
                    errorMaxLines: 3,
                    suffixIcon: IconButton(
                        onPressed: () {
                          setState(
                              () => _isConfirmVisible = !_isConfirmVisible);
                        },
                        icon: Icon(_isConfirmVisible
                            ? Icons.visibility_off
                            : Icons.visibility)),
                  ),
                );
              }),
        ),
        Selector<LoginProvider, bool>(
            selector: (context, provider) => provider.isProcessing,
            builder: (context, value, child) {
              return value
                  ? const Column(
                      children: [SizedBox(height: 10), ProgressBar()])
                  : Container();
            }),
        const SizedBox(height: 15),
        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            ElevatedButton(
              onPressed: () {
                FocusScope.of(context).unfocus();
                LoginProvider provider = context.read<LoginProvider>();
                if (!provider.isValidPassword({"pw": _oldController.text}))
                  return;
                if (!provider.isValidPassword({"np": _newController.text}))
                  return;
                if (!provider.isValidPassword({"cnp": _confirmController.text}))
                  return;
                String old = _oldController.text.trim();
                String np = _newController.text.trim();
                String cnp = _confirmController.text.trim();
                final oldPas = locator.get<SessionManager>().getPassword();
                if (oldPas != old) {
                  provider.setPwError(Strings.incorrectOldPassword);
                } else if (old == np) {
                  provider.setNewPwError(
                      "Old password and new password cannot be same.");
                } else if (old == cnp) {
                  provider.setCNPwError(
                      "Old password and confirm new password cannot be same.");
                } else if (np != cnp) {
                  provider.setCNPwError(
                      "New password and confirm new password are not matched.");
                } else {
                  context
                      .read<LoginProvider>()
                      .changePassword(_oldController.text, _newController.text)
                      .then((value) {
                    if (value.status == 200) {
                      final session = locator.get<SessionManager>();
                      session.setPassword(_newController.text);
                      ToastMessage.showMessage(
                          "Password changed successfully.", kToastSuccessColor);
                    } else {
                      ToastMessage.showMessage(
                          "Failed to change password.", kToastErrorColor);
                    }
                    Navigator.of(context).pop();
                  });
                }
              },
              child: const Text('Confirm'),
            ),
            const SizedBox(width: 10),
            ElevatedButton(
                onPressed: () => Navigator.of(context).pop(),
                child: const Text('Cancel'))
          ],
        ),
      ],
    );
  }
}
