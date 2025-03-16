import 'dart:async';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

void main() {
  runApp(
    MaterialApp(
      theme: ThemeData(appBarTheme: AppBarTheme(color: Colors.amber)),
      home: MyApp(),
      debugShowCheckedModeBanner: false,
    ),
  );
}

class MyApp extends StatefulWidget {
  @override
  _MyAppState createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  final FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin =
      FlutterLocalNotificationsPlugin();

  @override
  void initState() {
    super.initState();

    // Konfigurasi untuk Android dan iOS (iOS memakai Darwin)
    const AndroidInitializationSettings androidSettings =
        AndroidInitializationSettings('@mipmap/ic_launcher');
    final DarwinInitializationSettings iosSettings =
        DarwinInitializationSettings();

    final InitializationSettings initializationSettings =
        InitializationSettings(android: androidSettings, iOS: iosSettings);

    flutterLocalNotificationsPlugin.initialize(
      initializationSettings,
      onDidReceiveNotificationResponse: onSelectNotification,
    );
  }

  void onSelectNotification(NotificationResponse response) {
    Navigator.of(context).push(
      MaterialPageRoute(
        builder: (_) => NewScreen(payload: response.payload ?? 'No Payload'),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.amber,
        title: const Text('Flutter Notification Demo'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.blueAccent,
                minimumSize: Size(250, 50),
              ),
              onPressed: showNotification,
              child: const Text(
                'Show Notification',
                style: TextStyle(color: Colors.white),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Future<void> showNotification() async {
    const AndroidNotificationDetails androidDetails =
        AndroidNotificationDetails(
          'id',
          'channel',
          channelDescription: 'description',
          priority: Priority.high,
          importance: Importance.max,
        );

    const DarwinNotificationDetails iosDetails = DarwinNotificationDetails();

    const NotificationDetails platformDetails = NotificationDetails(
      android: androidDetails,
      iOS: iosDetails,
    );

    await flutterLocalNotificationsPlugin.show(
      0,
      'Flutter Devs',
      'Flutter Local Notification Demo',
      platformDetails,
      payload: 'Welcome to the Local Notification demo',
    );
  }
}

class NewScreen extends StatelessWidget {
  final String payload;

  const NewScreen({Key? key, required this.payload}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text(payload)),
      body: Center(
        child: Text('Payload: $payload', style: TextStyle(fontSize: 18)),
      ),
    );
  }
}
