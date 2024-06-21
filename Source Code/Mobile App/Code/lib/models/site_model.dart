class SiteModel {
  int? status;
  List<SiteData> data;

  SiteModel({
    required this.status,
    required this.data,
  });

  factory SiteModel.fromJson(Map<String, dynamic> json) => SiteModel(
        status: json["status"],
        data: json["data"] == null
            ? []
            : List<SiteData>.from(
                json["data"]!.map((x) => SiteData.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "status": status,
        "data": List<dynamic>.from(data.map((x) => x.toJson())),
      };
}

class SiteData {
  int tlLocationId;
  int? tlLocationTypeMasterId;
  String? tlLocationType;
  String? tlLocationCode;
  String? tlLocationAddress;
  dynamic tlLocationDescription;
  dynamic tlLocationStatus;
  dynamic tlLocationRegion;
  String? tlLocationLatitude;
  String? tlLocationLongitude;
  dynamic tlCreationDate;
  dynamic tlCreatedBy;
  dynamic tlEffectiveStartDate;
  dynamic tlLastUpdatedDate;
  dynamic tlLastUpdatedBy;
  dynamic tlEffectiveEndDate;
  String? tlLocationName;
  String? createdAt;
  String? updatedAt;
  dynamic deletedAt;
  String? taggingStatus;
  String? lastAuditDate;

  SiteData({
    required this.tlLocationId,
    this.tlLocationTypeMasterId,
    this.tlLocationType,
    this.tlLocationCode,
    this.tlLocationAddress,
    this.tlLocationDescription,
    this.tlLocationStatus,
    this.tlLocationRegion,
    this.tlLocationLatitude,
    this.tlLocationLongitude,
    this.tlCreationDate,
    this.tlCreatedBy,
    this.tlEffectiveStartDate,
    this.tlLastUpdatedDate,
    this.tlLastUpdatedBy,
    this.tlEffectiveEndDate,
    this.tlLocationName,
    this.createdAt,
    this.updatedAt,
    this.deletedAt,
    this.taggingStatus,
    this.lastAuditDate,
  });

  factory SiteData.fromJson(Map<String, dynamic> json) => SiteData(
        tlLocationId: json["tl_location_id"],
        tlLocationTypeMasterId: json["tl_location_type_master_id"],
        tlLocationType: json["tl_location_type"],
        tlLocationCode: json["tl_location_code"],
        tlLocationAddress: json["tl_location_address"],
        tlLocationDescription: json["tl_location_description"],
        tlLocationStatus: json["tl_location_status"],
        tlLocationRegion: json["tl_location_region"],
        tlLocationLatitude: json["tl_location_latitude"],
        tlLocationLongitude: json["tl_location_longitude"],
        tlCreationDate: json["tl_creation_date"],
        tlCreatedBy: json["tl_created_by"],
        tlEffectiveStartDate: json["tl_effective_start_date"],
        tlLastUpdatedDate: json["tl_last_updated_date"],
        tlLastUpdatedBy: json["tl_last_updated_by"],
        tlEffectiveEndDate: json["tl_effective_end_date"],
        tlLocationName: json["tl_location_name"],
        createdAt: json["created_at"],
        updatedAt: json["updated_at"],
        deletedAt: json["deleted_at"],
        taggingStatus: json["tagging_status"],
        lastAuditDate: json["last_audit_date"],
      );

  Map<String, dynamic> toJson() => {
        "tl_location_id": tlLocationId,
        "tl_location_type_master_id": tlLocationTypeMasterId,
        "tl_location_type": tlLocationType,
        "tl_location_code": tlLocationCode,
        "tl_location_address": tlLocationAddress,
        "tl_location_description": tlLocationDescription,
        "tl_location_status": tlLocationStatus,
        "tl_location_region": tlLocationRegion,
        "tl_location_latitude": tlLocationLatitude,
        "tl_location_longitude": tlLocationLongitude,
        "tl_creation_date": tlCreationDate,
        "tl_created_by": tlCreatedBy,
        "tl_effective_start_date": tlEffectiveStartDate,
        "tl_last_updated_date": tlLastUpdatedDate,
        "tl_last_updated_by": tlLastUpdatedBy,
        "tl_effective_end_date": tlEffectiveEndDate,
        "tl_location_name": tlLocationName,
        "created_at": createdAt,
        "updated_at": updatedAt,
        "deleted_at": deletedAt,
        "tagging_status": taggingStatus,
        "last_audit_date": lastAuditDate,
      };

  @override
  String toString() {
    return 'SiteData{tlLocationId: $tlLocationId, tlLocationTypeMasterId: $tlLocationTypeMasterId, tlLocationType: $tlLocationType, tlLocationCode: $tlLocationCode, tlLocationAddress: $tlLocationAddress, tlLocationDescription: $tlLocationDescription, tlLocationStatus: $tlLocationStatus, tlLocationRegion: $tlLocationRegion, tlLocationLatitude: $tlLocationLatitude, tlLocationLongitude: $tlLocationLongitude, tlCreationDate: $tlCreationDate, tlCreatedBy: $tlCreatedBy, tlEffectiveStartDate: $tlEffectiveStartDate, tlLastUpdatedDate: $tlLastUpdatedDate, tlLastUpdatedBy: $tlLastUpdatedBy, tlEffectiveEndDate: $tlEffectiveEndDate, tlLocationName: $tlLocationName, createdAt: $createdAt, updatedAt: $updatedAt, deletedAt: $deletedAt, taggingStatus: $taggingStatus, lastAuditDate: $lastAuditDate,}';
  }
}
