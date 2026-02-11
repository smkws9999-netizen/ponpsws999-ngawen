
<?php
$koneksi = mysqli_connect("localhost", "root", "", "pembayaran_spp");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
