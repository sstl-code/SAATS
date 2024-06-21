import 'package:ats_system/screens/site_gallery/enums/gallery_type.dart';
import 'package:flutter/material.dart';

class DottedCardWithPlusIcon extends StatelessWidget {
  DottedCardWithPlusIcon({required this.galleryType, required this.onClick});

  final VoidCallback onClick;
  final GalleryType galleryType;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        onClick();
      },
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          Container(
            height: 50,
            width: 50,
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              border: Border.all(width: 2, color: Colors.black54),
            ),
            child: Container(
              height: 50,
              width: 50,
              child: Center(
                child: Icon(
                  Icons.add,
                  size: 36,
                  color: Colors.black54,
                ),
              ),
            ),
          ),
          SizedBox(
            height: 7,
          ),
          Flexible(
            child: Text(
              maxLines: 1,
              overflow: TextOverflow.ellipsis,
              'add ${galleryType.value.toLowerCase()}',
            ),
          ),
        ],
      ),
    );
  }
}
