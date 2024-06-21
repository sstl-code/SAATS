import 'dart:io';

import 'package:ats_system/main.dart';
import 'package:ats_system/screens/auth/login_page.dart';
import 'package:ats_system/screens/splash/bloc/app_metadata_bloc.dart';
import 'package:ats_system/screens/splash/bloc/app_metadata_event.dart';
import 'package:ats_system/screens/splash/bloc/app_metadata_state.dart';
import 'package:ats_system/screens/splash/datasource/app_metadata_manager.dart';
import 'package:ats_system/screens/splash/model/common_meta_data/common_meta_data.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class SplashPage extends StatefulWidget {
  static const String routeName = '/';
  const SplashPage({Key? key}) : super(key: key);

  @override
  State<SplashPage> createState() => _SplashPageState();
}

class _SplashPageState extends State<SplashPage> {
  void _gotoLogin() {
    Navigator.pushNamedAndRemoveUntil(
        context, LoginPage.routeName, (route) => false);
  }

  @override
  void initState() {
    super.initState();
    context.read<AppMetaDataBloc>().add(AppMetaDataEvent.getAppMetaData());
  }

  @override
  Widget build(BuildContext context) {
    return SafeArea(
        child: Scaffold(
      body: BlocConsumer<AppMetaDataBloc, AppMetaDataState>(
        listener: (context, state) {
          if ((state is Success)) {
            CommonMetaData response = state.data;
            var appMetaData = response.data?.appMetadata;
            print('app metadata ${appMetaData?.isNotEmpty}');
            if (appMetaData?.isNotEmpty == true) {
              final AppMetaDataManager dataSource = locator
                  .get<AppMetaDataManager>(instanceName: 'local-app-metadata');
              dataSource.clear().then((value) {
                for (var item in appMetaData!) {
                  dataSource.add(item);
                }
                _gotoLogin();
              });
            } else {
              ToastMessage.showMessage(failedToInitialiseApp, kToastErrorColor);
              exit(0);
            }
          } else if ((state is Error)) {
            exit(0);
          } else if ((state is NoInternet)) {
            ToastMessage.showMessage(state.message, kToastErrorColor);
          }
        },
        builder: (context, state) {
          if ((state is Loading)) {
            return Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Image.asset('assets/images/splash.png'),
                  const SizedBox(
                    height: 20,
                  ),
                  const CircularProgressIndicator(),
                ],
              ),
            );
          }
          return Container();
        },
      ),
    ));
  }
}
