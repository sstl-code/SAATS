class UpdatePasswordResponseModel {
  int? status;
  String? message;
  List<dynamic>? data;

  UpdatePasswordResponseModel({this.status, this.message, this.data});

  factory UpdatePasswordResponseModel.fromJson(Map<String, dynamic> json) {
    return UpdatePasswordResponseModel(
      status: json['status'] as int?,
      message: json['message'] as String?,
      data: json['data'] as List<dynamic>?,
    );
  }

  Map<String, dynamic> toJson() => {
        'status': status,
        'message': message,
        'data': data,
      };
}
