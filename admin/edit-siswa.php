<?php
$nisn = $_GET['nisn'];
include '../koneksi.php';
$sql = "SELECT * FROM siswa,spp,kelas WHERE siswa.id_kelas=kelas.id_kelas AND siswa.id_spp=spp.id_spp AND nisn='$nisn'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>

<h5>Halaman Edit Siswa</h5>
<a href="?url-siswa" class="btn btn-primary"> Kembali </a>
<hr>
<form method="post" action="?url=proses-edit-siswa&nisn=<?= $nisn; ?>">
    <div class="form-group mb-2">
        <label>nisn</label>
        <input value="<?= $data ['nisn'] ?>" readonly type="number" name="nisn" class="form-control" required>
    </div>
    <div class="form-group mb-2">
        <label>nis</label>
        <input value="<?= $data ['nis'] ?>"  type="number" name="nis" class="form-control" required>
    </div>
    <div class="form-group mb-2">
        <label>nama siswa</label>
        <input value="<?= $data ['nama_siswa'] ?>"  type="text" name="nama_siswa" class="form-control" required>
    </div>
    <div class="form-group mb-2">
    <label>Kelas</label>
    <select name="id_kelas" class="form-control" required>
        <option value= "<?= $data['id_kelas'] ?>"> <?= $data['tingkat_kelas'] ?>  Pilih Kelas </option>

        <?php
        include '../koneksi.php';
        $kelas = mysqli_query($koneksi, "SELECT*FROM kelas ORDER BY tingkat_kelas ASC");

        while ($data_kelas = mysqli_fetch_assoc($kelas)) { ?>
            <option value="<?= $data_kelas['id_kelas'] ?>">
                <?= $data_kelas['tingkat_kelas'] ?> - <?= $data_kelas['kompetensi_keahlian'] ?>
            </option>
        <?php } ?>

    </select>
</div>
    <div class="form-group mb-2">
        <label>alamat</label>
        <textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
    </div>
    <div class="form-group mb-2">
        <label>no_tlpn_email</label>
        <input value="<?= $data ['no_tlpn_email'] ?>" type="text" name="no_tlpn_email" class="form-control" required></textarea>
    </div>
    <div calss="form-group mb-2">
    <label>SPP</label>
    <select name="id_spp" class="form-control" required>
         <option value="<?= $data['id_spp'] ?>">
                <?= $data['tahun'] ?> - Rp <?=  number_format($data['nominal'],3,',','.'); ?>
            </option>
        <?php
        include '../koneksi.php';
        $spp = mysqli_query($koneksi, "SELECT*FROM spp ORDER BY id_spp ASC");

        while ($data_spp = mysqli_fetch_assoc($spp)) { ?>
            <option value="<?= $data_spp['id_spp'] ?>">
                <?= $data_spp['tahun'] ?> - Rp <?=  number_format($data_spp['nominal'],3,',','.'); ?>
            </option>
        <?php } ?>
    </select>
    <div class="form-group">
        <button type="submit" class="btn btn-succes"> SIMPAN </button>
        <button type="reset" class="btn btn-warning"> HAPUS </button>
    </div>
</form>