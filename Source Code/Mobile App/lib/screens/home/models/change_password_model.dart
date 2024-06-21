class ChangePasswordModel {
  ChangePasswordModel({
    required this.oldPassword,
    required this.newPassword,
    required this.userId,
  });

  String oldPassword;
  String newPassword;
  int userId;

  factory ChangePasswordModel.fromJson(Map<String, dynamic> json) =>
      ChangePasswordModel(
        oldPassword: json["oldpassword"],
        newPassword: json["password"],
        userId: json["userid"],
      );

  Map<String, dynamic> toJson() => {
        "oldpassword": oldPassword,
        "password": newPassword,
        "userid": userId,
      };
}
