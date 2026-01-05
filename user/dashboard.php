<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include '../config/config.php';

// Ambil data user untuk profil
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Delicioso Foody</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7fe; }
        .sidebar { min-height: 100vh; width: 260px; background: #fff; position: fixed; box-shadow: 4px 0 10px rgba(0,0,0,0.03); }
        .sidebar-link { color: #8a94ad; text-decoration: none; padding: 15px 25px; display: block; border-radius: 10px; margin: 5px 15px; transition: 0.3s; }
        .sidebar-link:hover, .sidebar-link.active { background: #eef2ff; color: #4e73df; font-weight: 600; }
        .content { margin-left: 260px; padding: 40px; }
        .welcome-card { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); color: white; border-radius: 20px; padding: 30px; border: none; }
        .stat-card { background: #fff; border-radius: 15px; border: none; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        @media (max-width: 768px) { .sidebar { width: 100%; min-height: auto; position: relative; } .content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4 text-center">
        <h4 class="fw-bold text-primary"><i class="fas fa-utensils me-2"></i>Delicioso Foody</h4>
    </div>
    <div class="mt-4">
        <a href="dashboard.php" class="sidebar-link active"><i class="fas fa-columns me-2"></i> Dashboard</a>
        <a href="katalog.php" class="sidebar-link"><i class="fas fa-book-open me-2"></i> Lihat Katalog</a>
        <a href="logout.php" class="sidebar-link text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
    </div>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h4 class="fw-bold mb-0">Overview Dashboard</h4>
            <p class="text-muted small">Selamat datang kembali di sistem kami.</p>
        </div>
        <div class="d-flex align-items-center">
            <span class="me-3 fw-semibold"><?php echo $username; ?></span>
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <div class="card welcome-card shadow-sm mb-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold">Selamat Datang, <?php echo $username; ?>! 🎉</h2>
                <p class="opacity-75">Hari ini adalah waktu yang tepat untuk melihat menu lezat kami. Jelajahi katalog sekarang dan temukan makanan favorit Anda.</p>
                <a href="katalog.php" class="btn btn-light text-primary fw-bold px-4 py-2 mt-2 rounded-pill shadow-sm">Buka Katalog</a>
            </div>
            <div class="col-md-4 text-center d-none d-md-block">
                <i class="fas fa-hamburger fa-8x opacity-25"></i>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-light-primary p-3 rounded-circle me-3" style="background: #eef2ff;">
                        <i class="fas fa-shopping-cart text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Status Akun</h6>
                        <span class="fw-bold text-success">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="bg-light-success p-3 rounded-circle me-3" style="background: #e6f9ed;">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Metode Pesan</h6>
                        <span class="fw-bold">WhatsApp</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>