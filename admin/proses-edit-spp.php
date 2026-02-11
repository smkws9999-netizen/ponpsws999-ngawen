<?php
include '../koneksi.php';
$id_spp = $_POST['id_spp'];
$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];

$sql = "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id_spp'";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='admin.php?url=spp';</script>";
} else {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>
