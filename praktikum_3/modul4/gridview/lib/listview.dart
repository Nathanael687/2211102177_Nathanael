import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    final List<String> entries = <String>['A', 'B', 'C'];
    final List<int> colorCodes = <int>[600, 500, 100];

    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(title: const Text('ListView.builder Example')),
        body: Padding(
          padding: const EdgeInsets.all(10.0),
          child: 
          ListView( 
padding: const EdgeInsets.all(8), 
children: <Widget>[ 
Container( 
height: 50, 
color: Colors.amber[600], 
child: const Center(child: Text('Entry A')), 
), 
Container( 
height: 50, 
color: Colors.amber[500], 
child: const Center(child: Text('Entry B')), 
),
              Container(
                height: 50,
                color: Colors.amber[100],
                child: const Center(child: Text('Entry C')),
              ),
            ],
          )
        ),
      ),
    );
  }
}
