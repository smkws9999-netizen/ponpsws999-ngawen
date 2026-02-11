<?php

$id_spp = $_GET['id_spp'];

include'../koneksi.php'; 
$sql = "DELETE FROM spp  WHERE id_spp= '$id_spp'";
$query = mysqli_query($koneksi, $sql);
if($query){
	header("localhost:?url=dashbroad");
}else{
	echo"<script> alert('maaf data tidak terHAPUS'); window.location.assign('?url=dashbroad');</script>";
}
