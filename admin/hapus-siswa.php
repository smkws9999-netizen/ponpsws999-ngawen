<?php

$nisn = $_GET['nisn'];

include'../koneksi.php'; 
$sql = "DELETE FROM siswa  WHERE nisn= '$nisn'";
$query = mysqli_query($koneksi, $sql);
if($query){
	header("localhost:?url=siswa");
}else{
	echo"<script> alert('maaf data tidak terHAPUS'); window.location.assign('?url=siswa');</script>";
}
