<?php
include '../koneksi.php';
?>
<div class="container mt-4">
    <h3>Data SPP</h3>
    <a href="admin.php?url=tambah-spp" class="btn btn-success mb-3">+ Tambah SPP</a>
    <a href="admin.php?url=kembali" class="btn btn-warning mb-3">kembali</a>

    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Nominal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM spp ORDER BY tahun ASC");
        while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['tahun']; ?></td>
                <td>Rp <?= number_format($data['nominal'],3,',','.'); ?></td>
                <td>
                    <a href="admin.php?url=edit-spp&id_spp=<?= $data['id_spp']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus-spp.php?id_spp=<?= $data['id_spp']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
