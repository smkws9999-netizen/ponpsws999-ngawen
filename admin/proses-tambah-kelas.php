<?php

$tingkat_kelas = isset($_POST['tingkat_kelas']) ? $_POST['tingkat_kelas'] : '';
$kompetensi_keahlian = isset($_POST['kompetensi_keahlian']) ? $_POST['kompetensi_keahlian'] : '';

include '../koneksi.php'; 
$sql = "INSERT INTO kelas(tingkat_kelas,kompetensi_keahlian) values('$tingkat_kelas','$kompetensi_keahlian')";
$query = mysqli_query($koneksi, $sql);
if($query){
	header("localhost:?url=kelas");
}else{
	echo"<script> alert('maaf data tidak tersimpan'); window.location.assign('?url=kelas');</script>";
}
