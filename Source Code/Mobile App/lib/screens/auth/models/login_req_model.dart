class LoginReqModel {
  LoginReqModel({
    required this.email,
    required this.password,
  });

  String email;
  String password;

  factory LoginReqModel.fromJson(Map<String, dynamic> json) => LoginReqModel(
        email: json["email"],
        password: json["password"],
      );

  Map<String, dynamic> toJson() => {
        "email": email,
        "password": password,
      };

  @override
  String toString() {
    return 'LoginReqModel{email: $email, password: $password}';
  }
}
