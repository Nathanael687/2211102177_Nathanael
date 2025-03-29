import 'package:intl/intl.dart';

class Item {
  final String name;
  final int price;

  const Item({required this.name, required this.price});

  String get formattedPrice {
    final formatter = NumberFormat.currency(
      locale: 'id_ID',
      symbol: 'Rp ',
      decimalDigits: 0,
    );
    return formatter.format(price);
  }
}
