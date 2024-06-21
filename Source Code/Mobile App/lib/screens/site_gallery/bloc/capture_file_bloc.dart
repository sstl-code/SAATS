import 'package:ats_system/repository/internet_connection_service.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_event.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_state.dart';
import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:ats_system/screens/site_gallery/repo/site_gallery_repo.dart';
import 'package:bloc/bloc.dart';
import 'package:camera/camera.dart';
import 'package:chewie/chewie.dart';
import 'package:injectable/injectable.dart';
import 'package:video_player/video_player.dart';

@injectable
class CaptureFileBloc extends Bloc<CaptureFileEvent, CaptureFileState> {
  final SiteGalleryRepo siteGalleryRepo;
  final InternetConnectionService internetConnection;
  late CameraController? controller;
  late ChewieController chewieController;
  late VideoPlayerController videoPlayerController;

  CaptureFileBloc(this.siteGalleryRepo, this.internetConnection)
      : super(CaptureFileState.initial()) {
    on<InitCameraController>(_initCameraController);
    on<InitVideoPlayerController>(_initVideoPlayerController);
    on<Reset>(_resetEvent);
  }

  void clearRecordingController() {
    videoPlayerController.pause();
    videoPlayerController.pause();
    chewieController.dispose();
    videoPlayerController.dispose();
  }

  void _initCameraController(InitCameraController event, emit) async {
    emit(CaptureFileState.loading());
    final cameras = await availableCameras();

    final CameraDescription camera = cameras.first;

    if (event.data.siteGalleryType == GalleryType.photo) {
      controller = CameraController(
        camera,
        ResolutionPreset.high,
      );
    } else {
      controller = CameraController(
        camera,
        ResolutionPreset.low,
      );
    }

    await controller?.initialize();
    emit(CaptureFileState.success(controller));
  }

  void _initVideoPlayerController(InitVideoPlayerController event, emit) async {
    emit(CaptureFileState.loading());

    videoPlayerController =
        VideoPlayerController.networkUrl(Uri.parse(event.data.videoUrl));
    await videoPlayerController.initialize();
    chewieController = ChewieController(
      videoPlayerController: videoPlayerController,
      autoPlay: true,
      looping: false,
    );
    emit(CaptureFileState.success(chewieController));
  }

  void _resetEvent(Reset event, emit) async {
    emit(CaptureFileState.completed());
  }
}
