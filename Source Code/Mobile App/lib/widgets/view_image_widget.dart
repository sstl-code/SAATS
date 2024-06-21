import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';

class ImageWidget extends StatelessWidget {
  const ImageWidget({Key? key, required this.image}) : super(key: key);
  final String image;

  @override
  Widget build(BuildContext context) {
    final height = MediaQuery.of(context).size.height;
    return ListView(
      shrinkWrap: true,
      physics: BouncingScrollPhysics(),
      children: [
        Container(
            padding: const EdgeInsets.all(5),
            constraints: BoxConstraints(maxHeight: height * 0.7),
            child: CachedNetworkImage(
              imageUrl: image,
              fit: BoxFit.fill,
              placeholder: (context, url) => Center(
                child: SizedBox(
                  width: 40.0,
                  height: 40.0,
                  child: new CircularProgressIndicator(),
                ),
              ),
              errorWidget: (context, url, error) => Icon(Icons.error),
            )),
      ],
    );
  }
}
