import 'package:ats_system/screens/site_gallery/models/get_gallery_request_model.dart';
import 'package:freezed_annotation/freezed_annotation.dart';

part 'site_gallery_event.freezed.dart';

@freezed
class SiteGalleryEvent with _$SiteGalleryEvent {
  factory SiteGalleryEvent.getGallery(GetGalleryRequestModel data) = GetGallery;
}
