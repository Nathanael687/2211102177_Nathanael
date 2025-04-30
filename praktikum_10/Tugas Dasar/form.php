<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Jika form disubmit, redirect ke file proses.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: proses.php?nama=" . urlencode($_POST['nama']) . "&umur=" . (int)$_POST['umur']);
    exit();
}
?>

<form method="post" action="">
    Nama: <input type="text" name="nama" required>
    <br>
    Umur: <input type="number" name="umur" required>
    <br>
    <input type="submit" value="Kirim">
</form>