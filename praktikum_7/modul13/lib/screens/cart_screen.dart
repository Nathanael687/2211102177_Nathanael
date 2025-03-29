import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../models/cart_model.dart';
import '../models/item.dart';


class CartScreen extends StatelessWidget {
  const CartScreen({super.key});

  @override
  Widget build(BuildContext context) {
    var cart = Provider.of<CartModel>(context);

    return Scaffold(
      appBar: AppBar(title: const Text("Keranjang Belanja")),
      body:
          cart.items.isEmpty
              ? const Center(child: Text("Keranjang masih kosong"))
              : Column(
                children: [
                  Expanded(
                    child: ListView.builder(
                      itemCount: cart.distinctItems.length,
                      itemBuilder: (context, index) {
                        final item = cart.distinctItems[index];
                        final quantity = cart.getQuantity(item);

                        return ListTile(
                          title: Text(item.name),
                          subtitle: Text("${item.formattedPrice} x $quantity"),
                          trailing: Row(
                            mainAxisSize: MainAxisSize.min,
                            children: [
                              IconButton(
                                icon: const Icon(Icons.remove),
                                onPressed: () {
                                  cart.removeOne(item);
                                },
                              ),
                              Text(
                                '$quantity',
                                style: const TextStyle(fontSize: 16),
                              ),
                              IconButton(
                                icon: const Icon(Icons.add),
                                onPressed: () {
                                  cart.add(item);
                                },
                              ),
                            ],
                          ),
                        );
                      },
                    ),
                  ),
                  Padding(
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      children: [
                        Text(
                          "Total: ${cart.formattedTotalPrice}",
                          style: const TextStyle(fontSize: 20),
                        ),
                        const SizedBox(height: 10),
                        ElevatedButton(
                          onPressed: () {
                            cart.removeAll();
                            ScaffoldMessenger.of(context).showSnackBar(
                              const SnackBar(
                                content: Text("Keranjang telah dikosongkan"),
                              ),
                            );
                          },
                          child: const Text("Hapus Semua"),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
    );
  }
}
