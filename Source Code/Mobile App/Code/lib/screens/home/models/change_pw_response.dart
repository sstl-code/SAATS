class ChangePwResponse {
  int? status;
  String? message;

  ChangePwResponse({
    this.status,
    this.message,
  });

  factory ChangePwResponse.fromJson(Map<String, dynamic> json) =>
      ChangePwResponse(
        status: json["status"],
        message: json["message"],
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "data": message,
      };
}
