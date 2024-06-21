class Media {
  int? id;
  int? siteId;
  String? mediaType;
  dynamic thumbImage;
  String? fileUrl;
  DateTime? createdAt;
  DateTime? updatedAt;
  dynamic deletedAt;

  Media({
    this.id,
    this.siteId,
    this.mediaType,
    this.thumbImage,
    this.fileUrl,
    this.createdAt,
    this.updatedAt,
    this.deletedAt,
  });

  factory Media.fromJson(Map<String, dynamic> json) {
    return Media(
      id: json['id'] as int?,
      siteId: json['site_id'] as int?,
      mediaType: json['media_type'] as String?,
      thumbImage: json['thumb_image'] as dynamic,
      fileUrl: json['file_url'] as String?,
      createdAt: json['created_at'] == null
          ? null
          : DateTime.parse(json['created_at'] as String),
      updatedAt: json['updated_at'] == null
          ? null
          : DateTime.parse(json['updated_at'] as String),
      deletedAt: json['deleted_at'] as dynamic,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'site_id': siteId,
      'media_type': mediaType,
      'thumb_image': thumbImage,
      'file_url': fileUrl,
      'created_at': createdAt?.toIso8601String(),
      'updated_at': updatedAt?.toIso8601String(),
      'deleted_at': deletedAt,
    };
  }
}
