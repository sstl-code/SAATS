import 'data.dart';

class CommonMetaData {
	int? status;
	Data? data;
	String? message;

	CommonMetaData({this.status, this.data, this.message});

	factory CommonMetaData.fromJson(Map<String, dynamic> json) {
		return CommonMetaData(
			status: json['status'] as int?,
			data: json['data'] == null
						? null
						: Data.fromJson(json['data'] as Map<String, dynamic>),
			message: json['message'] as String?,
		);
	}



	Map<String, dynamic> toJson() {
		return {
			'status': status,
			'data': data?.toJson(),
			'message': message,		};
	}
}
