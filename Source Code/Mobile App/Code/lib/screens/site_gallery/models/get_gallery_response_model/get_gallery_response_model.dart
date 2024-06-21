import 'media.dart';

class GetGalleryResponseModel {
  int? status;
  String? message;
  List<Media>? data;

  GetGalleryResponseModel({this.status, this.message, this.data});

  factory GetGalleryResponseModel.fromJson(Map<String, dynamic> json) {
    return GetGalleryResponseModel(
      status: json['status'] as int?,
      message: json['message'] as String?,
      data: (json['data'] as List<dynamic>?)
          ?.map((e) => Media.fromJson(e as Map<String, dynamic>))
          .toList(),
    );
  }

  Map<String, dynamic> tojson() {
    return {
      'status': status,
      'message': message,
      'data': data?.map((e) => e.toJson()).toList(),
    };
  }
}
