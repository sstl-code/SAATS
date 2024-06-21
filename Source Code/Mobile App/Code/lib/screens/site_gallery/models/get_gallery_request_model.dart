class GetGalleryRequestModel {
  int? siteId;

  GetGalleryRequestModel({
    this.siteId,
  });

  factory GetGalleryRequestModel.fromJson(Map<String, dynamic> json) {
    return GetGalleryRequestModel(siteId: json['site_id'] as int?);
  }

  Map<String, dynamic> toJson() => {
        'site_id': siteId,
      };
}
