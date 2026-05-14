import 'dart:async';
import 'dart:convert';
import 'dart:developer';
import 'dart:io';

import 'package:ats_system/core/session_manager/session_manager.dart';
import 'package:ats_system/main.dart';
import 'package:ats_system/repository/internet_connection_service.dart';
import 'package:ats_system/repository/navigation_service.dart';
import 'package:ats_system/screens/site_gallery/bloc/site_gallery_bloc.dart';
import 'package:ats_system/screens/site_gallery/bloc/site_gallery_event.dart';
import 'package:ats_system/screens/site_gallery/bloc/site_gallery_state.dart';
import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:ats_system/screens/site_gallery/models/gallery_model.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_request_model.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_response_model/get_gallery_response_model.dart';
import 'package:ats_system/screens/site_gallery/models/get_gallery_response_model/media.dart';
import 'package:ats_system/screens/site_gallery/presentation/gallery_upload_dialog.dart';
import 'package:ats_system/screens/site_gallery/presentation/image_viewer.dart';
import 'package:ats_system/screens/site_gallery/presentation/video_player.dart';
import 'package:ats_system/utils/common_methods.dart';
import 'package:ats_system/utils/constants.dart';
import 'package:ats_system/utils/snack_bar.dart';
import 'package:ats_system/utils/urls.dart';
import 'package:ats_system/widgets/custom_dialog_box.dart';
import 'package:background_downloader/background_downloader.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:dynamic_height_grid_view/dynamic_height_grid_view.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:get_it/get_it.dart';
import 'package:hive_flutter/adapters.dart';
import 'package:path/path.dart' as path;
import 'package:path_provider/path_provider.dart';

class SiteGalleryScreen extends StatefulWidget {
  static const String routeName = '/siteGallery';
  final int siteId;

  const SiteGalleryScreen({super.key, required this.siteId});

  @override
  State<SiteGalleryScreen> createState() => _SiteGalleryScreenState();
}

class _SiteGalleryScreenState extends State<SiteGalleryScreen> {
  TaskStatus? downloadTaskStatus;
  StreamController<TaskProgressUpdate>? progressUpdateStream =
      StreamController<TaskProgressUpdate>.broadcast();
  int totalFilesToUpload = 0;
  int completedFiles = 0;
  @override
  void dispose() {
    super.dispose();
    progressUpdateStream?.close();
    FileDownloader().resetUpdates();
  }

  @override
  void initState() {
    context.read<SiteGalleryBloc>().add(
      SiteGalleryEvent.getGallery(
        GetGalleryRequestModel(siteId: widget.siteId),
      ),
    );
    super.initState();

    setFileUploadListener();
  }

