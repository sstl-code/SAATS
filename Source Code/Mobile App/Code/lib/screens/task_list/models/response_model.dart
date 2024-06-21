class ResponseModel {
  int? status;
  String? message;
  int? taAssetId;

  ResponseModel({
    this.status,
    this.message,
    this.taAssetId,
  });

  factory ResponseModel.fromJson(Map<String, dynamic> json) => ResponseModel(
        status: json["status"],
        message: json["message"],
        taAssetId: json["ta_asset_id"],
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "message": message,
        "ta_asset_id": taAssetId,
      };
}
