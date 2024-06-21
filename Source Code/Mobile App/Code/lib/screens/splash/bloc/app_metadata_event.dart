import 'package:freezed_annotation/freezed_annotation.dart';

part 'app_metadata_event.freezed.dart';

@freezed
class AppMetaDataEvent with _$AppMetaDataEvent {
  factory AppMetaDataEvent.getAppMetaData() = GetAppMetaData;
}
