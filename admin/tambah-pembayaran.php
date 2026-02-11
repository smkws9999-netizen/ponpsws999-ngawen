<?php
include '../koneksi.php';

// Ambil data dari URL
$nisn = isset($_GET['nisn']) ? $_GET['nisn'] : '';
$kekurangan = isset($_GET['kekurangan']) ? $_GET['kekurangan'] : '';

if ($nisn == '' || $kekurangan == '') {
    echo "<div class='alert alert-danger'>Data tidak lengkap dikirim melalui URL.</div>";
    echo "<a href='admin.php?url=pembayaran' class='btn btn-warning mt-2'>Kembali</a>";
    exit;
}

// Query data siswa
$query = mysqli_query($koneksi, "
    SELECT siswa.*, spp.nominal, spp.tahun, kelas.tingkat_kelas, kelas.kompetensi_keahlian 
    FROM siswa 
    JOIN spp ON siswa.id_spp=spp.id_spp 
    JOIN kelas ON siswa.id_kelas=kelas.id_kelas
    WHERE nisn='$nisn'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<div class='alert alert-danger'>Data siswa tidak ditemukan.</div>";
    echo "<a href='admin.php?url=pembayaran' class='btn btn-warning mt-2'>Kembali</a>";
    exit;
}


?>

<div class="container mt-4">
    <h3>Halaman Tambah Pembayaran</h3>
    <form method="post" action="?url=proses-tambah-pembayaran&nisn=<?=$nisn; ?>">
        
        <input type="hidden" name="nisn" value="<?=$data['nisn']; ?>">
        <input type="hidden" name="kekurangan" value="<?=$kekurangan; ?>">
         <input name="id_spp" value="<?= $data['id_spp'] ?>" type="hidden" readonly class="form-control">

    <div class="form-group mb-3">
        <label>NISN</label>
        <input value="<?=$data['nisn'] ?>" readonly class="form-control">
    </div>
    <div class="form-group mb-3">
        <label>Tanggal Bayar</label>
        <input type="date" name="tgl_dibayar" class="form-control" required>
    </div>

        <div class="form-group mb-3">
            <label>Bulan Bayar</label>
            <select name="bulan_dibayar" class="form-control" required>
                <option value="">--Pilih Bulan--</option>
                <option value="januari">Januari</option>
                <option value="februari">Februari</option>
                <option value="maret">Maret</option>
                <option value="april">April</option>
                <option value="mei">Mei</option>
                <option value="juni">Juni</option>
                <option value="juli">Juli</option>
                <option value="agustus">Agustus</option>
                <option value="september">September</option>
                <option value="oktober">Oktober</option>
                <option value="november">November</option>
                <option value="desember">Desember</option>
            </select>
        </div>
        <div class="form-group mb-3">
    <label>Tahun Bayar</label>
    <select name="tahun_dibayar" class="form-control" required>
        <option value="">--Pilih Tahun--</option>
        <?php
        for ($i = 2010; $i <= date('Y'); $i++) {
            echo "<option value='$i'>$i</option>";
        }
        ?>
    </select>
</div>

        <div class="form-group mb-2">
    <label>
        Jumlah Dibayar (jumlah yang harus dibayar adalah 
        <b><?= number_format($kekurangan,4,',','.') ?></b>)
    </label>
    <input type="number" name="jumlah_dibayar" max="<?= $kekurangan; ?>" class="form-control" required>
</div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="admin.php?url=pembayaran" class="btn btn-warning">Kembali</a>

    </form>
</div>
