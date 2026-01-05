<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}
include '../config/config.php';
// ... kode session dan include yang sudah ada ...

// Proteksi login tetap jalan
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

// CEK STATUS KONEKSI
if ($conn) {
    $status_server = "Aktif";
    $status_bg     = "bg-warning";
    $status_color  = "text-dark";
    $status_note   = "Koneksi database stabil";

    // Hitung data hanya jika koneksi aktif
    $resUser = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
    $totalUser = mysqli_fetch_assoc($resUser)['total'];

    $resProduk = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
    $totalProduk = mysqli_fetch_assoc($resProduk)['total'];
} else {
    // JIKA OFFLINE
    $status_server = "Offline";
    $status_bg     = "bg-danger";
    $status_color  = "text-white";
    $status_note   = "Database tidak ditemukan / mati";
    
    $totalUser = 0;
    $totalProduk = 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Panel Kendali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; width: 250px; background: #212529; color: white; position: fixed; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 15px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #343a40; color: white; padding-left: 30px; }
        .sidebar a.active { background: #0d6efd; color: white; }
        .content { margin-left: 250px; padding: 30px; }
        .card-stat { border: none; border-radius: 15px; transition: transform 0.3s; }
        .card-stat:hover { transform: translateY(-5px); }
        @media (max-width: 768px) {
            .sidebar { width: 100%; min-height: auto; position: relative; }
            .content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4">
        <h4 class="text-center fw-bold"><i class="fas fa-utensils me-2"></i>Delicioso Foody</h4>
    </div>
    <hr class="mx-3">
    <a href="dashboard.php" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="infoUser.php"><i class="fas fa-users me-2"></i> Data User</a>
    <a href="katalogMakanan/index.php"><i class="fas fa-hamburger me-2"></i> Kelola Makanan</a>
    <a href="katalogMinuman/index.php"><i class="fas fa-hamburger me-2"></i> Kelola Minuman</a>
    <a href="logout.php" class="text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard Admin</h2>
        <span class="badge bg-dark p-2">Halo, <?php echo $_SESSION['admin_name']; ?>!</span>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-stat bg-primary text-white shadow">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-uppercase mb-1">Total User</h6>
                        <h2 class="mb-0"><?php echo $totalUser; ?></h2>
                    </div>
                    <i class="fas fa-user-circle fa-3x opacity-50"></i>
                </div>
                <div class="card-footer bg-transparent border-0 text-white-50">
                    <small>User terdaftar di database</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card card-stat bg-success text-white shadow">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-uppercase mb-1">Total Menu</h6>
                        <h2 class="mb-0"><?php echo $totalProduk; ?></h2>
                    </div>
                    <i class="fas fa-pizza-slice fa-3x opacity-50"></i>
                </div>
                <div class="card-footer bg-transparent border-0 text-white-50">
                    <small>Menu aktif di katalog</small>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card card-stat <?php echo $status_bg; ?> <?php echo $status_color; ?> shadow">
                <div class="card-body d-flex align-items-center">
                     <div class="flex-grow-1">
                        <h6 class="text-uppercase mb-1">Status Server</h6>
                        <h2 class="mb-0 fw-bold"><?php echo $status_server; ?></h2>
                     </div>
                    <i class="fas fa-server fa-3x opacity-50"></i>
                </div>
                <div class="card-footer bg-transparent border-0 opacity-75">
                    <small><?php echo $status_note; ?></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5>Selamat Datang di Panel Admin</h5>
                    <p class="text-muted">Melalui halaman ini, Anda dapat mengelola data pengguna, mengatur daftar menu makanan, dan memantau aktivitas sistem secara keseluruhan.</p>
                    <a href="katalogMakanan/tambah.php" class="btn btn-outline-primary">+ Tambah Menu Baru</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>