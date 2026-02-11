<?php
include '../koneksi.php';

$nisn = $_GET['nisn'];
?>

<table class="table table-bordered table-striped text-center align-middle">
    <h3>History Pembayaran</h3>
    <a href="admin.php?url=pembayaran" class="btn btn-success mb-3">Kembali</a>

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
            <th>Nama Petugas</th>
            <th>Hapus</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "
    SELECT pembayaran.*, siswa.nama_siswa, siswa.nisn,
           kelas.tingkat_kelas, spp.nominal, spp.tahun,
           petugas.nama_petugas
    FROM pembayaran
    JOIN siswa ON pembayaran.nisn = siswa.nisn
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN spp ON pembayaran.id_spp = spp.id_spp
    LEFT JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
    WHERE pembayaran.nisn='$nisn'
    ORDER BY pembayaran.tgl_dibayar DESC
");


if (!$query) {
   echo "SQL ERROR: " . mysqli_error($koneksi);
}
        while ($data = mysqli_fetch_assoc($query)) {
          

        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nisn']; ?></td>
            <td><?= $data['nama_siswa']; ?></td>
            <td><?= $data['tingkat_kelas']; ?></td>
            <td><?= $data['tahun']; ?></td>
            <td>Rp <?= number_format($data['nominal'], 4, ',', '.'); ?></td>
            <td>Rp <?= number_format($data['jumlah_dibayar'], 4, ',', '.'); ?></td>
            <td><?= $data['tgl_dibayar']; ?></td>
            <td><?= $data['nama_petugas'] ?? '-'; ?></td>
            <td>
                <a onclick="return confirm('Yakin mau hapus data pembayaran ini?')"
                   href="hapus-pembayaran.php?id_pembayaran=<?=$data['id_pembayaran']; ?>"
                   class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
