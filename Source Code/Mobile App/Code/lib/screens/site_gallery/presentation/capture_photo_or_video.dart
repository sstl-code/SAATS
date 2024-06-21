import 'dart:async';

import 'package:ats_system/main.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_bloc.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_event.dart';
import 'package:ats_system/screens/site_gallery/bloc/capture_file_state.dart';
import 'package:ats_system/screens/site_gallery/data_source/gallery_manager.dart';
import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:ats_system/screens/site_gallery/models/gallery_model.dart';
import 'package:ats_system/screens/site_gallery/models/init_camera_controller_event.dart';
import 'package:ats_system/screens/site_gallery/models/reset_event.dart';
import 'package:ats_system/screens/site_gallery/presentation/gallery_upload_dialog.dart';
import 'package:ats_system/screens/site_gallery/utils/generate_thumbnail_from_video.dart';
import 'package:ats_system/screens/site_gallery/widgets/recording_widget.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/toast_message.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:camera/camera.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

class CameraScreen extends StatefulWidget {
  final GalleryType galleryType;
  final int siteId;

  const CameraScreen(
      {Key? key, required this.galleryType, required this.siteId})
      : super(key: key);

  static const String routeName = '/camera';

  @override
  _CameraScreenState createState() => _CameraScreenState();
}

class _CameraScreenState extends State<CameraScreen> {
  CaptureFileBloc? siteGalleryBloc;
  late XFile _videoFile;
  bool _isRecording = false;

  @override
  void initState() {
    super.initState();
    context.read<CaptureFileBloc>().add(CaptureFileEvent.initCameraController(
        InitCameraControllerEvent(siteGalleryType: widget.galleryType)));
  }

  Future<void> _startRecording() async {
    try {
      await context.read<CaptureFileBloc>().controller!.startVideoRecording();

      setState(() {
        _isRecording = true;
      });
      Timer(Duration(minutes: 5), () async {
        await _stopRecording();
      });
    } catch (e) {
      print(e);
    }
  }

  Future<void> _stopRecording() async {
    if (context.read<CaptureFileBloc>().controller!.value.isRecordingVideo) {
      _videoFile = await context
          .read<CaptureFileBloc>()
          .controller!
          .stopVideoRecording();

      setState(() {
        _isRecording = false;
      });
      String thumbnailPath = await generateThumbnail(_videoFile.path);
      sendCapturedDataToParent(
          thumbnailPath: thumbnailPath, filePath: _videoFile.path);
    }
  }

  Future<void> _takePicture() async {
    try {
      final XFile imageFile =
          await context.read<CaptureFileBloc>().controller!.takePicture();
      print('Picture captured ${imageFile.path}');
      sendCapturedDataToParent(filePath: imageFile.path);
    } catch (e) {
      print(e);
    }
  }

  sendCapturedDataToParent({required String filePath, String? thumbnailPath}) {
    context.read<CaptureFileBloc>().controller!.pausePreview();
    String? description;

    void handleTextFieldChange(String value) {
      description = value;
    }

    CustomDialogBox.appDialog(
        context,
        CustomDialog(
          title: 'Add description',
          body: PreviewAndSetNameWidget(
            onTextChanged: handleTextFieldChange,
            imageFilePath: (widget.galleryType == GalleryType.photo)
                ? filePath
                : thumbnailPath!,
          ),
          footer: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              ElevatedButton(
                onPressed: () {
                  Navigator.pop(context);
                  context.read<CaptureFileBloc>().controller!.resumePreview();
                },
                child: Text('Retake'),
              ),
              SizedBox(
                width: 30,
              ),
              ElevatedButton(
                onPressed: () {
                  if (description == null || description?.isEmpty == true) {
                    ToastMessage.showMessage(
                        pleaseEnterDescription, kToastErrorColor);
                  } else {
                    context
                        .read<CaptureFileBloc>()
                        .add(CaptureFileEvent.resetEvent(ResetEvent()));
                    final GalleryManager dataSource = locator
                        .get<GalleryManager>(instanceName: 'local-gallery');
                    dataSource.add(GalleryModel(
                        galleryType: widget.galleryType,
                        filePath: filePath,
                        thumbnailPath: thumbnailPath,
                        description: description,
                        siteId: widget.siteId));
                    Navigator.pop(context);
                    Navigator.pop(context);
                  }
                },
                child: Text('Add'),
              ),
            ],
          ),
        ));
  }

  @override
  void dispose() {
    siteGalleryBloc?.controller!.dispose();
    super.dispose();
  }

  @override
  void didChangeDependencies() {
    siteGalleryBloc = context.read<CaptureFileBloc>();
    super.didChangeDependencies();
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
      child: Scaffold(
        appBar: AppBar(
            title: Text((widget.galleryType == GalleryType.photo)
                ? 'Capture Photo'
                : 'Record Video')),
        body: BlocConsumer<CaptureFileBloc, CaptureFileState>(
          listener: (context, state) {},
          builder: (context, state) {
            if ((state is CamaraInitialisedSuccess)) {
              if (state.data is CameraController) {
                CameraController cameraController = state.data;
                final scale = 1 /
                    (cameraController.value.aspectRatio *
                        MediaQuery.of(context).size.aspectRatio);

                return Stack(
                  children: [
                    Transform.scale(
                      scale: scale,
                      alignment: Alignment.topCenter,
                      child: CameraPreview(cameraController),
                    ),
                    if (_isRecording)
                      Positioned(
                        top: 16.0,
                        right: 16.0,
                        child: Container(
                          padding: EdgeInsets.all(8.0),
                          child: BlinkingRecordingCircle(),
                        ),
                      ),
                    Container(
                      alignment: Alignment.bottomCenter,
                      padding: EdgeInsets.all(8.0),
                      child: (widget.galleryType == GalleryType.video)
                          ? Row(
                              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                              children: [
                                Opacity(
                                  opacity: _isRecording ? 0.7 : 1.0,
                                  child: ElevatedButton(
                                    onPressed: _startRecording,
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: _isRecording
                                          ? Colors.grey
                                          : Colors.blue,
                                    ),
                                    child: Icon(Icons.videocam),
                                  ),
                                ),
                                Opacity(
                                  opacity: _isRecording ? 1.0 : 0.7,
                                  child: ElevatedButton(
                                    style: ElevatedButton.styleFrom(
                                      backgroundColor: _isRecording
                                          ? Colors.blue
                                          : Colors.grey,
                                    ),
                                    onPressed: _stopRecording,
                                    child: Icon(Icons.stop),
                                  ),
                                ),
                              ],
                            )
                          : Row(
                              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                              children: [
                                ElevatedButton(
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Colors.blue,
                                  ),
                                  onPressed: _takePicture,
                                  child: Icon(Icons.camera_alt),
                                ),
                              ],
                            ),
                    )
                  ],
                );
              }
            } else if (state is CamaInitialisationOnProgress) {
              return Center(child: CircularProgressIndicator());
            }
            return Text('Something went wrong');
          },
        ),
      ),
    );
  }
}
