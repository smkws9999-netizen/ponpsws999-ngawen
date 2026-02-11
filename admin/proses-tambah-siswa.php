<?php

$nisn = isset($_POST['nisn']) ? $_POST['nisn'] : '';
$nis = isset($_POST['nis']) ? $_POST['nis'] : '';
$nama_siswa = isset($_POST['nama_siswa']) ? $_POST['nama_siswa'] : '';
$id_kelas = isset($_POST['id_kelas']) ? $_POST['id_kelas'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$id_spp = isset($_POST['id_spp']) ? $_POST['id_spp'] : '';
$no_tlpn_email = isset($_POST['no_tlpn_email']) ? $_POST['no_tlpn_email'] : '';

include '../koneksi.php'; 
$sql = "INSERT INTO siswa(nisn,nis,nama_siswa,id_kelas,alamat,id_spp,no_tlpn_email) values('$nisn','$nis', '$nama_siswa', '$id_kelas', '$alamat', '$id_spp', '$no_tlpn_email')";
$query = mysqli_query($koneksi, $sql);
if($query){
    header("localhost:?url=siswa");
}else{
    die("Query gagal: " . mysqli_error($koneksi));
    echo"<script> alert('maaf data tidak tersimpan'); window.location.assign('?url=siswa');</script>";
}
