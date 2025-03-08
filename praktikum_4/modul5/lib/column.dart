import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(title: const Text('Column - 2211102177')),
        body: Padding(
          padding: const EdgeInsets.all(10.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisSize: MainAxisSize.min,
            children: <Widget>[
              const Text('We move under cover and we move as one'),
              const Text(
                'Through the night, we have one shot to live another day',
              ),
              const Text('We cannot let a stray gunshot give us away'),
              const Text(
                'We will fight up close, seize the moment and stay in it',
              ),
              const Text(
                "It's either that or meet the business end of a bayonet",
              ),
              const Text('The code word is "Rochambeau," dig me?'),
              Text('Rochambeau!', style: TextStyle(fontSize: 32)),
            ],
          ),
        ),
      ),
    );
  }
}
