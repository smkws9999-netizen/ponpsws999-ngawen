<?php
include '../koneksi.php';
?>
<div class="container mt-4">
    <h3>Halaman Data Petugas</h3>
    <a href="admin.php?url=tambah-petugas" class="btn btn-success mb-3">+ Tambah Petugas</a>

    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th>Nama Petugas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM petugas ORDER BY id_petugas DESC");
        while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['username']; ?></td>
                <td><?= $data['password']; ?></td>
                <td><?= $data['level']; ?></td>
                <td><?= $data['nama_petugas']; ?></td>
                <td>
                    <a href="admin.php?url=edit-petugas&id_petugas=<?= $data['id_petugas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus-petugas.php?id_petugas=<?= $data['id_petugas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
