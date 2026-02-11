<?php
include '../koneksi.php';
?>
<table class="table table-bordered table-striped text-center align-middle">
    <h3>Halaman Pembayaran</h3>
    <thead class="table-light text-center">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>SPP</th>
            <th>Nominal</th>
            <th>Sudah Dibayar</th>
            <th>Kekurangan</th>
            <th>Status</th>
            <th>History</th>
            <th>CETAK</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;

       $query = mysqli_query($koneksi, "
    SELECT siswa.*, 
           kelas.tingkat_kelas, 
           kelas.kompetensi_keahlian, 
           spp.nominal, 
           spp.tahun,
           pembayaran.bulan_dibayar,
           pembayaran.tahun_dibayar
    FROM siswa 
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    JOIN spp ON siswa.id_spp = spp.id_spp
    LEFT JOIN pembayaran ON siswa.nisn = pembayaran.nisn
    ORDER BY siswa.nama_siswa ASC
");


        while ($data = mysqli_fetch_assoc($query)) {

            $pembayaran = mysqli_query($koneksi, "SELECT SUM(jumlah_dibayar) AS total FROM pembayaran WHERE nisn='$data[nisn]'");
            $pby = mysqli_fetch_assoc($pembayaran);

            $sudah_bayar = $pby['total'] ?? 0;
            $kekurangan = max(0, $data['nominal'] - $sudah_bayar);
            $status = ($kekurangan <= 0) ? "Lunas" : "Belum Lunas";
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nisn']; ?></td>
            <td><?= $data['nama_siswa']; ?></td>
            <td><?= $data['tingkat_kelas'] ?></td>
            <td><?= $data['tahun']; ?></td>
            <td>Rp <?= number_format($data['nominal'], 4, ',', '.'); ?></td>
            <td>Rp <?= number_format($sudah_bayar, 4, ',', '.'); ?></td>
            <td>Rp <?= number_format($kekurangan, 4, ',', '.'); ?></td>
            <td>
                <?php
                if($kekurangan==0){
                    echo"<span class='badge text-bg-success'> sudah lunas </span>";
                }else{ ?>
                   <a href="admin.php?url=tambah-pembayaran&nisn=<?=$data['nisn']; ?>&kekurangan=<?= $kekurangan; ?>" class="btn btn-danger">Pilih&Bayar</a>
                <?php } ?>
            </td>
            <td><a href="admin.php?url=history-pembayaran&nisn=<?=$data['nisn']; ?>" class="btn btn-info btn-sm">History</a></td>
            <td>
    <a href="admin.php?url=cetak-laporan&nisn=<?= $data['nisn']; ?>" 
       class="btn btn-success btn-sm" target="_blank">Cetak Bukti</a>
</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
