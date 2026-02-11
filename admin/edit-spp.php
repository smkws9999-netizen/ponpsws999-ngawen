<?php
include '../koneksi.php';
if (!isset($_GET['id_spp']) || $_GET['id_spp'] == '') {
    echo "<div class='alert alert-danger'>ID SPP tidak ditemukan di URL.</div>";
    exit;
}

$id_spp = $_GET['id_spp'];

// Ambil data SPP berdasarkan ID
$query = mysqli_query($koneksi, "SELECT*FROM spp WHERE id_spp='$id_spp'");
if (mysqli_num_rows($query) == 0) {
    echo "<div class='alert alert-warning'>Data SPP dengan ID $id_spp tidak ditemukan.</div>";
    exit;
}

$data = mysqli_fetch_assoc($query);
?>

<div class="container mt-4">
    <h3>Halaman Edit Data SPP</h3>
    <form method="post" action="?url=proses-edit-spp&id_spp=<?= $id_spp; ?>">
        <input type="hidden" name="id_spp" value="<?= $data['id_spp']; ?>">
        <div class="form-group mb-3">
            <label>tahun</label>
            <input type="text" name="tahun" value="<?= $data['tahun']; ?>" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>nominal</label>
            <input type="number" name="nominal" value="<?= $data['nominal']; ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan </button>
        <a href="admin.php?url=spp" class="btn btn-secondary">Kembali</a>
    </form>
</div>
