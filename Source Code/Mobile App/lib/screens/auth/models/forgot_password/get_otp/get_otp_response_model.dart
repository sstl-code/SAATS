class GetOtpResponseModel {
  String? message;
  int? status;

  GetOtpResponseModel({this.message, this.status});

  factory GetOtpResponseModel.fromJson(Map<String, dynamic> json) {
    return GetOtpResponseModel(
      message: json['message'] as String?,
      status: json['status'] as int?,
    );
  }

  Map<String, dynamic> toJson() => {
        'message': message,
        'status': status,
      };
}
