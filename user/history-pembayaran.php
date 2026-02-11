<?php
session_start();
include '../koneksi.php';

// Proteksi halaman (wajib login siswa)
if (!isset($_SESSION['status_siswa'])) {
    header("Location: ../login.php");
    exit;
}

$nisn = $_SESSION['nisn'];

// Ambil data pembayaran siswa
$query = mysqli_query($koneksi, "
    SELECT pembayaran.*, spp.nominal, petugas.nama_petugas
    FROM pembayaran
    LEFT JOIN spp ON pembayaran.id_spp = spp.id_spp
    LEFT JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
    WHERE pembayaran.nisn = '$nisn'
    ORDER BY pembayaran.tgl_dibayar DESC
");

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>History Pembayaran SPP</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h4 class="mb-3">History Pembayaran SPP</h4>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr class="text-center">
                <th>No</th>
                <th>Tanggal Bayar</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Petugas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
        ?>
            <tr class="text-center">
                <td><?= $no++; ?></td>
                <td><?= date('d-m-Y', strtotime($data['tgl_dibayar'])); ?></td>
                <td><?= $data['bulan_dibayar']; ?></td>
                <td><?= $data['tahun_dibayar']; ?></td>
                <td>Rp <?= number_format($data['jumlah_dibayar'], 3, ',', '.'); ?></td>
                <td><?= $data['nama_petugas'] ?? '-'; ?></td>
                <td>
                    <span class="badge bg-success">Lunas</span>
                </td>
            </tr>
        <?php
            }
        } else {
        ?>
            <tr>
                <td colspan="7" class="text-center text-danger">
                    Belum ada pembayaran
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary btn-sm">Kembali</a>
</div>

</body>
</html>
