class CustomAttributes {
  String key;
  String? value;
  String datatype;
  String attributeId;
  bool isMandate;

  CustomAttributes(
      {required this.key,
      required this.value,
      this.datatype = 'Free-flow',
      this.isMandate = true,
      this.attributeId = ''});

  factory CustomAttributes.fromJson(Map<String, dynamic> json) =>
      CustomAttributes(
        key: json['key'],
        value: json['value'],
        datatype: json['datatype'],
        isMandate: json['isMandate'],
        attributeId: json['attributeCode'],
      );

  @override
  String toString() {
    return 'CustomAttributes{key: $key, value: $value, datatype: $datatype, attributeCode: $attributeId, isMandate: $isMandate}';
  }
}
