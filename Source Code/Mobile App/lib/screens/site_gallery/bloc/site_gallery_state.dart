import 'package:ats_system/screens/site_gallery/models/event_failure.dart';
import 'package:freezed_annotation/freezed_annotation.dart';

part 'site_gallery_state.freezed.dart';

@freezed
class SiteGalleryState with _$SiteGalleryState {
  factory SiteGalleryState.initial() = Initial;

  factory SiteGalleryState.loading() = Loading;

  factory SiteGalleryState.success(dynamic data) = Success;

  factory SiteGalleryState.error(Failure error) = Error;

  factory SiteGalleryState.noInternet(String message) = NoInternet;
}
