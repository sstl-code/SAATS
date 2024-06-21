import 'package:ats_system/screens/site_gallery/models/event_failure.dart';
import 'package:freezed_annotation/freezed_annotation.dart';

part 'app_metadata_state.freezed.dart';

@freezed
class AppMetaDataState with _$AppMetaDataState {
  factory AppMetaDataState.initial() = Initial;

  factory AppMetaDataState.loading() = Loading;

  factory AppMetaDataState.success(dynamic data) = Success;

  factory AppMetaDataState.error(Failure error) = Error;

  factory AppMetaDataState.noInternet(String message) = NoInternet;
}
