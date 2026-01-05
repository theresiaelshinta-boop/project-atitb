<?php
session_start();
include '../../config/config.php';

// Proteksi halaman admin
if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil data produk
$result = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Makanan | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; width: 250px; background: #212529; color: white; position: fixed; z-index: 100; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 15px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #343a40; color: white; }
        .sidebar a.active { background: #0d6efd; color: white; }
        .content { margin-left: 250px; padding: 30px; }
        .table-container { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .img-product { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; }
        @media (max-width: 768px) {
            .sidebar { width: 100%; min-height: auto; position: relative; }
            .content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4">
        <h4 class="text-center fw-bold"><i class="fas fa-utensils me-2"></i>E-Katalog</h4>
    </div>
    <hr class="mx-3">
    <a href="../dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="../infoUser.php"><i class="fas fa-users me-2"></i> Data User</a>
    <a href="index.php" class="active"><i class="fas fa-hamburger me-2"></i> Kelola Makanan</a>
    <a href="../katalogMinuman/index.php" class="active"><i class="fas fa-hamburger me-2"></i> Kelola Minuman</a>
    <a href="../logout.php" class="text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Manajemen Katalog</h2>
            <p class="text-muted">Tambah, edit, atau hapus menu makanan Anda.</p>
        </div>
        <a href="tambah.php" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Menu
        </a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">ID</th>
                        <th>Foto</th>
                        <th>Nama Makanan</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><span class="text-muted">#<?php echo $row['id']; ?></span></td>
                            <td>
                                <img src="../../assets/img/<?php echo $row['gambar']; ?>" class="img-product border" alt="Produk">
                            </td>
                            <td><strong><?php echo $row['nama_makanan']; ?></strong></td>
                            <td><span class="text-success fw-bold">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></span></td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data makanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>