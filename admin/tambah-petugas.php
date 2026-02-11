<h5>Halaman Tambah Data</h5>
<a href="?url-petugas" class="btn btn-primary"> Kembali </a>
<hr>
<form method="post" action="?url=proses-tambah-petugas">
	<div class="form-group mb-2">
		<label>username</label>
		<input type="text" name="username" maxlength="13" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>password</label>
		<input type="text" name="password" maxlength="13" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>nama petugas</label>
		<input type="text" name="nama_petugas" maxlength="13" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Level Petugas</label>
		<select name="level" class="form-control" required>
			<option value="">--pilih level petugas--</option>
			<option value="admin"> admin </option>
			<option value="petugas"> petugas </option>
		</select>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-success"> SIMPAN </button>
		<button type="reset" class="btn btn-warning"> KOSONGKAN </button>
	</div>
</form>