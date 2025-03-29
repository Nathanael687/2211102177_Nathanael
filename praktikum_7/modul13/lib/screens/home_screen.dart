import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../models/cart_model.dart';
import '../models/item.dart';
import 'cart_screen.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  // Menggunakan 'const' agar tidak ada error pada list
  final List<Item> availableItems = const [
    Item(name: "JB-Power Magtan JBK", price: 40000000),
    Item(name: "Ninja 400 Engine", price: 15000000),
    Item(name: "Ohlins KA 744", price: 9000000),
    Item(name: "Race Plastic Ninja 400", price: 10000000),
    Item(name: "Galespeed Type-GP1S", price: 38500000),
    Item(name: "Exact Forged Magnesium", price: 80000000),
    Item(name: "Dunlop Sportmax Slick-110/70R17", price: 2600000),
    Item(name: "Dunlop Sportmax Slick-140/70R17", price: 3500000),
    Item(name: "BREMBO Front Disk Kit Ninja 400", price: 4700000),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Nat Shop"),
        actions: [
          IconButton(
            icon: const Icon(Icons.shopping_cart),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (context) => const CartScreen()),
              );
            },
          ),
        ],
      ),
      body: ListView.builder(
        itemCount: availableItems.length,
        itemBuilder: (context, index) {
          final item = availableItems[index];
          return ListTile(
            title: Text(item.name),
            subtitle: Text(item.formattedPrice),
            trailing: ElevatedButton(
              onPressed: () {
                Provider.of<CartModel>(context, listen: false).add(item);
              },
              child: const Text("Tambah"),
            ),
          );
        },
      ),
    );
  }
}
