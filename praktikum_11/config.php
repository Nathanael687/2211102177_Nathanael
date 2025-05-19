<?php
/**
 * Database connection configuration
 */
 
$databaseHost = 'localhost';
$databaseName = 'zawata';
$databaseUsername = 'root';
$databasePassword = '';
 
// Create connection with error handling
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to utf8
mysqli_set_charset($mysqli, "utf8");
?>