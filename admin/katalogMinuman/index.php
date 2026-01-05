<?php
session_start();
include '../../config/config.php';
if (!isset($_SESSION['admin_login'])) { header("Location: ../login.php"); exit; }

$result = mysqli_query($conn, "SELECT * FROM minuman");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f8f9fa; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background: #212529; color: white; }
        .content { margin-left: 250px; padding: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 15px; }
        .sidebar a:hover { background: #343a40; }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="p-3 text-center">Admin Panel</h4>
    <a href="../dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="index.php" class="bg-primary"><i class="fas fa-wine-glass me-2"></i> Katalog Minuman</a>
    <a href="../katalogMakanan/index.php" class="bg-primary"><i class="fas fa-wine-glass me-2"></i> Katalog Makanan</a>
    <a href="../logout.php" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Katalog Minuman</h2>
        <a href="tambah.php" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah Minuman</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Minuman</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><img src="../../assets/img/<?= $row['gambar_minuman']; ?>" width="60" class="rounded"></td>
                        <td><?= $row['nama_minuman']; ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus minuman ini?')"><i class="fas fa-trash"></i></a>
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