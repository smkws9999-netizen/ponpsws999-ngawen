<?php
session_start();
include "koneksi.php";

// Jika tombol login ditekan
if (isset($_POST['login'])) {

    // Jika login sebagai ADMIN
    if ($_POST['level'] == "admin") {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if ($username == "" || $password == "") {
            echo "<script>alert('Username dan password harus diisi!');</script>";
        } else {
            $admin = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");

            if (mysqli_num_rows($admin) == 1) {
                $data = mysqli_fetch_assoc($admin);

                if ($data['password'] == $password) {

                    $_SESSION['admin_id'] = $data['id_petugas'];
                    $_SESSION['admin_nama'] = $data['nama_petugas'];

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
}
// Jika login sebagai SISWA
$level = $_POST['level'] ?? '';

if ($level == "siswa") {

    $nisn = trim($_POST['nisn'] ?? '');
    $nis  = trim($_POST['nis'] ?? '');

    if ($nisn == "" || $nis == "") {
        echo "<script>alert('NISN dan NIS harus diisi!');</script>";
    } else {

        $siswa = mysqli_query(
            $koneksi,
            "SELECT * FROM siswa WHERE nisn='$nisn' AND nis='$nis'"
        );

        if (!$siswa) {
            die("Query error: " . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($siswa) == 1) {

            $data = mysqli_fetch_assoc($siswa);

            $_SESSION['nisn'] = $data['nisn'];
            $_SESSION['nama_siswa'] = $data['nama_siswa'];
            $_SESSION['kelas'] = $data['id_kelas'];
            $_SESSION['status_siswa'] = true;

            header("Location: user/dashboard.php");
            exit;

        } else {
            echo "<script>alert('NISN atau NIS tidak cocok!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Pembayaran SPP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background: #5a6fd8;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }

</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card p-4">
                <h3 class="text-center mb-3">Login Sistem SPP</h3>

                <!-- PILIH LOGIN -->
                <form method="POST">
                    <label>Pilih Login:</label>
                    <select name="level" class="form-control mb-3" required>
                        <option value="">--Pilih--</option>
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
                        <input type="text" name="nisn" class="form-control mb-2" placeholder="Masukkan nisn..">

                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control mb-3" placeholder="Masukkan nis..">
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-100">LOGIN</button>
                </form>

            </div>

        </div>
    </div>
</div>

<script>
    // TAMPILKAN FORM SESUAI PILIHAN USER
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
