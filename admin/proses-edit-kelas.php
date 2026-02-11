<?php
include '../koneksi.php';

$id_kelas = $_POST['id_kelas'];
$tingkat_kelas = $_POST['tingkat_kelas'];
$kompetensi_keahlian = $_POST['kompetensi_keahlian'];

$sql = "UPDATE kelas SET tingkat_kelas='$tingkat_kelas', kompetensi_keahlian='$kompetensi_keahlian' WHERE id_kelas='$id_kelas'";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='admin.php?url=kelas';</script>";
} else {
    die("Query gagal: " . mysqli_error($koneksi));
}
?>
