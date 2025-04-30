<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['nama']) && isset($_GET['umur'])) {
    $nama = htmlspecialchars($_GET['nama']);
    $umur = (int)$_GET['umur'];

    echo "Halo, $nama!<br>";
    if ($umur >= 18) {
        echo "Status: Dewasa";
    } else {
        echo "Status: Belum Dewasa";
    }
} else {
    echo "Data tidak valid.";
}
?>