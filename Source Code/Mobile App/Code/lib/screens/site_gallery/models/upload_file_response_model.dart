class UploadFileResponseModel {
  int? status;
  String? message;

  UploadFileResponseModel({this.status, this.message});

  factory UploadFileResponseModel.fromJson(Map<String, dynamic> json) {
    return UploadFileResponseModel(
      status: json['status'] as int?,
      message: json['message'] as String?,
    );
  }

  Map<String, dynamic> toJson() => {
        'status': status,
        'message': message,
      };
}
