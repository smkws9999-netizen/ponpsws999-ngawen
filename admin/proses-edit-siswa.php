<?php
$nisn = isset($_POST['nisn']) ? $_POST['nisn'] : '';
$nis = isset($_POST['nis']) ? $_POST['nis'] : '';
$nama_siswa = isset($_POST['nama_siswa']) ? $_POST['nama_siswa'] : '';
$id_kelas = isset($_POST['id_kelas']) ? $_POST['id_kelas'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$id_spp = isset($_POST['id_spp']) ? $_POST['id_spp'] : '';
$no_tlpn_email = isset($_POST['no_tlpn_email']) ? $_POST['no_tlpn_email'] : '';

include '../koneksi.php'; 
$sql = "UPDATE siswa SET nis='$nis' ,nama_siswa='$nama_siswa' ,id_kelas='$id_kelas' ,alamat='$alamat' ,id_spp='$id_spp' ,no_tlpn_email='$no_tlpn_email' WHERE nisn='$nisn'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='admin.php?url=siswa';</script>";
} else {
    die("Query gagal: " . mysqli_error($koneksi));
}
