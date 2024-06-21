import 'dart:io';

import 'package:ats_system/main.dart';
import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:ats_system/screens/site_gallery/models/gallery_model.dart';
import 'package:ats_system/screens/site_gallery/presentation/capture_photo_or_video.dart';
import 'package:ats_system/screens/site_gallery/widgets/add_gallery_card.dart';
import 'package:flutter/material.dart';
import 'package:hive_flutter/adapters.dart';

class GalleryUploadDialogWidget extends StatefulWidget {
  final int siteId;

  const GalleryUploadDialogWidget({super.key, required this.siteId});

  @override
  State<GalleryUploadDialogWidget> createState() =>
      _GalleryUploadDialogWidgetState();
}

class _GalleryUploadDialogWidgetState extends State<GalleryUploadDialogWidget> {
  @override
  Widget build(BuildContext context) {
    return ValueListenableBuilder<Box<GalleryModel>>(
      builder: (context, box, child) {
        final List<GalleryModel> galleryList = box.values.toList();
        final photosList = galleryList
            .where((item) => item.galleryType == GalleryType.photo)
            .toList();
        final videosList = galleryList
            .where((item) => item.galleryType == GalleryType.video)
            .toList();

        return ListView(
          shrinkWrap: true,
          physics: BouncingScrollPhysics(),
          children: [
            SizedBox(
              height: 10,
            ),
            GallerySectionWidget(
                galleryList: photosList,
                siteId: widget.siteId,
                galleryType: GalleryType.photo),
            SizedBox(
              height: 10,
            ),
            GallerySectionWidget(
                galleryList: videosList,
                siteId: widget.siteId,
                galleryType: GalleryType.video),
          ],
        );
      },
      valueListenable: locator.get<Box<GalleryModel>>().listenable(),
    );
  }
}

class GallerySectionWidget extends StatelessWidget {
  const GallerySectionWidget(
      {super.key,
      required this.galleryList,
      required this.siteId,
      required this.galleryType});
  final List<GalleryModel> galleryList;
  final int siteId;
  final GalleryType galleryType;

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Text(
          'Add ${galleryType.value}s',
          style: TextStyle(fontSize: 17, fontWeight: FontWeight.w600),
        ),
        SizedBox(
          height: 10,
        ),
        GridView.builder(
          shrinkWrap: true,
          physics: BouncingScrollPhysics(),
          gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
            crossAxisCount: 3,
          ),
          itemCount: galleryList.length + 1,
          itemBuilder: (context, index) {
            return GalleryRowWidget(
                galleryList: galleryList,
                index: index,
                galleryType: galleryType,
                siteId: siteId);
          },
        ),
        SizedBox(
          height: 10,
        ),
      ],
    );
  }
}

class GalleryRowWidget extends StatefulWidget {
  const GalleryRowWidget(
      {super.key,
      required this.galleryList,
      required this.index,
      required this.galleryType,
      required this.siteId});
  final List<GalleryModel> galleryList;
  final int index;
  final GalleryType galleryType;
  final int siteId;
  @override
  State<GalleryRowWidget> createState() => _GalleryRowWidgetState();
}

class _GalleryRowWidgetState extends State<GalleryRowWidget> {
  @override
  Widget build(BuildContext context) {
    if (widget.index == widget.galleryList.length) {
      return DottedCardWithPlusIcon(
        galleryType: widget.galleryType,
        onClick: () async {
          Navigator.pushNamed(context, CameraScreen.routeName, arguments: {
            'galleryType': widget.galleryType,
            'siteId': widget.siteId
          });
        },
      );
    } else {
      var bean = widget.galleryList[widget.index];

      File file = File((widget.galleryType == GalleryType.photo)
          ? bean.filePath!
          : bean.thumbnailPath!);

      return Column(
        mainAxisAlignment: MainAxisAlignment.center,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          Stack(
            children: [
              Padding(
                padding: const EdgeInsets.only(top: 5.0, right: 5.0),
                child: ClipRRect(
                    borderRadius: BorderRadius.circular(10.0),
                    child: (file.existsSync())
                        ? Image.file(
                            File((widget.galleryType == GalleryType.photo)
                                ? bean.filePath!
                                : bean.thumbnailPath!),
                            height: 70,
                            width: 70,
                            fit: BoxFit.cover,
                          )
                        : Image.asset(
                            height: 70,
                            width: 70,
                            'assets/images/no_image.png',
                            fit: BoxFit.cover,
                          )),
              ),
              Positioned(
                top: 0.0,
                right: 0.0,
                child: GestureDetector(
                  onTap: () async {
                    await bean.delete();
                  },
                  child: Container(
                    decoration: BoxDecoration(
                      shape: BoxShape.circle,
                      color: Colors.red,
                    ),
                    child: Icon(
                      Icons.cancel,
                      size: 18.0,
                      color: Colors.white,
                    ),
                  ),
                ),
              ),
            ],
          ),
          Flexible(
            child: Align(
              alignment: Alignment.center,
              child: Text(
                bean.description ?? 'N/A',
                maxLines: 1,
                overflow: TextOverflow.ellipsis,
              ),
            ),
          ),
        ],
      );
    }
  }
}

class PreviewAndSetNameWidget extends StatefulWidget {
  const PreviewAndSetNameWidget(
      {super.key, required this.onTextChanged, required this.imageFilePath});

  final ValueChanged<String> onTextChanged;
  final String imageFilePath;

  @override
  State<PreviewAndSetNameWidget> createState() =>
      _PreviewAndSetNameWidgetState();
}

class _PreviewAndSetNameWidgetState extends State<PreviewAndSetNameWidget> {
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    final height = MediaQuery.of(context).size.height;

    return ListView(
      shrinkWrap: true,
      physics: BouncingScrollPhysics(),
      children: [
        Container(
            constraints: BoxConstraints(maxHeight: height * 0.4),
            child: ClipRRect(
                borderRadius: BorderRadius.circular(10.0),
                child:
                    Image.file(File(widget.imageFilePath), fit: BoxFit.fill))),
        SizedBox(
          height: 20,
        ),
        TextFormField(
          autovalidateMode: AutovalidateMode.onUserInteraction,
          validator: (val) {
            if (val!.isNotEmpty) {
              return null;
            } else {
              return 'Please enter description';
            }
          },
          onChanged: widget.onTextChanged,
          decoration: InputDecoration(
            contentPadding: EdgeInsets.all(16.0),
            border: OutlineInputBorder(
              borderRadius: BorderRadius.circular(8.0),
            ),
            hintText: 'Image Description',
            label: Text('Description'),
          ),
        ),
        SizedBox(height: 10.0),
      ],
    );
  }
}
