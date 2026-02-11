<?php
include '../koneksi.php';
?>
<div class="container mt-4">
    <h3>DATA KELAS</h3>
    <a href="admin.php?url=tambah-kelas" class="btn btn-success mb-3">+ Tambah SPP</a>

    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>TINGKAT KELAS</th>
                <th>KOMPETENSI KEAHLIAN</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY id_kelas ASC");
        while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['tingkat_kelas']; ?></td>
                <td><?= $data['kompetensi_keahlian']; ?></td>
                <td>
                    <a href="admin.php?url=edit-kelas&id_kelas=<?= $data['id_kelas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus-kelas.php?id_kelas=<?= $data['id_kelas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
