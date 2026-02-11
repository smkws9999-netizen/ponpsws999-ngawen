<?php
include '../koneksi.php';

$nisn = $_GET['nisn'];

$query = mysqli_query($koneksi, "
    SELECT pembayaran.*, siswa.nama_siswa, siswa.nisn, 
           kelas.tingkat_kelas, spp.nominal, spp.tahun, petugas.nama_petugas
    FROM pembayaran
    JOIN siswa ON pembayaran.nisn = siswa.nisn
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN spp ON pembayaran.id_spp = spp.id_spp
    LEFT JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
    WHERE pembayaran.nisn='$nisn'
    ORDER BY pembayaran.tgl_dibayar DESC LIMIT 1
");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Kwitansi Pembayaran SPP</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #fff;
}

/* ===== KOTAK LUAR ===== */
.kwitansi-outer {
    width: 85mm;
    margin: 10px auto;
    border: 2px solid #000;
    padding: 5px;
    box-sizing: border-box;
}

/* ===== KOTAK DALAM ===== */
.kwitansi-inner {
    border: 1.5px solid #000;
    padding: 6px;
    box-sizing: border-box;
}

/* ===== HEADER ===== */
.header {
    display: flex;
    align-items: center;
    gap: 6px;
}

.header img {
    width: 30px;
}

.header-text {
    text-align: center;
    flex: 1;
}

.header-text h1 {
    font-size: 11px;
    margin: 0;
    font-weight: bold;
}

.header-text h2 {
    font-size: 9px;
    margin: 2px 0 0;
    font-weight: bold;
}

hr {
    border: none;
    border-top: 1px solid #000;
    margin: 6px 0;
}

/* ===== DETAIL ===== */
.detail {
    font-size: 10px;
}

.detail table {
    width: 100%;
}

.detail td {
    padding: 2px 0;
    vertical-align: top;
}

.detail td:first-child {
    width: 45%;
    font-weight: bold;
}

/* ===== FOOTER ===== */
.footer {
    text-align: center;
    font-size: 9px;
    margin-top: 6px;
}

@media print {

    /* SEMBUNYIKAN SEMUA ISI HALAMAN */
    body * {
        visibility: hidden;
    }

    /* TAMPILKAN HANYA KWITANSI */
    .kwitansi-outer,
    .kwitansi-outer * {
        visibility: visible;
    }

    /* POSISI KWITANSI DI ATAS KERTAS */
    .kwitansi-outer {
        position: absolute;
        left: 0;
        top: 0;
        margin: 0;
    }

    /* TOMBOL TIDAK IKUT CETAK */
    .no-print {
        display: none !important;
    }
}

</style>
</head>

<body>

<div class="kwitansi-outer">
    <div class="kwitansi-inner">

        <div class="header">
            <img src="logo-pondok.png" alt="Logo">
            <div class="header-text">
                <h1>KWITANSI PEMBAYARAN SPP</h1>
                <h2>PONDOK PESANTREN WALISONGO NGAWEN</h2>
            </div>
        </div>

        <hr>

        <div class="detail">
            <table>
                <tr><td>No Kwitansi</td><td>: KW-<?= $data['id_pembayaran']; ?></td></tr>
                <tr><td>NISN</td><td>: <?= $data['nisn']; ?></td></tr>
                <tr><td>Nama</td><td>: <?= $data['nama_siswa']; ?></td></tr>
                <tr><td>Kelas</td><td>: <?= $data['tingkat_kelas']; ?></td></tr>
                <tr><td>Tahun SPP</td><td>: <?= $data['tahun']; ?></td></tr>
                <tr><td>Nominal</td><td>: Rp <?= number_format($data['nominal'],3,',','.'); ?></td></tr>
                <tr><td>Dibayar</td><td>: Rp <?= number_format($data['jumlah_dibayar'],3,',','.'); ?></td></tr>
                <tr><td>Tanggal</td><td>: <?= $data['tgl_dibayar']; ?></td></tr>
                <tr><td>Bulan</td><td>: <?= $data['bulan_dibayar']; ?></td></tr>
                <tr><td>Petugas</td><td>: <?= $data['nama_petugas'] ?: '-'; ?></td></tr>
                <tr><td>Status</td><td>: <b>LUNAS</b></td></tr>
            </table>
        </div>

        <div class="footer">
            Kwitansi ini sah sebagai bukti pembayaran resmi<br>
            Dicetak: <?= date('d-m-Y H:i:s'); ?>
        </div>

    </div>
</div>

<div class="no-print" style="text-align:center;">
    <button onclick="window.print()">Cetak</button>
</div>

</body>
</html>
