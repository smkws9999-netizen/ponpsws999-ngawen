<?php
include '../koneksi.php';

// Hitung jumlah siswa
$jml_siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa"))['total'];

// Hitung jumlah kelas
$jml_kelas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kelas"))['total'];

// Hitung jumlah data SPP
$jml_spp = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM spp"))['total'];

// Hitung total pembayaran
// Total pembayaran
$qTotal = mysqli_query($koneksi, "SELECT SUM(jumlah_dibayar) AS total FROM pembayaran");
$total = mysqli_fetch_assoc($qTotal);
$total_bayar = (int) ($total['total'] ?? 0);
?>

<style>
.card-link {
    text-decoration: none;
}
.card:hover {
    transform: scale(1.06);
    transition: 0.3s;
    cursor: pointer;
}
</style>

<div class="container mt-4">
    <h3>Dashboard Administrator</h3>
    <p class="text-muted">Ringkasan data aplikasi pembayaran SPP.</p>

    <div class="row">

        <!-- Jumlah Siswa -->
        <div class="col-md-3 mb-3">
            <a href="admin.php?url=siswa" class="card-link">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Siswa</h5>
                        <h2><?= $jml_siswa; ?></h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Jumlah Kelas -->
        <div class="col-md-3 mb-3">
            <a href="admin.php?url=kelas" class="card-link">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Kelas</h5>
                        <h2><?= $jml_kelas; ?></h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Data SPP -->
        <div class="col-md-3 mb-3">
            <a href="admin.php?url=spp" class="card-link">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body">
                        <h5 class="card-title">Data SPP</h5>
                        <h2><?= $jml_spp; ?></h2>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Pembayaran -->
        <div class="col-md-3 mb-3">
            <a href="admin.php?url=pembayaran" class="card-link">
                <div class="card text-white bg-danger shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Pembayaran Masuk</h5>
                        <h3>Rp <?= number_format($total_bayar, 3,',','.'); ?></h3>
                    </div>
                </div>
            </a>
        </div>

    </div>

    <div class="card mt-4 shadow">
        <div class="card-body">
            <h5>Informasi Sistem</h5>
            <p>
                Selamat datang di <b>Aplikasi Pembayaran SPP</b>.  
                Semua data pada dashboard diperbarui otomatis sesuai input terbaru.
            </p>
            <div class="card mt-3 shadow">
    <div class="card-body">
        <h5 class="mb-3">Visi & Misi Pondok Pesantren Walisongo</h5>

        <h6>Visi</h6>
        <p>
            Mewujudkan generasi santri yang beriman, berilmu, berakhlak mulia, 
            mandiri, dan berwawasan luas sesuai ajaran Islam Ahlussunnah wal Jama’ah.
        </p>

        <h6>Misi</h6>
        <ul>
            <li>Menyelenggarakan pendidikan berbasis nilai-nilai Islam.</li>
            <li>Membentuk karakter santri yang berakhlakul karimah.</li>
            <li>Meningkatkan kualitas keilmuan agama dan umum.</li>
            <li>Mengembangkan kemandirian dan kreativitas santri.</li>
            <li>Menyiapkan generasi yang siap berkontribusi bagi masyarakat.</li>
        </ul>
    </div>
</div>
        </div>
    </div>

</div>
