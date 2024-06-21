import 'dart:io';

import 'package:ats_system/core/utlis/permission_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/screens/auth/data/login_provider.dart';
import 'package:ats_system/screens/home/home_page.dart';
import 'package:ats_system/screens/splash/datasource/app_metadata_manager.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/app_metadatum.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/strings.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:ats_system/widgets/progress_bar.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:device_info_plus/device_info_plus.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:provider/provider.dart';

import 'forgot_password_dialog.dart';

class LoginPage extends StatefulWidget {
  static const String routeName = '/login';

  const LoginPage({Key? key}) : super(key: key);

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final TextEditingController _usernameController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  final GlobalKey<ScaffoldState> _key = GlobalKey();
  bool _isVisible = true;
  final AppMetaDataManager dataSource =
      locator.get<AppMetaDataManager>(instanceName: 'local-app-metadata');

  void _showForgetPasswordDialog(BuildContext context) {
    CustomDialogBox.appDialog(
        context,
        CustomDialog(
            title: Strings.forgotPassword,
            body: ForgotPasswordDialog(),
            footer: SizedBox(),
            setStandardPadding: false));
  }

  void _doLogin() {
    FocusScope.of(context).unfocus();
    LoginProvider provider = context.read<LoginProvider>();
    if (!provider.validateBoth(
        _usernameController.text, _passwordController.text)) return;
    if (!provider.isValidUserId(_usernameController.text)) return;
    if (!provider.isValidPassword({"pw": _passwordController.text})) return;

    context
        .read<LoginProvider>()
        .doLogin(_usernameController.text, _passwordController.text)
        .then((response) {
      if (response == null) {
        ToastMessage.showMessage(Strings.loginFailed, kToastErrorColor);
        return;
      }
      if (response == 'Success') {
        Navigator.pushNamedAndRemoveUntil(
            context, HomePage.routeName, (route) => false);
      } else {
        ToastMessage.showMessage(response, kToastErrorColor);
      }
    });
  }

