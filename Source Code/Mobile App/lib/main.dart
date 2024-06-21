import 'dart:async';

import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/di/di.dart';
import 'package:ats_system/main_provider.dart';
import 'package:ats_system/proxy/custom_proxy.dart';
import 'package:ats_system/proxy/data/proxy_settings_provider.dart';
import 'package:ats_system/repository/navigation_service.dart';
import 'package:ats_system/routes/routes.dart';
import 'package:ats_system/screens/asset_audit/data/asset_audit_provider.dart';
import 'package:ats_system/screens/asset_details/data/asset_details_provider.dart';
import 'package:ats_system/screens/auth/bloc/auth_bloc.dart';
import 'package:ats_system/screens/auth/data/login_provider.dart';
import 'package:ats_system/screens/home/data/home_provider.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_bloc.dart';
import 'package:ats_system/screens/site_gallery/bloc/site_gallery_bloc.dart';
import 'package:ats_system/screens/splash/bloc/app_metadata_bloc.dart';
import 'package:ats_system/screens/task_list/data/task_provider.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/session_management/session_config.dart';
import 'package:ats_system/utils/session_management/session_timeout_manager.dart';
import 'package:ats_system/widgets/keyboard_visibility_listener.dart';
import 'package:connectivity_plus/connectivity_plus.dart';
import 'package:dynamic_color/dynamic_color.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:get_it/get_it.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';

GetIt locator = GetIt.instance;

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await configInjector(locator);

  if (!kReleaseMode) {
    final proxyIpAddress = locator.get<SessionManager>().getProxyIpAddress();
    final proxyPort = locator.get<SessionManager>().getProxyPort();

    if (proxyIpAddress != null &&
        proxyIpAddress.isNotEmpty &&
        proxyPort != null &&
        proxyPort.isNotEmpty) {
      final proxy =
          CustomProxy(ipAddress: proxyIpAddress, port: int.parse(proxyPort));
      proxy.enable();
    }
  }

  SystemChrome.setSystemUIOverlayStyle(const SystemUiOverlayStyle(
      statusBarColor: Color(0xff4a60cb),
      systemNavigationBarColor: Colors.transparent));
  runApp(
    MultiProvider(
        providers: [
          ChangeNotifierProvider(create: (context) => LoginProvider()),
          ChangeNotifierProvider(create: (context) => HomeProvider()),
          ChangeNotifierProvider(create: (context) => MainProvider()),
          ChangeNotifierProvider(create: (context) => AssetDetailsProvider()),
          ChangeNotifierProvider(create: (context) => TaskProvider()),
          ChangeNotifierProvider(create: (context) => AssetAuditProvider()),
          ChangeNotifierProvider(create: (context) => ProxySettingsProvider()),
        ],
        child: MultiBlocProvider(
          providers: [
            BlocProvider<AuthBloc>.value(value: locator.get<AuthBloc>()),
            BlocProvider<SiteGalleryBloc>.value(
                value: locator.get<SiteGalleryBloc>()),
            BlocProvider<CaptureFileBloc>.value(
                value: locator.get<CaptureFileBloc>()),
            BlocProvider<AppMetaDataBloc>.value(
                value: locator.get<AppMetaDataBloc>()),
          ],
          child: MyApp(),
        )),
  );
}

class MyApp extends StatefulWidget {
  MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  final Connectivity _connectivity = Connectivity();
  late StreamSubscription<ConnectivityResult> _connectivitySubscription;
  @override
  void initState() {
    context
        .read<MainProvider>()
        .sessionConfig
        .stream
        .listen((SessionTimeoutState timeoutEvent) {
      context
          .read<MainProvider>()
          .sessionStateStream
          .add(SessionState.stopListening);
      if (timeoutEvent == SessionTimeoutState.userInactivityTimeout) {
        CommonMethods.gotoLogin(
            NavigationService.navigatorKey.currentState!.context);
      } else if (timeoutEvent == SessionTimeoutState.appFocusTimeout) {
        CommonMethods.gotoLogin(
            NavigationService.navigatorKey.currentState!.context);
      }
    });

    _connectivitySubscription =
        _connectivity.onConnectivityChanged.listen((ConnectivityResult result) {
      print('Network status changed: $result');
    });

    super.initState();
  }

