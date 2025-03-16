import 'package:flutter/material.dart';

void main() => runApp(const MyApp());

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    const appTitle = 'Form Styling Demo';
    return MaterialApp(
      title: appTitle,
      home: DefaultTabController(
        length: 3, // Jumlah tab
        child: Scaffold(
          appBar: AppBar(
            title: const Text(appTitle),
            bottom: const TabBar(
              tabs: [
                Tab(icon: Icon(Icons.home), text: "Home"),
                Tab(icon: Icon(Icons.person), text: "Profile"),
                Tab(icon: Icon(Icons.settings), text: "Settings"),
              ],
            ),
          ),
          body: const TabBarView(
            children: [
              MyCustomForm(),
              Center(child: Text("Profile Page")),
              Center(child: Text("Settings Page")),
            ],
          ),
        ),
      ),
    );
  }
}

class MyCustomForm extends StatelessWidget {
  const MyCustomForm({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: <Widget>[
        const Padding(
          padding: EdgeInsets.symmetric(horizontal: 8, vertical: 16),
          child: TextField(
            decoration: InputDecoration(
              border: OutlineInputBorder(),
              hintText: 'Enter a search term',
            ),
          ),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 16),
          child: TextFormField(
            decoration: const InputDecoration(
              border: UnderlineInputBorder(),
              labelText: 'Enter your username',
            ),
          ),
        ),
      ],
    );
  }
}
