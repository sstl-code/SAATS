class SubmitRequestModel {
  String userTaskId;
  String? stnRemarks;
  String? srnRemarks;

  SubmitRequestModel.stn(
      {required this.userTaskId, this.srnRemarks, this.stnRemarks});

  SubmitRequestModel.srn(
      {required this.userTaskId, this.srnRemarks, this.stnRemarks});

  factory SubmitRequestModel.fromSTNJson(Map<String, dynamic> json) =>
      SubmitRequestModel.stn(
          userTaskId: json['user_task_id'], stnRemarks: json['stn_remarks']);

  factory SubmitRequestModel.fromSRNJson(Map<String, dynamic> json) =>
      SubmitRequestModel.srn(
          userTaskId: json['user_task_id'], srnRemarks: json['srn_remarks']);

  Map<String, dynamic> toSTNJson() =>
      {'user_task_id': userTaskId, 'stn_remarks': stnRemarks};
  Map<String, dynamic> toSRNJson() =>
      {'user_task_id': userTaskId, 'srn_remarks': srnRemarks};
}
