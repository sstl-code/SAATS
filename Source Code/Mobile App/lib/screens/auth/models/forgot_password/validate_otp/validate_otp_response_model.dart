class ValidateOtpResponseModel {
  String? message;
  int? status;

  ValidateOtpResponseModel({this.message, this.status});

  factory ValidateOtpResponseModel.fromJson(Map<String, dynamic> json) {
    return ValidateOtpResponseModel(
      message: json['message'] as String?,
      status: json['status'] as int?,
    );
  }

  Map<String, dynamic> tojson() => {
        'message': message,
        'status': status,
      };
}
