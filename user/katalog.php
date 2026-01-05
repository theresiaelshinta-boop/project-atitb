<?php
session_start();
include '../config/config.php';

// Proteksi user login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil data Makanan
$queryMakanan = mysqli_query($conn, "SELECT * FROM produk");
// Ambil data Minuman
$queryMinuman = mysqli_query($conn, "SELECT * FROM minuman");

$nomor_wa = "6285694261056";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Menu Lengkap | Delicioso Foody</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7fe; padding-top: 80px; }
        .navbar-custom { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .nav-tabs { border: none; margin-bottom: 30px; }
        .nav-tabs .nav-link { border: none; color: #8a94ad; font-weight: 600; padding: 10px 25px; border-radius: 30px; margin-right: 10px; }
        .nav-tabs .nav-link.active { background: #4e73df; color: white; box-shadow: 0 4px 12px rgba(78,115,223,0.3); }
        .card-product { transition: 0.3s; border: none; border-radius: 15px; overflow: hidden; height: 100%; }
        .card-product:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
        .img-container { height: 160px; overflow: hidden; }
        .img-product { width: 100%; height: 100%; object-fit: cover; }
        .search-input { border-radius: 30px; padding: 10px 20px; border: 2px solid #eef2ff; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="dashboard.php"><i class="fas fa-utensils me-2"></i>Delicioso Foody</a>
        <div class="ms-auto d-flex align-items-center">
            <a href="dashboard.php" class="btn btn-light btn-sm rounded-pill px-3 me-2">Dashboard</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill px-3">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold">Menu Kami</h2>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0" style="border-radius: 30px 0 0 30px;"><i class="fas fa-search text-muted"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 search-input" placeholder="Cari menu makanan atau minuman..." style="border-radius: 0 30px 30px 0;">
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="makanan-tab" data-bs-toggle="tab" data-bs-target="#makanan" type="button">
                <i class="fas fa-hamburger me-2"></i>Makanan
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="minuman-tab" data-bs-toggle="tab" data-bs-target="#minuman" type="button">
                <i class="fas fa-wine-glass me-2"></i>Minuman
            </button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="makanan">
            <div class="row product-grid">
                <?php while($makan = mysqli_fetch_assoc($queryMakanan)): 
                    $pesan = urlencode("Halo Admin, saya ingin memesan Makanan: " . $makan['nama_makanan']);
                ?>
                <div class="col-6 col-md-3 mb-4 product-item" data-name="<?= strtolower($makan['nama_makanan']); ?>">
                    <div class="card card-product shadow-sm">
                        <div class="img-container">
                            <img src="../assets/img/<?= $makan['gambar']; ?>" class="img-product">
                        </div>
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-1"><?= $makan['nama_makanan']; ?></h6>
                            <p class="text-primary small fw-bold mb-2">Rp <?= number_format($makan['harga'], 0, ',', '.'); ?></p>
                            <a href="https://api.whatsapp.com/send?phone=<?= $nomor_wa; ?>&text=<?= $pesan; ?>" target="_blank" class="btn btn-primary btn-sm w-100 rounded-pill">Pesan</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="minuman">
            <div class="row product-grid">
                <?php while($minum = mysqli_fetch_assoc($queryMinuman)): 
                    $pesan = urlencode("Halo Admin, saya ingin memesan Minuman: " . $minum['nama_minuman']);
                ?>
                <div class="col-6 col-md-3 mb-4 product-item" data-name="<?= strtolower($minum['nama_minuman']); ?>">
                    <div class="card card-product shadow-sm">
                        <div class="img-container">
                            <img src="../assets/img/<?= $minum['gambar_minuman']; ?>" class="img-product">
                        </div>
                        <div class="card-body p-3">
                            <h6 class="fw-bold mb-1"><?= $minum['nama_minuman']; ?></h6>
                            <p class="text-primary small fw-bold mb-2">Rp <?= number_format($minum['harga'], 0, ',', '.'); ?></p>
                            <a href="https://api.whatsapp.com/send?phone=<?= $nomor_wa; ?>&text=<?= $pesan; ?>" target="_blank" class="btn btn-primary btn-sm w-100 rounded-pill">Pesan</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fitur Search
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.product-item');
        items.forEach(item => {
            let name = item.getAttribute('data-name');
            item.style.display = name.includes(filter) ? "" : "none";
        });
    });
</script>
</body>
</html>