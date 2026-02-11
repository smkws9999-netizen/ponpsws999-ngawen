<h5>Halaman Tambah Data</h5>
<a href="?url-kelas" class="btn btn-primary"> Kembali </a>
<hr>
<form method="post" action="?url=proses-tambah-kelas">
	<div class="form-group mb-2">
		<label>tingkat_kelas</label>
		<input type="text" name="tingkat_kelas"  class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>kompetensi_keahlian</label>
		<input type="text" name="kompetensi_keahlian"  class="form-control" required>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-success"> SIMPAN </button>
		<button type="reset" class="btn btn-warning"> KOSONGKAN </button>
	</div>
</form>