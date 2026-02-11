<?php
include '../koneksi.php';
if (!isset($_GET['id_petugas']) || $_GET['id_petugas'] == '') {
    echo "<div class='alert alert-danger'>ID petugas tidak ditemukan di URL.</div>";
    exit;
}

$id_petugas = $_GET['id_petugas'];

$query = mysqli_query($koneksi, "SELECT*FROM petugas WHERE id_petugas='$id_petugas'");
if (mysqli_num_rows($query) == 0) {
    echo "<div class='alert alert-warning'>Data SPP dengan ID $id_petugas tidak ditemukan.</div>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<h5>Halaman Edit Data</h5>
<a href="?url-petugas" class="btn btn-primary"> Kembali </a>
<hr>
<form method="post" action="?url=proses-edit-petugas&id_petugas=<?= $id_petugas; ?>">
	<div class="form-group mb-2">
		<label>username</label>
		<input value="<?= $data['username'] ?>" type="text" name="username" maxlength="4" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>password</label>
		<input value="<?= $data['password'] ?>" type="text" name="password" maxlength="13" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>nama petugas</label>
		<input value="<?= $data['nama_petugas'] ?>" type="text" name="nama_petugas" maxlength="13" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Level Petugas</label>
		<select name="level" class="form-control" required>
			<option value="<?= $data['level'] ?>"> <?= $data['level'] ?> </option>
			<option value="admin"> admin </option>
			<option value="petugas"> petugas </option>
		</select>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-success"> SIMPAN </button>
		<button type="reset" class="btn btn-warning"> KOSONGKAN </button>
	</div>
</form>