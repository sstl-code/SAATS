class LoginModel {
  String? status;
  Data data;

  LoginModel({this.status, required this.data});

  Map<String, dynamic> toJson() => {"status": status, "data": data.toJson()};

  LoginModel.errorCheck({required this.status, required this.data});

  factory LoginModel.fromErrorJson(Map<String, dynamic> json) =>
      LoginModel.errorCheck(
          status: json["status"], data: Data.fromJson(json["data"]));

  factory LoginModel.fromJson(Map<String, dynamic> json) => LoginModel(
        status: json["status"],
        data: Data.fromJson(json["data"]),
      );
}

class Data {
  String? tokenType;
  int? expiresIn;
  String? accessToken;
  String? refreshToken;
  User? user;
  String? message;

  Data(
      {this.tokenType,
      this.expiresIn,
      this.accessToken,
      this.refreshToken,
      this.user,
      this.message});

  factory Data.fromJson(Map<String, dynamic> json) => Data(
        tokenType: json["token_type"],
        expiresIn: json["expires_in"],
        accessToken: json["access_token"],
        refreshToken: json["refresh_token"],
        message: json["message"],
        user: json["user"] == null ? null : User.fromJson(json["user"]),
      );

  Map<String, dynamic> toJson() => {
        "token_type": tokenType,
        "expires_in": expiresIn,
        "access_token": accessToken,
        "refresh_token": refreshToken,
        "user": user?.toJson(),
        "message": message,
      };
}

class User {
  int? id;
  String? name;
  String? email;
  dynamic emailVerifiedAt;
  String? createdAt;
  String? updatedAt;
  String? mobileNumber;
  bool? isSupervisor;

  User({
    this.id,
    this.name,
    this.email,
    this.emailVerifiedAt,
    this.createdAt,
    this.updatedAt,
    this.mobileNumber,
    this.isSupervisor,
  });

  factory User.fromJson(Map<String, dynamic> json) => User(
        id: json["id"],
        name: json["name"],
        email: json["email"],
        emailVerifiedAt: json["email_verified_at"],
        createdAt: json["created_at"],
        updatedAt: json["updated_at"],
        isSupervisor: json["is_supervisor"],
        mobileNumber: json["mobile_number"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "name": name,
        "email": email,
        "email_verified_at": emailVerifiedAt,
        "created_at": createdAt,
        "updated_at": updatedAt,
        "is_supervisor": isSupervisor,
        "mobile_number": mobileNumber,
      };
}