  @override
  void dispose() {
    Provider.of<LoginProvider>(context, listen: false).clearAll();
    _connectivitySubscription.cancel();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    SystemChrome.setSystemUIOverlayStyle(SystemUiOverlayStyle(
      statusBarColor: kPrimaryColor,
    ));
    return KeyboardVisibilityListener(
      listener: (isKeyboardVisible) {
        if (isKeyboardVisible) {
          context.read<MainProvider>().sessionTimeoutState(false);
        } else {
          context.read<MainProvider>().sessionTimeoutState(true);
        }
      },
      child: Consumer<MainProvider>(
        builder: (context, provider, child) {
          // final int color = 0xFF5722;

          return DynamicColorBuilder(
              builder: (ColorScheme? lightDynamic, ColorScheme? darkDynamic) {
            // ColorScheme lightColorScheme;
            // ColorScheme darkColorScheme;
            // if (lightDynamic != null && darkDynamic != null) {
            //   lightColorScheme = lightDynamic.harmonized();
            //   darkColorScheme = darkDynamic.harmonized();
            // } else {
            //   lightColorScheme = ColorScheme.fromSeed(
            //     seedColor: kPrimaryColor,
            //   );
            //   darkColorScheme = ColorScheme.fromSeed(
            //     seedColor: kPrimaryColor,
            //     brightness: Brightness.dark,
            //   );
            // }

            // final TextTheme darkTextTheme = GoogleFonts.getTextTheme(
            //   'Outfit',
            //   ThemeData.dark().textTheme,
            // );
            // final TextTheme lightTextTheme = GoogleFonts.getTextTheme(
            //   'Outfit',
            //   ThemeData.light().textTheme,
            // );

            return SessionTimeoutManager(
              sessionConfig: provider.sessionConfig,
              sessionStateStream: provider.sessionStateStream.stream,
              child: GestureDetector(
                onTap: () => FocusManager.instance.primaryFocus?.unfocus(),
                child: MaterialApp(
                  title: 'ATS System',
                  navigatorKey: NavigationService.navigatorKey,
                  debugShowCheckedModeBanner: false,
                  theme: ThemeData(
                      textTheme: GoogleFonts.getTextTheme(
                        'Outfit',
                        ThemeData.light().textTheme,
                      ),
                      scaffoldBackgroundColor: scaffoldBackgroundColor,
                      appBarTheme: const AppBarTheme(
                        color: kPrimaryColor,
                        foregroundColor: Colors.white,
                      ),
                      primaryColor: kPrimaryColor,
                      progressIndicatorTheme:
                          ProgressIndicatorThemeData(color: kPrimaryColor),
                      elevatedButtonTheme: ElevatedButtonThemeData(
                          style: ElevatedButton.styleFrom(
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(5),
                              ),
                              backgroundColor: kPrimaryColor,
                              foregroundColor: Colors.white,
                              textStyle: const TextStyle(color: Colors.white))),
                      outlinedButtonTheme: OutlinedButtonThemeData(
                          style: OutlinedButton.styleFrom(
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(5),
                        ),
                      ))),
                  // theme: appTheme(
                  //   context,
                  //   lightColorScheme,
                  //   'Outfit',
                  //   lightTextTheme,
                  //   ThemeData.light().dividerColor,
                  //   SystemUiOverlayStyle.dark,
                  // ),
                  // darkTheme: appTheme(
                  //   context,
                  //   lightColorScheme,
                  //   'Outfit',
                  //   lightTextTheme,
                  //   ThemeData.light().dividerColor,
                  //   SystemUiOverlayStyle.dark,
                  // ),
                  onGenerateRoute: Routes.generateRoute,
                  initialRoute: '/',
                ),
              ),
            );
          });
        },
      ),
    );
  }
}
