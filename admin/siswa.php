<?php
include '../koneksi.php';

// 1. Ambil kata kunci pencarian dari form
$cariNama = isset($_GET['cari_nama']) ? $_GET['cari_nama'] : '';

// 2. Pagination
$limit = 10; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// 3. Hitung total data sesuai filter
$totalQuery = mysqli_query($koneksi, "
    SELECT COUNT(*) as total
    FROM siswa
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN spp ON siswa.id_spp = spp.id_spp
    WHERE siswa.nama_siswa LIKE '%$cariNama%'
");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];
$totalPage = ceil($totalData / $limit);

// 4. Ambil data siswa sesuai filter & limit
$query = mysqli_query($koneksi, "
    SELECT siswa.*, kelas.tingkat_kelas, kelas.kompetensi_keahlian, spp.nominal, spp.tahun
    FROM siswa
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN spp ON siswa.id_spp = spp.id_spp
    WHERE siswa.nama_siswa LIKE '%$cariNama%'
    ORDER BY siswa.nama_siswa ASC
    LIMIT $offset, $limit
");
?>

<h3>Halaman Data Siswa</h3>
<a href="admin.php?url=tambah-siswa" class="btn btn-success mb-3">+ Tambah Siswa</a>

<!-- Form Pencarian -->
<form method="GET" action="admin.php?url=data-siswa" class="mb-3">
    <input type="text" name="cari_nama" placeholder="Cari nama siswa..." 
           value="<?= htmlspecialchars($cariNama); ?>" style="width:300px; display:inline-block;">
    <button type="submit" class="btn btn-primary">Cari</button>
    <?php if($cariNama != ''){ ?>
        <a href="admin.php?url=data-siswa" class="btn btn-secondary">Reset</a>
    <?php } ?>
</form>

<table class="table table-bordered table-striped text-center align-middle">
    <thead class="table-light">
        <tr>
            <th style="width: 40px;">No</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>SPP</th>
            <th>No Tlpn / Email</th>
            <th style="width: 80px;">Edit</th>
            <th style="width: 80px;">Hapus</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(mysqli_num_rows($query) > 0){
            $no = $offset + 1;
            while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['nisn']; ?></td>
                <td><?= $data['nis']; ?></td>
                <td><?= $data['nama_siswa']; ?></td>
                <td><?= $data['tingkat_kelas'] . ' ' . $data['kompetensi_keahlian']; ?></td>
                <td><?= $data['alamat']; ?></td>
                <td>
                    Rp <?= number_format($data['nominal'],3, ',','.'); ?><br>
                    <small class="text-muted">Tahun <?= $data['tahun']; ?></small>
                </td>
                <td><?= $data['no_tlpn_email']; ?></td>
                <td>
                    <a href="admin.php?url=edit-siswa&nisn=<?= $data['nisn']; ?>" class="btn btn-warning btn-sm">Edit</a>
                </td>
                <td>
                    <a onclick="return confirm('Yakin mau hapus?')" 
                       href="hapus-siswa.php?nisn=<?= $data['nisn']; ?>" 
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php }
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
            $link = "admin.php?url=data-siswa&page=$i";
            if($cariNama != '') $link .= "&cari_nama=".urlencode($cariNama);
            echo "<a href='$link'>$i</a> ";
        }
    }
}
?>
</div>
