import 'package:location/location.dart';

class LocationHandler {
  Location location = Location();

  Future<void> checkLocationPermission({
    required Function onPermissionGranted,
    required Function onPermissionDenied,
    required Function onPermissionDeniedPermenanty,
  }) async {
    bool serviceEnabled = await location.serviceEnabled();
    if (!serviceEnabled) {
      serviceEnabled = await location.requestService();
      if (!serviceEnabled) {
        return;
      } else {
        checkPermission(onPermissionGranted: () {
          onPermissionGranted();
          return;
          // try {
          //   // LocationData locationData = await location.getLocation();
          // } catch (e) {
          //   print(e);
          // }
        }, onPermissionDenied: () {
          onPermissionDenied();
        }, onPermissionDeniedPermenanty: () {
          onPermissionDeniedPermenanty();
        });
      }
    } else {
      checkPermission(onPermissionGranted: () {
        onPermissionGranted();
        return;
        // try {
        //   // LocationData locationData = await location.getLocation();
        // } catch (e) {
        //   print(e);
        // }
      }, onPermissionDenied: () {
        onPermissionDenied();
        return;
      }, onPermissionDeniedPermenanty: () {
        onPermissionDeniedPermenanty();
        return;
      });
    }
  }

  checkPermission({
    required Function onPermissionGranted,
    required Function onPermissionDenied,
    required Function onPermissionDeniedPermenanty,
  }) async {
    PermissionStatus permissionGranted = await location.hasPermission();
    if (permissionGranted == PermissionStatus.granted) {
      onPermissionGranted();
    } else if (permissionGranted == PermissionStatus.deniedForever) {
      onPermissionDeniedPermenanty();
      return;
    } else if (permissionGranted == PermissionStatus.denied) {
      permissionGranted = await location.requestPermission();
      onPermissionDenied();
    }
  }
}
