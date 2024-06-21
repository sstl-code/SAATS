import 'app_metadatum.dart';

class Data {
	List<AppMetadatum>? appMetadata;

	Data({this.appMetadata});

	factory Data.fromJson(Map<String, dynamic> json) {
		return Data(
			appMetadata: (json['app_metadata'] as List<dynamic>?)
						?.map((e) => AppMetadatum.fromJson(e as Map<String, dynamic>))
						.toList(),
		);
	}



	Map<String, dynamic> toJson() {
		return {
			'app_metadata': appMetadata?.map((e) => e.toJson()).toList(),		};
	}
}
