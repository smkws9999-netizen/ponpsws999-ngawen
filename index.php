<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {

    $level = $_POST['level'];

    // ============== LOGIN ADMIN ==============
    if ($level == "admin") {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if ($username == "" || $password == "") {
            echo "<script>alert('Username dan password harus diisi!');</script>";
        } else {

            $admin = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");

            if (mysqli_num_rows($admin) == 1) {

                $data = mysqli_fetch_assoc($admin);

                if ($data['password'] == $password) {

                    // Set SESSION ADMIN
                    $_SESSION['admin_id']   = $data['id_petugas'];
                    $_SESSION['admin_nama'] = $data['nama_petugas'];

                    // Redirect ke halaman admin
                    header("Location: admin/admin.php");
                    exit;

                } else {
                    echo "<script>alert('Password salah!');</script>";
                }

            } else {
                echo "<script>alert('Username admin tidak ditemukan');</script>";
            }
        }
    }

    // ============== LOGIN SISWA ==============
    else if ($level == "siswa") {

        $nisn = trim($_POST['nisn']);
        $nis  = trim($_POST['nis']);

        if ($nisn == "" || $nis == "") {
            echo "<script>alert('NISN dan NIS harus diisi!');</script>";
        } else {

            $siswa = mysqli_query(
                $koneksi,
                "SELECT * FROM siswa WHERE nisn='$nisn' AND nis='$nis'"
            );

            if (mysqli_num_rows($siswa) == 1) {

                $data = mysqli_fetch_assoc($siswa);

                // Set SESSION SISWA
                $_SESSION['nisn']         = $data['nisn'];
                $_SESSION['nama_siswa']   = $data['nama_siswa'];
                $_SESSION['kelas']        = $data['id_kelas'];
                $_SESSION['status_siswa'] = true;

                // Redirect ke dashboard siswa
                header("Location: user/dashboard.php");
                exit;

            } else {
                echo "<script>alert('NISN atau NIS tidak cocok!');</script>";
            }
        }
    }

    else {
        echo "<script>alert('Silakan pilih jenis login terlebih dahulu!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Pembayaran SPP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card p-4">
                <h3 class="text-center mb-3">Login Sistem SPP</h3>

                <form method="POST">

                    <label>Pilih Login:</label>
                    <select name="level" class="form-control mb-3" required>
                        <option value="">-- Pilih --</option>
                        <option value="admin">Admin</option>
                        <option value="siswa">Siswa</option>
                    </select>

                    <!-- FORM ADMIN -->
                    <div id="formAdmin" style="display:none;">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control mb-2">

                        <label>Password</label>
                        <input type="password" name="password" class="form-control mb-3">
                    </div>

                    <!-- FORM SISWA -->
                    <div id="formSiswa" style="display:none;">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control mb-2" placeholder="Masukkan NISN">

                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control mb-3" placeholder="Masukkan NIS">
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-150">
                        LOGIN
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
const level = document.querySelector("select[name='level']");
const formAdmin = document.getElementById("formAdmin");
const formSiswa = document.getElementById("formSiswa");

level.addEventListener("change", function() {
    if (this.value == "admin") {
        formAdmin.style.display = "block";
        formSiswa.style.display = "none";
    } else if (this.value == "siswa") {
        formAdmin.style.display = "none";
        formSiswa.style.display = "block";
    } else {
        formAdmin.style.display = "none";
        formSiswa.style.display = "none";
    }
});
</script>

</body>
</html>
