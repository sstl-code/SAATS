import 'dart:convert';

import 'package:ats_system/utils/log_util.dart';
import 'package:dio/dio.dart';

class LoggingInterceptor extends Interceptor {
  @override
  void onRequest(RequestOptions options, RequestInterceptorHandler handler) {
    LogUtil.logPrint('Path:', "--> ${options.method} ${options.path}");
    if (options.data != null) {
      LogUtil.logPrint('Request:', jsonEncode(options.data));
    }
    super.onRequest(options, handler);
  }

  @override
  void onResponse(Response response, ResponseInterceptorHandler handler) {
    print("<-- ${response.statusCode} ${response.requestOptions.path}");
    if (response.data != null) {
      LogUtil.logPrint('Response:', jsonEncode(response.data));
    }
    super.onResponse(response, handler);
  }

  @override
  void onError(DioException err, ErrorInterceptorHandler handler) {
    super.onError(err, handler);
  }
}
