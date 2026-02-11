<?php
include '../koneksi.php';

// 1. Ambil kata kunci pencarian
$cariNama = isset($_GET['cari_nama']) ? $_GET['cari_nama'] : '';

// 2. Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// 3. Hitung total data sesuai filter
$totalQuery = mysqli_query($koneksi, "
    SELECT COUNT(*) as total
    FROM pembayaran
    JOIN siswa ON pembayaran.nisn = siswa.nisn
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN spp ON pembayaran.id_spp = spp.id_spp
    WHERE siswa.nama_siswa LIKE '%$cariNama%'
");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];
$totalPage = ceil($totalData / $limit);

// 4. Ambil data sesuai filter & limit
$query = mysqli_query($koneksi, "
    SELECT pembayaran.*, siswa.nama_siswa, kelas.tingkat_kelas, spp.nominal
    FROM pembayaran
    JOIN siswa ON pembayaran.nisn = siswa.nisn
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN spp ON pembayaran.id_spp = spp.id_spp
    WHERE siswa.nama_siswa LIKE '%$cariNama%'
    ORDER BY pembayaran.tgl_dibayar DESC
    LIMIT $offset, $limit
");
?>

<h3>Laporan Pembayaran SPP</h3>

<!-- Form Pencarian -->
<form method="GET" action="admin.php?url=laporan-spp" class="mb-3">
    <input type="text" name="cari_nama" placeholder="Cari nama siswa..." 
           value="<?= htmlspecialchars($cariNama); ?>" style="width:300px; display:inline-block;">
    <button type="submit" class="btn btn-primary">Cari</button>
    <?php if($cariNama != ''){ ?>
        <a href="admin.php?url=laporan-spp" class="btn btn-secondary">Reset</a>
    <?php } ?>
</form>

<table class="table table-bordered table-striped text-center align-middle">
    <thead class="table-light text-center">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Tahun SPP</th>
            <th>Nominal</th>
            <th>Jumlah Dibayar</th>
            <th>Tanggal Bayar</th>
            <th>Bulan</th>
            <th>Nama Petugas</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(mysqli_num_rows($query) > 0){
            $no = $offset + 1;
            while($data = mysqli_fetch_assoc($query)){
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nisn']; ?></td>
            <td><?= $data['nama_siswa']; ?></td>
            <td><?= $data['tingkat_kelas']; ?></td>
            <td><?= $data['tahun_dibayar']; ?></td>
            <td>Rp <?= number_format($data['nominal'], 4, ',', '.'); ?></td>
            <td>Rp <?= number_format($data['jumlah_dibayar'], 4, ',', '.'); ?></td>
            <td><?= $data['tgl_dibayar']; ?></td>
            <td><?= $data['bulan_dibayar']; ?></td>
            <td><?= $data['nama_petugas'] ?? '-'; ?></td>
        </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='10'>Data tidak ditemukan!</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Pagination -->
<div>
<?php
if($totalPage > 1){
    for($i=1; $i<=$totalPage; $i++){
        if($i == $page){
            echo "<strong>$i</strong> ";
        } else {
            $link = "admin.php?url=laporan-spp&page=$i";
            if($cariNama != '') $link .= "&cari_nama=".urlencode($cariNama);
            echo "<a href='$link'>$i</a> ";
        }
    }
}
?>
</div>
