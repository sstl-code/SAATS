import 'package:ats_system/core/extensions/extensions.dart';
import 'package:ats_system/core/widgets/sats_text_form_field.dart';
import 'package:ats_system/screens/auth/bloc/auth_bloc.dart';
import 'package:ats_system/screens/auth/bloc/auth_event.dart';
import 'package:ats_system/screens/auth/bloc/auth_state.dart';
import 'package:ats_system/screens/auth/models/forgot_password/get_otp/get_otp_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/update_password/update_password_request_model.dart';
import 'package:ats_system/screens/auth/models/forgot_password/validate_otp/validate_otp_request_model.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class ForgotPasswordDialog extends StatefulWidget {
  const ForgotPasswordDialog({super.key});

  @override
  State<ForgotPasswordDialog> createState() => _ForgotPasswordDialogState();
}

class _ForgotPasswordDialogState extends State<ForgotPasswordDialog> {
  final _userIdController = TextEditingController();
  var _otpController = TextEditingController();
  var _confirmPwController = TextEditingController();
  var _newPwController = TextEditingController();
  bool _isNewVisible = true,
      _isConfirmVisible = true,
      _isEmailValid = false,
      _isOtpLengthValid = false,
      _enableOtpField = false,
      _enablePasswordFields = false,
      _shouldAutovalidateOtp = false;
  final FocusNode _otpFocusNode = FocusNode();
  final FocusNode _newPasswordFocusNode = FocusNode();
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();

