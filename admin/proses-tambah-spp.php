<?php

$tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
$nominal = isset($_POST['nominal']) ? $_POST['nominal'] : '';

include '../koneksi.php'; 
$sql = "INSERT INTO spp(tahun,nominal) values('$tahun','$nominal')";
$query = mysqli_query($koneksi, $sql);
if($query){
	header("localhost:?url=spp");
}else{
	echo"<script> alert('maaf data tidak tersimpan'); window.location.assign('?url=spp');</script>";
}
