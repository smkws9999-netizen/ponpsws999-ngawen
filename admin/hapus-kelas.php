<?php

$id_kelas = $_GET['id_kelas'];

include'../koneksi.php'; 
$sql = "DELETE FROM kelas  WHERE id_kelas= '$id_kelas'";
$query = mysqli_query($koneksi, $sql);
if($query){
	header("localhost:?url=dashbroad");
}else{
	echo"<script> alert('maaf data tidak terHAPUS'); window.location.assign('?url=dashbroad');</script>";
}
