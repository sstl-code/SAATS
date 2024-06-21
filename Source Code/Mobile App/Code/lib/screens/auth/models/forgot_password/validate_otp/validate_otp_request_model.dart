class ValidateOtpRequestModel {
  String email;
  String otp;

  ValidateOtpRequestModel({required this.email, required this.otp});

  factory ValidateOtpRequestModel.fromJson(Map<String, dynamic> json) =>
      ValidateOtpRequestModel(email: json['email'], otp: json['otp']);

  Map<String, dynamic> toJson() => {
        'email': email,
        'otp': otp,
      };
}
