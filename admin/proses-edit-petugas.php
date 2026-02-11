<?php
$id_petugas = $_GET['id_petugas'];
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$nama_petugas = isset($_POST['nama_petugas']) ? $_POST['nama_petugas'] : '';
$level = isset($_POST['level']) ? $_POST['level'] : '';


include '../koneksi.php'; 
$sql = "UPDATE petugas SET username='$username',password='$password',nama_petugas='$nama_petugas',level='$level' WHERE id_petugas='$id_petugas'";
$query = mysqli_query($koneksi, $sql);
if($query){
	header("localhost:?url=petugas");
}else{
	echo"<script> alert('maaf data tidak tersimpan'); window.location.assign('?url=petugas');</script>";
}
