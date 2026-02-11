<?php
include '../koneksi.php';
if (!isset($_GET['id_kelas']) || $_GET['id_kelas'] == '') {
    echo "<div class='alert alert-danger'>ID kelas tidak ditemukan di URL.</div>";
    exit;
}

$id_kelas = $_GET['id_kelas'];

// Ambil data SPP berdasarkan ID
$query = mysqli_query($koneksi, "SELECT*FROM kelas WHERE id_kelas='$id_kelas'");
if (mysqli_num_rows($query) == 0) {
    echo "<div class='alert alert-warning'>Data SPP dengan ID $id_kelas tidak ditemukan.</div>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<div class="container mt-4">
    <h3>Halaman Edit Kelas</h3>
    <form method="post" action="?url=proses-edit-kelas&id_kelas=<?= $id_kelas; ?>">
        <input type="hidden" name="id_kelas" value="<?= $data['id_kelas']; ?>">

        <div class="form-group mb-3">
            <label>tingkat kelas</label>
             <select name="tingkat_kelas" class="form-control" required>
        <option value= "<?= $data['tingkat_kelas'] ?>"> <?= $data['tingkat_kelas'] ?>  Pilih Kelas </option>
        <?php
        include '../koneksi.php';
        $kelas = mysqli_query($koneksi, "SELECT*FROM kelas ORDER BY tingkat_kelas ASC");

        while ($data_kelas = mysqli_fetch_assoc($kelas)) { ?>
            <option value="<?= $data_kelas['tingkat_kelas'] ?>">
                <?= $data_kelas['tingkat_kelas'] ?>
            </option>
        <?php } ?>

    </select>
        </div>

        <div class="form-group mb-3">
            <label>kompetensi keahlian</label>
            <input type="text" name="kompetensi_keahlian" value="<?= $data['kompetensi_keahlian']; ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan </button>
        <a href="admin.php?url=kelas" class="btn btn-warning">Kembali</a>
    </form>
</div>
