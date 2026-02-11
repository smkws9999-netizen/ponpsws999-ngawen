<h5>Halaman Tambah Siswa</h5>
<a href="?url-siswa" class="btn btn-primary"> Kembali </a>
<hr>
<form method="post" action="?url=proses-tambah-siswa">
    <div class="form-group mb-2">
        <label>nisn</label>
        <input type="number" name="nisn" class="form-control" required>
    </div>
    <div class="form-group mb-2">
        <label>nis</label>
        <input type="number" name="nis" class="form-control" required>
    </div>
    <div class="form-group mb-2">
        <label>nama_siswa</label>
        <input type="text" name="nama_siswa" class="form-control" required>
    </div>
    <div class="form-group mb-2">
    <label>Kelas</label>
    <select name="id_kelas" class="form-control" required>
        <option value="">-- Pilih Kelas --</option>

        <?php
        include '../koneksi.php';
        $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY tingkat_kelas ASC");

        while ($data_kelas = mysqli_fetch_assoc($kelas)) { ?>
            <option value="<?= $data_kelas['id_kelas'] ?>">
                <?= $data_kelas['tingkat_kelas'] ?> - <?= $data_kelas['kompetensi_keahlian'] ?>
            </option>
        <?php } ?>
    </select>
</div>
    <div class="form-group mb-2">
        <label>alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <div class="form-group mb-2">
        <label>no_tlpn_email</label>
        <input type="text" name="no_tlpn_email" class="form-control" required>
    </div>
    <div calss="form-group mb-2">
    <label>SPP</label>
    <select name="id_spp" class="form-control" required>
        <option value="">-- Pilih SPP --</option>
        <?php
        include '../koneksi.php';
        $spp = mysqli_query($koneksi, "SELECT * FROM spp ORDER BY id_spp ASC");

        while ($data_spp = mysqli_fetch_assoc($spp)) { ?>
            <option value="<?= $data_spp['id_spp'] ?>">
                <?= $data_spp['tahun'] ?> - Rp <?=  number_format($data_spp['nominal'],2,',','.'); ?>
            </option>
        <?php } ?>
    </select>
    <div class="form-group">
        <button type="submit" class="btn btn-success"> SIMPAN </button>
        <button type="reset" class="btn btn-warning"> HAPUS </button>
    </div>
</form>