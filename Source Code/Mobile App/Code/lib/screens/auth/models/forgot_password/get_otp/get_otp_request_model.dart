class GetOtpRequestModel {
  String email;

  GetOtpRequestModel({required this.email});

  factory GetOtpRequestModel.fromJson(Map<String, dynamic> json) =>
      GetOtpRequestModel(email: json['email']);

  Map<String, dynamic> toJson() => {
        'email': email,
      };
}
