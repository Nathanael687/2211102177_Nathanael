import 'package:flutter/material.dart';
import 'dart:collection';
import 'item.dart';
import 'package:intl/intl.dart';

class CartModel extends ChangeNotifier {
  final List<Item> _items = [];

  // Getter untuk mendapatkan daftar item (read-only)
  UnmodifiableListView<Item> get items => UnmodifiableListView(_items);

  // Getter untuk menghitung total harga
  int get totalPrice => _items.fold(0, (sum, item) => sum + item.price);
  String get formattedTotalPrice {
    final formatter = NumberFormat.currency(
      locale: 'id_ID',
      symbol: 'Rp ',
      decimalDigits: 0,
    );
    return formatter.format(totalPrice);
  }

  // Menambahkan item ke dalam cart
  void add(Item item) {
    _items.add(item);
    notifyListeners(); // Beritahu listener ada perubahan
  }

  // Menghapus semua item dalam cart
  void removeAll() {
    _items.clear();
    notifyListeners();
  }

  // Menghapus 1 item (satu instance) dari cart
  void removeOne(Item item) {
    _items.remove(item);
    notifyListeners();
  }

  // Mendapatkan jumlah (quantity) dari item tertentu
  int getQuantity(Item item) {
    return _items.where((i) => i == item).length;
  }

  // Mendapatkan daftar item unik (distinct)
  List<Item> get distinctItems => _items.toSet().toList();
}
