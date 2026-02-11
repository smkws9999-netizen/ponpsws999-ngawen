<?php
session_start();
include '../koneksi.php';

$id_petugas = isset($_POST['id_petugas']) ? $_POST['id_petugas'] : '';
$nisn = isset($_POST['nisn']) ? $_POST['nisn'] : '';
$nama_siswa = isset($_POST['nama_siswa']) ? $_POST['nama_siswa'] : '';
$tgl_dibayar = isset($_POST['tgl_dibayar']) ? $_POST['tgl_dibayar'] : '';
$bulan_dibayar = isset($_POST['bulan_dibayar']) ? $_POST['bulan_dibayar'] : '';
$tahun_dibayar = isset($_POST['tahun_dibayar']) ? $_POST['tahun_dibayar'] : '';
$id_spp = isset($_POST['id_spp']) ? $_POST['id_spp'] : '';
$jumlah_dibayar = isset($_POST['jumlah_dibayar']) ? $_POST['jumlah_dibayar'] : '';


include '../koneksi.php'; 
$sql = "INSERT INTO pembayaran(id_petugas,nisn,tgl_dibayar,bulan_dibayar,tahun_dibayar,id_spp,jumlah_dibayar) values('$id_petugas','$nisn','$tgl_dibayar','$bulan_dibayar','$tahun_dibayar','$id_spp','$jumlah_dibayar')";
$query = mysqli_query($koneksi, $sql);
if($query){
	header("Location: admin.php?url=pembayaran");
}else{
	echo"<script> alert('maaf data tidak tersimpan'); window.location.assign('?url=pembayaran');</script>";
}
