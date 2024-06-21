import 'package:ats_system/screens/site_gallery/models/init_camera_controller_event.dart';
import 'package:ats_system/screens/site_gallery/models/init_video_controller_event.dart';
import 'package:ats_system/screens/site_gallery/models/reset_event.dart';
import 'package:freezed_annotation/freezed_annotation.dart';

part 'capture_file_event.freezed.dart';

@freezed
class CaptureFileEvent with _$CaptureFileEvent {
  factory CaptureFileEvent.initCameraController(
      InitCameraControllerEvent data) = InitCameraController;
  factory CaptureFileEvent.initVideoPlayeroOntroller(
      InitVideoPlayerControllerEvent data) = InitVideoPlayerController;
  factory CaptureFileEvent.resetEvent(ResetEvent data) = Reset;
}
