
<!DOCTYPE html>
<html>
<head>
    <title text-center> Admin - Aplikasi Pembayaran SPP</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 220px; /* sama dengan lebar sidebar */
            padding: 20px;
        }
@media print {
    .sidebar, nav, header, footer {
        display: none !important;
    }

    .btn, button, a.btn {
        display: none !important;
    }

    .container {
        width: 100% !important;
        margin: 0;
        padding: 0;
    }
}
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center text-white">ADMIN</h4>
    <a href="admin.php?url=dashboard">DASHBOARD</a>
    <a href="admin.php?url=spp">SPP</a>
    <a href="admin.php?url=kelas">KELAS</a>
    <a href="admin.php?url=siswa">SISWA</a>
    <a href="admin.php?url=petugas">PETUGAS</a>
    <a href="admin.php?url=pembayaran">PEMBAYARAN</a>
    <a href="admin.php?url=laporan">LAPORAN</a>
    <a href="admin.php?url=logout">LOGOUT</a>
</div>

<!-- Konten -->
<div class="content">
    <div class="container-fluid">
        <h3>Aplikasi Pembayaran SPP</h3>
        <div class="alert alert-info">
            Anda Login Sebagai <b>Administrator</b> Aplikasi Pembayaran SPP.
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <?php
                $file = @$_GET['url'];
               if (empty($file)) {
    include 'dashboard.php';
} else {
    include $file . '.php';
}
?>
            </div>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>