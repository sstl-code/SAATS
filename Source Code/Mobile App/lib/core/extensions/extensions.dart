extension CapTitleExtension on String {
  String get titleCapitalizeString => this
      .split(" ")
      .map((str) => str[0].toUpperCase() + str.substring(1))
      .join(" ");
}

bool isValidEmail(String email) {
  return RegExp(r'^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$').hasMatch(email);
}