  @override
  void initState() {
    // _usernameController.text = 'ravishankar.lingaraju@ssquarespenta.com';
    // _passwordController.text = 'Password@123';
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
        key: _key,
        backgroundColor: const Color.fromARGB(255, 137, 171, 199),
        body: Column(
          children: [
            Expanded(
              child: Center(
                child: SingleChildScrollView(
                  child: Card(
                    margin: const EdgeInsets.all(20),
                    elevation: 5,
                    child: Padding(
                      padding: const EdgeInsets.symmetric(
                          horizontal: 10.0, vertical: 5.0),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              FutureBuilder<AppMetadatum?>(
                                  future: getValueByKey('SSTL_Logo'),
                                  builder: (context, snapshot) {
                                    if (snapshot.hasData) {
                                      AppMetadatum? metaData = snapshot.data!;
                                      return CachedNetworkImage(
                                          height: 47,
                                          width: 170,
                                          imageUrl: metaData.settingValue ?? '',
                                          errorWidget: (context, url, error) =>
                                              Icon(Icons.error),
                                          fit: BoxFit.fill);
                                    } else {
                                      return SizedBox();
                                    }
                                  }),
                              FutureBuilder<AppMetadatum?>(
                                  future: getValueByKey('Client_Logo'),
                                  builder: (context, snapshot) {
                                    if (snapshot.hasData) {
                                      AppMetadatum? metaData = snapshot.data!;
                                      return CachedNetworkImage(
                                          height: 30,
                                          width: 90,
                                          imageUrl: metaData.settingValue ?? '',
                                          errorWidget: (context, url, error) =>
                                              Icon(Icons.error),
                                          fit: BoxFit.fill);
                                    } else {
                                      return SizedBox();
                                    }
                                  }),
                            ],
                          ),
                          const Text(Strings.signIn,
                              style: TextStyle(
                                  color: Colors.black,
                                  fontSize: 20,
                                  fontWeight: FontWeight.w600)),
                          const SizedBox(height: 20),
                          Selector<LoginProvider, String?>(
                              selector: (context, provider) =>
                                  provider.userError,
                              builder: (context, error, child) {
                                return TextField(
                                  keyboardType: TextInputType.emailAddress,
                                  controller: _usernameController,
                                  onChanged: (String? text) {
                                    if (text != null && error != null)
                                      context
                                          .read<LoginProvider>()
                                          .setUserError(null);
                                  },
                                  decoration: InputDecoration(
                                      hintText: Strings.enterUserName,
                                      border: const OutlineInputBorder(),
                                      errorText: error),
                                );
                              }),
                          const SizedBox(height: 10),
                          Selector<LoginProvider, String?>(
                              selector: (context, provider) => provider.pwError,
                              builder: (context, error, child) {
                                return TextField(
                                  controller: _passwordController,
                                  obscureText: _isVisible,
                                  onChanged: (String? text) {
                                    if (text != null && error != null)
                                      context
                                          .read<LoginProvider>()
                                          .setPwError(null);
                                  },
                                  decoration: InputDecoration(
                                    hintText: Strings.enterPassword,
                                    errorText: error,
                                    suffixIcon: IconButton(
                                        onPressed: () {
                                          setState(
                                              () => _isVisible = !_isVisible);
                                        },
                                        icon: Icon(_isVisible
                                            ? Icons.visibility_off
                                            : Icons.visibility)),
                                    border: const OutlineInputBorder(),
                                  ),
                                );
                              }),
                          const SizedBox(height: 10),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.end,
                            children: [
                              TextButton(
                                onPressed: () =>
                                    _showForgetPasswordDialog(context),
                                style: TextButton.styleFrom(
                                    foregroundColor: Colors.black),
                                child: const Text(Strings.forgetPassword),
                              ),
                            ],
                          ),
                          Selector<LoginProvider, bool>(
                              selector: (context, provider) =>
                                  provider.isProcessing,
                              builder: (context, value, child) {
                                return value
                                    ? const Column(children: [
                                        SizedBox(height: 10),
                                        ProgressBar()
                                      ])
                                    : Container();
                              }),
                          const SizedBox(height: 10),
                          ElevatedButton(
                              onPressed: () async {
                                if (!kIsWeb) {
                                  await checkPermission(
                                    permission: Permission.camera,
                                    onPermissionDeniedPermenanty: () {},
                                    onPermissionGranted: () {},
                                    onPermissionDenied: () {},
                                  );

                                  final deviceInfo = DeviceInfoPlugin();
                                  var permission;
                                  if (Platform.isAndroid) {
                                    final AndroidDeviceInfo androidInfo =
                                        await deviceInfo.androidInfo;
                                    final bool isAndroidVersionGreaterThan32 =
                                        androidInfo.version.sdkInt > 32;

                                    permission = isAndroidVersionGreaterThan32
                                        ? Permission.photos
                                        : Permission.storage;
                                  } else if (Platform.isIOS) {
                                    permission = Permission.photos;
                                  }

                                  await checkPermission(
                                    permission: permission,
                                    onPermissionDeniedPermenanty: () {
                                      _doLogin();
                                    },
                                    onPermissionGranted: () {
                                      _doLogin();
                                    },
                                    onPermissionDenied: () {
                                      _doLogin();
                                    },
                                  );
                                } else {
                                  _doLogin();
                                }
                              },
                              style: ElevatedButton.styleFrom(
                                  padding: const EdgeInsets.symmetric(
                                      horizontal: 30),
                                  backgroundColor: Colors.blue.shade900),
                              child: const Text(Strings.btnLogin)),
                          const SizedBox(height: 10),
                        ],
                      ),
                    ),
                  ),
                ),
              ),
            ),
            SizedBox(
              height: 20,
            ),
            Column(
              mainAxisAlignment: MainAxisAlignment.end,
              children: [
                const Text('\u00a9 S-Square Spenta Technologies LLP'),
                const SizedBox(
                  height: 15,
                ),
                Padding(
                  padding:
                      const EdgeInsets.only(left: 16, right: 16, bottom: 15),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      FutureBuilder<AppMetadatum?>(
                        future: getValueByKey('App_Version'),
                        builder: (context, snapshot) {
                          if (snapshot.hasData) {
                            AppMetadatum? metaData = snapshot.data;
                            return Text(
                              'App Version: ${metaData?.settingValue ?? 'N/A'}',
                              style: TextStyle(
                                  color: Colors.grey[700],
                                  fontStyle: FontStyle.italic,
                                  fontSize: 14),
                            );
                          } else {
                            return SizedBox();
                          }
                        },
                      ),
                      FutureBuilder<AppMetadatum?>(
                          future: getValueByKey('Released_Date'),
                          builder: (context, snapshot) {
                            if (snapshot.hasData) {
                              AppMetadatum? metaData = snapshot.data;
                              return Text(
                                'Released on: ${metaData?.settingValue ?? 'N/A'}',
                                style: TextStyle(
                                    color: Colors.grey[700],
                                    fontStyle: FontStyle.italic,
                                    fontSize: 14),
                              );
                            } else {
                              return SizedBox();
                            }
                          }),
                    ],
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Future<AppMetadatum?> getValueByKey(String? key) async {
    return dataSource.getValueByKey(key);
  }
}
