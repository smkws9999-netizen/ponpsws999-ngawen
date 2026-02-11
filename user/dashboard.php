<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../koneksi.php';

// Proteksi login siswa
if (!isset($_SESSION['status_siswa'])) {
    header("Location: ../login.php");
    exit;
}

$nisn = $_SESSION['nisn'];
$namaSiswa = $_SESSION['nama_siswa'];


// Jumlah pembayaran siswa
$qPembayaran = mysqli_query($koneksi,
    "SELECT COUNT(*) AS total_pembayaran 
     FROM pembayaran 
     WHERE nisn='$nisn'"
);
$jPembayaran = mysqli_fetch_assoc($qPembayaran)['total_pembayaran'] ?? 0;

// Jumlah bulan lunas
$qBulan = mysqli_query($koneksi,
    "SELECT COUNT(DISTINCT bulan_dibayar) AS bulan_lunas 
     FROM pembayaran 
     WHERE nisn='$nisn'"
);
$bulanLunas = mysqli_fetch_assoc($qBulan)['bulan_lunas'] ?? 0;

// Total pembayaran
$qTotal = mysqli_query($koneksi,
    "SELECT SUM(jumlah_dibayar) AS total_dibayar 
     FROM pembayaran 
     WHERE nisn='$nisn'"
);
$totalBayar = mysqli_fetch_assoc($qTotal)['total_dibayar'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">

    <h4>Dashboard Siswa</h4>
    <p>
    Selamat datang, <strong><?= htmlspecialchars($namaSiswa) ?></strong> 👋 <br>
    Ringkasan pembayaran SPP Anda</p>

    <div class="row">

        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5>Jumlah Pembayaran</h5>
                    <h3><?= $jPembayaran ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5>Bulan Lunas</h5>
                    <h3><?= $bulanLunas ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-dark bg-warning mb-3">
                <div class="card-body">
                    <h5>Total Dibayar</h5>
                    <h4>Rp <?= number_format($totalBayar,3,',','.') ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5>Status</h5>
                    <h4>AKTIF</h4>
                </div>
            </div>
        </div>

    </div>

    <a href="history-pembayaran.php" class="btn btn-primary btn-sm">
        Lihat History Pembayaran
    </a>

    <a href="logout.php" class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin logout?')">
        Logout
    </a>

</div>

</body>
</html>