  @override
  void dispose() {
    _userIdController.dispose();
    _otpController.dispose();
    _confirmPwController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(left: 16.0, right: 16),
      child: Form(
        key: _formKey,
        child: ListView(
          shrinkWrap: true,
          physics: BouncingScrollPhysics(),
          children: [
            Padding(
              padding: const EdgeInsets.only(top: 25.0),
              child: SatsTextFormField(
                keyboardType: TextInputType.emailAddress,
                controller: _userIdController,
                key: const Key('user_name_textfield'),
                hintText: "Enter email",
                label: "Email",
                onChanged: (value) {
                  setState(() {
                    _isEmailValid = isValidEmail(value);
                  });
                },
                autovalidateMode: AutovalidateMode.onUserInteraction,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter your email';
                  }
                  if (!isValidEmail(value)) {
                    return 'Please enter a valid email address';
                  }

                  return null;
                },
              ),
            ),
            const SizedBox(height: 5.0),
            Align(
              alignment: Alignment.bottomRight,
              child: BlocConsumer<AuthBloc, AuthState>(
                listener: (context, state) {
                  if (state is GetOtpState) {
                    if (state is GetOtpStateSuccess) {
                      setState(() {
                        _shouldAutovalidateOtp = false;
                        _enableOtpField = true;
                        Future.delayed(Duration(milliseconds: 500), () {
                          setState(() {
                            FocusScope.of(context).requestFocus(_otpFocusNode);
                          });
                        });
                      });
                    } else {
                      setState(() {
                        _enableOtpField = false;
                      });
                    }
                  }
                },
                builder: (context, state) {
                  return ElevatedButton(
                    onPressed: (_isEmailValid)
                        ? () {
                            _enableOtpField = false;
                            _enablePasswordFields = false;
                            _isOtpLengthValid = false;
                            _otpController = TextEditingController();
                            _newPwController = TextEditingController();
                            _confirmPwController = TextEditingController();
                            context.read<AuthBloc>().add(AuthEvent.getOtp(
                                GetOtpRequestModel(
                                    email:
                                        _userIdController.text.toLowerCase())));
                          }
                        : null,
                    child: (state is GetOtpStateLoading)
                        ? const SizedBox(
                            width: 24.0,
                            height: 24.0,
                            child: CircularProgressIndicator(
                              color: Colors.white,
                              strokeWidth: 3,
                            ),
                          )
                        : const Text(Strings.btnGetOTP),
                  );
                },
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(top: 16.0),
              child: SatsTextFormField(
                enabled: _enableOtpField,
                focusNode: _otpFocusNode,
                keyboardType: TextInputType.number,
                controller: _otpController,
                key: const Key('otp'),
                hintText: "Enter Otp",
                label: "OTP",
                maxLength: 6,
                onChanged: (value) {
                  if (!_shouldAutovalidateOtp) {
                    setState(() {
                      _shouldAutovalidateOtp = true;
                    });
                  }
                  setState(() {
                    _isOtpLengthValid = (value.length == 6);
                  });
                },
                autovalidateMode: (_shouldAutovalidateOtp)
                    ? AutovalidateMode.onUserInteraction
                    : AutovalidateMode.disabled,
                validator: (value) {
                  if (_shouldAutovalidateOtp &&
                      (value == null || value.isEmpty)) {
                    return 'Please enter the otp';
                  }
                  if (_shouldAutovalidateOtp && value!.length < 6) {
                    return 'Otp must me 6 digits';
                  }

                  return null;
                },
              ),
            ),
            Align(
              alignment: Alignment.bottomRight,
              child: ElevatedButton(
                onPressed: _isOtpLengthValid
                    ? () {
                        context.read<AuthBloc>().add(AuthEvent.validateOtp(
                            ValidateOtpRequestModel(
                                email: _userIdController.text.toLowerCase(),
                                otp: _otpController.text)));
                      }
                    : null,
                child: BlocConsumer<AuthBloc, AuthState>(
                  listener: (context, state) {
                    if (state is ValidateOtpState) {
                      if (state is ValidateOtpStateSuccess) {
                        setState(() {
                          _enablePasswordFields = true;
                          Future.delayed(Duration(milliseconds: 500), () {
                            setState(() {
                              FocusScope.of(context)
                                  .requestFocus(_newPasswordFocusNode);
                            });
                          });
                        });
                      } else {
                        setState(() {
                          _enablePasswordFields = false;
                        });
                      }
                    }
                  },
                  builder: (context, state) {
                    return (state is ValidateOtpStateLoading)
                        ? const SizedBox(
                            width: 24.0,
                            height: 24.0,
                            child: CircularProgressIndicator(
                              color: Colors.white,
                              strokeWidth: 3,
                            ),
                          )
                        : Text('Verify OTP');
                  },
                ),
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(top: 16.0),
              child: TextFormField(
                obscureText: _isNewVisible,
                enabled: _enablePasswordFields,
                controller: _newPwController,
                focusNode: _newPasswordFocusNode,
                key: const Key('newPassword'),
                decoration: InputDecoration(
                    border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(8.0),
                    ),
                    hintText: 'Password',
                    label: Text('New Password'),
                    suffixIcon: IconButton(
                        onPressed: () {
                          setState(() => _isNewVisible = !_isNewVisible);
                        },
                        icon: Icon(_isNewVisible
                            ? Icons.visibility_off
                            : Icons.visibility))),
                autovalidateMode: AutovalidateMode.onUserInteraction,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter password';
                  } else if (value.length < 6) {
                    return 'Password must be at least 6 characters';
                  }

                  return null;
                },
              ),
            ),
            Padding(
              padding: const EdgeInsets.only(top: 16.0),
              child: TextFormField(
                obscureText: _isConfirmVisible,
                enabled: _enablePasswordFields,
                controller: _confirmPwController,
                key: const Key('confirmPassword'),
                decoration: InputDecoration(
                    border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(8.0),
                    ),
                    hintText: 'Password',
                    label: Text('Confirm Password'),
                    suffixIcon: IconButton(
                        onPressed: () {
                          setState(
                              () => _isConfirmVisible = !_isConfirmVisible);
                        },
                        icon: Icon(_isConfirmVisible
                            ? Icons.visibility_off
                            : Icons.visibility))),
                autovalidateMode: AutovalidateMode.onUserInteraction,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter confirm password';
                  } else if (value != _newPwController.text) {
                    return 'Passwords do not match';
                  }

                  return null;
                },
              ),
            ),
            const SizedBox(height: 15),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                  onPressed: _enablePasswordFields
                      ? () {
                          if (_formKey.currentState?.validate() == true) {
                            context.read<AuthBloc>().add(AuthEvent
                                .updatePassword(UpdatePasswordRequestModel(
                                    email: _userIdController.text.toLowerCase(),
                                    newPassword: _newPwController.text,
                                    confrimpassword:
                                        _confirmPwController.text)));
                            print('All fields are valid. Do something...');
                          }
                        }
                      : null,
                  child: BlocConsumer<AuthBloc, AuthState>(
                    listener: (context, state) {
                      if (state is UpdatePasswordState) {
                        if (state is UpdatePasswordStateSuccess) {
                          Navigator.pop(context);
                        }
                      }
                    },
                    builder: (context, state) {
                      return (state is UpdatePasswordStateLoading)
                          ? const SizedBox(
                              width: 24.0,
                              height: 24.0,
                              child: CircularProgressIndicator(
                                color: Colors.white,
                                strokeWidth: 3,
                              ),
                            )
                          : Text(Strings.btnConfirm);
                    },
                  ),
                ),
                const SizedBox(width: 15),
                ElevatedButton(
                  onPressed: () => Navigator.pop(context),
                  child: const Text(Strings.btnCancel),
                ),
              ],
            ),
            const SizedBox(height: 25),
          ],
        ),
      ),
    );
  }
}
