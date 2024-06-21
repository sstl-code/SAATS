import 'package:connectivity_plus/connectivity_plus.dart';
import 'package:injectable/injectable.dart';

abstract class InternetConnectionService {
  Future<bool> isInternetConnected();
}

@Injectable(as: InternetConnectionService)
class InternetConnectionImpl implements InternetConnectionService {
  @override
  Future<bool> isInternetConnected() async {
    ConnectivityResult result = await Connectivity().checkConnectivity();
    return (result == ConnectivityResult.mobile ||
        result == ConnectivityResult.wifi);
  }
}