  setFileUploadListener() {
    FileDownloader()
        .configure(
          globalConfig: [(Config.requestTimeout, const Duration(seconds: 100))],
          androidConfig: [(Config.useCacheDir, Config.whenAble)],
          iOSConfig: [
            (Config.localize, {'Cancel': 'StopIt'}),
          ],
        )
        .then((result) => debugPrint('Configuration result = $result'));

    FileDownloader()
        .registerCallbacks(
          taskNotificationTapCallback: myNotificationTapCallback,
        )
        .configureNotificationForGroup(
          FileDownloader.defaultGroup,
          running: const TaskNotification(
            'Download {filename}',
            'File: {filename} - {progress} - speed {networkSpeed} and {timeRemaining} remaining',
          ),
          complete: const TaskNotification(
            '{displayName} download {filename}',
            'Download complete',
          ),
          error: const TaskNotification(
            'Download {filename}',
            'Download failed',
          ),
          paused: const TaskNotification(
            'Download {filename}',
            'Paused with metadata {metadata}',
          ),
          progressBar: true,
        )
        .configureNotification(
          complete: const TaskNotification(
            'Download {filename}',
            'Download complete',
          ),
          tapOpensFile: true,
        );

    FileDownloader().updates.listen((update) {
      switch (update) {
        case TaskStatusUpdate _:
          if (update.status == TaskStatus.complete) {
            debugPrint('---------------- RESPONSE START ----------------');
            debugPrint('SiteGallery: Task Status: ${update.status}');
            debugPrint('SiteGallery: Task ID: ${update.task.taskId}');
            
            final responseBody = update.responseBody;
            if (responseBody != null) {
              try {
                final decoded = json.decode(responseBody);
                final prettyJson = JsonEncoder.withIndent('  ').convert(decoded);
                debugPrint('SiteGallery: Response Body (JSON):\n$prettyJson');
              } catch (e) {
                debugPrint('SiteGallery: Response Body (Raw): $responseBody');
              }
            } else {
              debugPrint('SiteGallery: Response Body: [Empty]');
            }
            debugPrint('---------------- RESPONSE END ------------------');
          }

          context.read<SiteGalleryBloc>().add(
            SiteGalleryEvent.getGallery(
              GetGalleryRequestModel(siteId: widget.siteId),
            ),
          );

          if (update.status == TaskStatus.canceled ||
              update.status == TaskStatus.complete ||
              update.status == TaskStatus.failed) {
            completedFiles++;
            if (update.status == TaskStatus.failed) {
              debugPrint('---------------- FAILURE START ----------------');
              debugPrint('SiteGallery: Task FAILED: ${update.task.taskId}');
              debugPrint('SiteGallery: Exception: ${update.exception}');
              if (update.responseBody != null) {
                debugPrint('SiteGallery: Failure Response Body: ${update.responseBody}');
              }
              debugPrint('---------------- FAILURE END ------------------');
            }

            if (completedFiles == totalFilesToUpload) {
              completedFiles = 0;
              context.read<SiteGalleryBloc>().add(
                SiteGalleryEvent.getGallery(
                  GetGalleryRequestModel(siteId: widget.siteId),
                ),
              );
            }

            if (update.status == TaskStatus.complete) {
              deleteFiles(update.task.filename);
            }
          }

        case TaskProgressUpdate _:
          progressUpdateStream?.add(update);
        default:
      }
    });
  }

  void deleteFiles(String filename) async {
    List<dynamic> filePathsToDelete = json.decode(filename);

    Directory cacheDir = await getTemporaryDirectory();

    final int indexToDelete = locator
        .get<Box<GalleryModel>>()
        .values
        .toList()
        .indexWhere((element) {
          return '${element.filePath}' ==
              '${cacheDir.path}/${filePathsToDelete.first}';
        });
    if (indexToDelete >= 0) {
      locator.get<Box<GalleryModel>>().deleteAt(indexToDelete);
    }

    filePathsToDelete.forEach((element) {
      var file = File('${cacheDir.path}/${filePathsToDelete.first}');
      if (file.existsSync()) {
        file.deleteSync();
        log('File deleted successfully.');
      } else {
        log('File not found. Unable to delete.');
      }
    });
  }

