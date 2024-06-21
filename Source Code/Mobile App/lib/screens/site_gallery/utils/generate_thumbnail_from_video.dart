import 'dart:io';

import 'package:path_provider/path_provider.dart';
import 'package:video_thumbnail/video_thumbnail.dart';

Future<String> generateThumbnail(String videoPath) async {
  Directory tempDir = await getTemporaryDirectory();
  String thumbnailPath =
      '${tempDir.path}/${DateTime.now().millisecondsSinceEpoch}.jpg';

  await VideoThumbnail.thumbnailFile(
    video: videoPath,
    thumbnailPath: thumbnailPath,
    imageFormat: ImageFormat.JPEG,
    maxWidth: 128,
    quality: 25,
  );

  return thumbnailPath;
}
