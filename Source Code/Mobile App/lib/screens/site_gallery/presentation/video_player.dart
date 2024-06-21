import 'package:ats_system/screens/site_gallery/bloc/capture_file_bloc.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_event.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_state.dart';
import 'package:ats_system/screens/site_gallery/models/init_video_controller_event.dart';
import 'package:ats_system/screens/site_gallery/models/reset_event.dart';
import 'package:chewie/chewie.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class VideoPlayerScreen extends StatefulWidget {
  final String videoUrl;
  static const String routeName = '/videoPlayer';

  VideoPlayerScreen({required this.videoUrl});

  @override
  _VideoPlayerScreenState createState() => _VideoPlayerScreenState();
}

class _VideoPlayerScreenState extends State<VideoPlayerScreen> {
  CaptureFileBloc? siteGalleryBloc;

  @override
  void initState() {
    super.initState();

    context.read<CaptureFileBloc>().add(
        CaptureFileEvent.initVideoPlayeroOntroller(
            InitVideoPlayerControllerEvent(videoUrl: widget.videoUrl)));
  }

  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () async {
        context
            .read<CaptureFileBloc>()
            .add(CaptureFileEvent.resetEvent(ResetEvent()));
        return true;
      },
      child: MaterialApp(
        home: Scaffold(
          body: BlocConsumer<CaptureFileBloc, CaptureFileState>(
            listener: (context, state) {},
            builder: (context, state) {
              print('State in player sis ${state}');

              if ((state is CamaraInitialisedSuccess)) {
                return Chewie(
                  controller: context.read<CaptureFileBloc>().chewieController,
                );
              } else if (state is CamaInitialisationOnProgress) {
                return Center(child: CircularProgressIndicator());
              }
              return SizedBox();
            },
          ),
        ),
      ),
    );
  }

  @override
  void dispose() {
    siteGalleryBloc?.clearRecordingController();

    super.dispose();
  }

  @override
  void didChangeDependencies() {
    siteGalleryBloc = context.read<CaptureFileBloc>();
    super.didChangeDependencies();
  }
}
