import 'dart:async';

import 'package:injectable/injectable.dart';
import 'package:location/location.dart';

abstract class LocationService {
  Future<LocationData> getUserLocation();
}

@Injectable(as: LocationService)
class LocationImpl implements LocationService {
  final _location = Location();

  @override
  Future<LocationData> getUserLocation() async {
    return _location.getLocation();
  }
}
