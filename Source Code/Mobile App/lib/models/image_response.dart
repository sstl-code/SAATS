class ImageResponse {
  int status;
  String? message;
  ImageResponse({required this.status, this.message});

  factory ImageResponse.fromJson(Map<String, dynamic> json) =>
      ImageResponse(status: json['status'], message: json['message']);

  Map<String, dynamic> toJson() => {'status': status, 'message': message};
}
