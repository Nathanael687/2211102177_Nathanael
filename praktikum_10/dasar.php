<?php 
echo "hello, bg!"; 
echo "<br>";

$n = "Joshua";
$umur = 20;
echo "Nama saya $n, umur saya $umur tahun <br>"; 

$a=10;
$b=20;
echo "Penjumlahan = ". ($a + $b) ; 
echo "<br>";
echo "Pengurangan = ".($a - $b); 
echo "<br>";
echo "Perkalian = " . ($a * $b); 
echo "<br>";
echo "Pembagian = " . ($a / $b); 
echo "<br>";
echo "Modulus = " .($a % $b); 
echo "<br>";
echo "<br>";
?>

<?php
$nilai = 80;
if ($nilai >= 75) {
    echo "Lulus";
} else {
    echo "Tidak Lulus";
}
?>

<?php
echo "<br>";
$hari = "Senin";
 
switch ($hari) {
    case "Senin":
        echo "Hari ini Senin";
        break;
    case "Selasa":
        echo "Hari ini Selasa";
        break;
    default:
        echo "Hari tidak diketahui";
}
echo "<br>";
?>

<?php 
//For
for ($i = 1; $i <= 5; $i++) {
    echo "Angka ke-$i <br>";
}
echo "<br>";

//While
$x = 1;
while ($x <= 5) {
    echo "Angka $x <br>";
    $x++;
}
echo "<br>";

//Foreach
$buah = ["Apel", "Jeruk", "Mangga"];
foreach ($buah as $b) {
    echo "Buah: $b <br>";
}
echo "<br>";
?>

<?php 
//Array
$hewan = ["Kucing", "Anjing", "Burung"]; echo $hewan[0]; // Output: Kucing
echo "<br>";
?>