  void myNotificationTapCallback(Task task, NotificationType notificationType) {
    debugPrint(
      'Tapped notification $notificationType for taskId ${task.taskId}',
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Site Gallery')),
      floatingActionButton: SizedBox(
        width: 60.0,
        height: 60.0,
        child: FloatingActionButton(
          onPressed: () {
            CustomDialogBox.appDialog(
              context,
              CustomDialog(
                setStandardPadding: false,
                title: uploadPhotoOrVideo,
                body: GalleryUploadDialogWidget(siteId: widget.siteId),
                footer: ValueListenableBuilder<Box<GalleryModel>>(
                  valueListenable: locator
                      .get<Box<GalleryModel>>()
                      .listenable(),
                  builder: (context, box, child) {
                    return Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      crossAxisAlignment: CrossAxisAlignment.center,
                      children: [
                        ElevatedButton(
                          onPressed: () {
                            Navigator.pop(context);
                          },
                          child: Text('Cancel'),
                        ),
                        SizedBox(width: 30),
                        ElevatedButton(
                          onPressed: (box.values.toList().isNotEmpty == true)
                              ? () {
                                  Navigator.pop(context);
                                  upload();
                                }
                              : null,
                          child: Text('Upload'),
                        ),
                      ],
                    );
                  },
                ),
              ),
            );
          },
          child: Icon(Icons.add),
        ),
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.endFloat,
      body: BlocBuilder<SiteGalleryBloc, SiteGalleryState>(
        builder: (context, state) {
          if ((state is Loading)) {
            return Center(child: CircularProgressIndicator());
          } else if ((state is Success) &&
              state.data is GetGalleryResponseModel) {
            GetGalleryResponseModel response = state.data;
            List<Media>? photosList = response.data
                ?.where((item) => item.mediaType == GalleryType.photo.value)
                .toList();

            List<Media>? videosList = response.data
                ?.where((item) => item.mediaType == GalleryType.video.value)
                .toList();

            if (response.data == null || response.data!.isEmpty) {
              return Center(
                child: Text(
                  'No files found!',
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.w400),
                ),
              );
            }
            return SingleChildScrollView(
              child: Padding(
                padding: const EdgeInsets.all(8.0),
                child: Column(
                  children: [
                    if (photosList != null && photosList.isNotEmpty)
                      buildGridViewWithTitle(
                        GalleryType.photo.value,
                        photosList,
                      ),
                    SizedBox(height: 20),
                    if (videosList != null && videosList.isNotEmpty)
                      buildGridViewWithTitle(
                        GalleryType.video.value,
                        videosList,
                      ),
                  ],
                ),
              ),
            );
          } else if ((state is Error)) {
            return Center(child: Text(state.error.error));
          } else if ((state is NoInternet)) {
            return Center(child: Text(state.message));
          }
          return Container();
        },
      ),
      bottomSheet: DownloadProgressIndicator(
        progressUpdateStream!.stream,
        showPauseButton: false,
        showCancelButton: true,
        backgroundColor: Colors.white,
        maxExpandable: 8,
      ),
    );
  }

  Widget buildGridViewWithTitle(String title, List<Media>? mediaList) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Padding(
          padding: const EdgeInsets.all(8.0),
          child: Text(
            '${title}s',
            style: TextStyle(fontSize: 18.0, fontWeight: FontWeight.bold),
          ),
        ),
        DynamicHeightGridView(
          shrinkWrap: true,
          crossAxisCount: 3,
          physics: NeverScrollableScrollPhysics(),
          itemCount: mediaList!.length,
          builder: (context, index) {
            final bean = mediaList.elementAt(index);
            if (bean != null) {
              return (bean.mediaType == GalleryType.photo.value)
                  ? Container(
                      height: 150,
                      child: GestureDetector(
                        onTap: () {
                          Navigator.pushNamed(
                            context,
                            ImageViewer.routeName,
                            arguments: {
                              'mediaList': mediaList,
                              'initialIndex': index,
                            },
                          );
                        },
                        child: ClipRRect(
                          borderRadius: BorderRadius.circular(10.0),
                          child: (bean.fileUrl != null)
                              ? CachedNetworkImage(
                                  imageUrl: bean.fileUrl!,
                                  fit: BoxFit.cover,
                                  placeholder: (context, url) => Center(
                                    child: SizedBox(
                                      width: 40.0,
                                      height: 40.0,
                                      child: new CircularProgressIndicator(),
                                    ),
                                  ),
                                  errorWidget: (context, url, error) {
                                    debugPrint(
                                      'SiteGallery: Failed to load image from $url. Error: $error',
                                    );
                                    return Icon(Icons.error);
                                  },
                                )
                              : Image.asset(
                                  'assets/images/no_image.png',
                                  fit: BoxFit.cover,
                                ),
                        ),
                      ),
                    )
                  : Container(
                      height: 150,
                      child: GestureDetector(
                        onTap: () {
                          Navigator.pushNamed(
                            context,
                            VideoPlayerScreen.routeName,
                            arguments: bean.fileUrl,
                          );
                        },
                        child: ClipRRect(
                          borderRadius: BorderRadius.circular(10.0),
                          child: (bean.thumbImage != null)
                              ? Stack(
                                  alignment: Alignment.center,
                                  children: [
                                    CachedNetworkImage(
                                      imageUrl: bean.thumbImage!,
                                      fit: BoxFit.cover,
                                      placeholder: (context, url) => Center(
                                        child: SizedBox(
                                          width: 40.0,
                                          height: 40.0,
                                          child:
                                              new CircularProgressIndicator(),
                                        ),
                                      ),
                                      errorWidget: (context, url, error) =>
                                          Icon(Icons.error),
                                    ),
                                    Center(
                                      child: Icon(
                                        Icons.play_circle_fill,
                                        size: 50,
                                        color: Colors.white,
                                      ),
                                    ),
                                  ],
                                )
                              : Image.asset(
                                  'assets/images/no_image.png',
                                  fit: BoxFit.cover,
                                ),
                        ),
                      ),
                    );
            } else {
              return ClipRRect(
                borderRadius: BorderRadius.circular(10.0),
                child: Image.asset(
                  'assets/images/no_image.png',
                  fit: BoxFit.cover,
                ),
              );
            }
          },
        ),
      ],
    );
  }

  Future<void> upload() async {
    debugPrint('SiteGallery: upload() triggered');
    if (!await InternetConnectionImpl().isInternetConnected()) {
      debugPrint('SiteGallery: No internet connection');
      var context = GetIt.I<NavigationService>().getContext();
      if (context.mounted) {
        context.showSnackBar(checkInternetConnection);
        return;
      }
    }

    debugPrint('SiteGallery: Checking auth key expiry');
    await CommonMethods.isAuthKeyExpired();
    debugPrint('SiteGallery: Auth key check completed');

    final List<GalleryModel> galleryList = locator
        .get<Box<GalleryModel>>()
        .values
        .toList();
    
    totalFilesToUpload = galleryList.length;
    debugPrint('SiteGallery: Total files to upload: $totalFilesToUpload');

    if (totalFilesToUpload == 0) {
      debugPrint('SiteGallery: No files found in the box to upload!');
    }

    galleryList.forEach((gallery) async {
      final uploadUrl = Urls.uploadSiteMedia;
      final mediaType = gallery.galleryType?.value;
      final header = {
        "Authorization": locator.get<SessionManager>().getToken(),
        'content-type': 'application/json',
      };
      
      debugPrint('---------------- REQUEST START ----------------');
      debugPrint('SiteGallery: URL: $uploadUrl');
      debugPrint('SiteGallery: Headers: $header');
      debugPrint('SiteGallery: Fields: site_id: ${widget.siteId}, media_type: $mediaType');

      List<dynamic> files;
      if (gallery.galleryType == GalleryType.video) {
        files = [
          ('file', '${path.basename(gallery.filePath!)}'),
          ('thumb_file', '${path.basename(gallery.thumbnailPath!)}'),
        ];
        debugPrint('SiteGallery: Files (Video + Thumb): ${files.map((e) => e.$2).toList()}');
      } else {
        files = [('file', '${path.basename(gallery.filePath!)}')];
        debugPrint('SiteGallery: Files (Photo): ${files.map((e) => e.$2).toList()}');
      }

      final task = MultiUploadTask(
        files: files,
        baseDirectory: BaseDirectory.temporary,
        url: uploadUrl,
        headers: header,
        fields: {
          'site_id': '${widget.siteId}',
          'media_type': '$mediaType',
        },
        updates: Updates.statusAndProgress,
      );

      try {
        await FileDownloader().enqueue(task);
        debugPrint('SiteGallery: Task Enqueued ID: ${task.taskId}');
      } catch (e) {
        debugPrint('SiteGallery: Error enqueuing task: $e');
      }
      debugPrint('---------------- REQUEST END ------------------');
      await Future.delayed(const Duration(milliseconds: 100));
    });
  }
}
