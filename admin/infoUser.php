<?php
session_start();
include '../config/config.php';

// Proteksi halaman admin
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; width: 250px; background: #212529; color: white; position: fixed; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 15px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #343a40; color: white; }
        .sidebar a.active { background: #0d6efd; color: white; }
        .content { margin-left: 250px; padding: 30px; }
        .table-container { background: white; border-radius: 15px; padding: 20px; shadow: 0 4px 6px rgba(0,0,0,0.1); }
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
    <a href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="infoUser.php" class="active"><i class="fas fa-users me-2"></i> Data User</a>
    <a href="katalogMakanan/index.php"><i class="fas fa-hamburger me-2"></i> Kelola Makanan</a>
    <a href="../katalogMinuman/index.php"><i class="fas fa-hamburger me-2"></i> Kelola Minuman</a>
    <a href="logout.php" class="text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manajemen User</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Data User</li>
            </ol>
        </nav>
    </div>

    <div class="table-container shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Daftar Pengguna Terdaftar</h5>
            <button class="btn btn-sm btn-outline-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i> Cetak Laporan
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">ID</th>
                        <th>Username</th>
                        <th>Password (Ter-enkripsi)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><strong>#<?php echo $row['id']; ?></strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                    <?php echo strtoupper(substr($row['username'], 0, 1)); ?>
                                </div>
                                <?php echo $row['username']; ?>
                            </div>
                        </td>
                        <td>
                            <small class="text-muted font-monospace text-break">
                                <?php echo $row['password']; ?>
                            </small>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-light text-danger" title="Hapus User (Fitur belum aktif)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>