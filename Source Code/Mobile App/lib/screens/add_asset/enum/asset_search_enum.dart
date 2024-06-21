enum AssetSearchStatus {
  allowToAdd(200),
  allowToAddByPrePopulating(300),
  dontAllowToAdd(404);

  final int value;

  const AssetSearchStatus(this.value);
}
