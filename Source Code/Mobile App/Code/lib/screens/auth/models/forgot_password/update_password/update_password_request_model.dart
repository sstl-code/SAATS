class UpdatePasswordRequestModel {
  String? email;
  String? newPassword;
  String? confrimpassword;

  UpdatePasswordRequestModel({
    this.email,
    this.newPassword,
    this.confrimpassword,
  });

  factory UpdatePasswordRequestModel.fromJson(Map<String, dynamic> json) {
    return UpdatePasswordRequestModel(
      email: json['email'] as String?,
      newPassword: json['newPassword'] as String?,
      confrimpassword: json['confrimpassword'] as String?,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'email': email,
      'newPassword': newPassword,
      'confrimpassword': confrimpassword,
    };
  }
}
