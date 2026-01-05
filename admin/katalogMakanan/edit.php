<?php
session_start();
include '../../config/config.php';

if (!isset($_SESSION['admin_login'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_makanan']);
    $harga = $_POST['harga'];
    
    if ($_FILES['gambar']['name'] != "") {
        $filename = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $folder = "../../assets/img/" . $filename;
        unlink("../../assets/img/" . $row['gambar']); // Hapus file lama
        move_uploaded_file($tmp_name, $folder);
        $gambar_sql = ", gambar='$filename'";
    } else {
        $gambar_sql = "";
    }

    $query = "UPDATE produk SET nama_makanan='$nama', harga='$harga' $gambar_sql WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; width: 250px; background: #212529; color: white; position: fixed; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 15px 20px; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #343a40; color: white; }
        .sidebar a.active { background: #0d6efd; color: white; }
        .content { margin-left: 250px; padding: 30px; }
        .form-container { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); max-width: 700px; }
        .img-preview { width: 150px; border-radius: 10px; margin-bottom: 10px; border: 2px solid #ddd; }
        @media (max-width: 768px) { .sidebar { width: 100%; min-height: auto; position: relative; } .content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="p-4"><h4 class="text-center fw-bold"><i class="fas fa-utensils me-2"></i>E-Katalog</h4></div>
    <hr class="mx-3">
    <a href="../dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
    <a href="../infoUser.php"><i class="fas fa-users me-2"></i> Data User</a>
    <a href="index.php" class="active"><i class="fas fa-hamburger me-2"></i> Kelola Makanan</a>
    <a href="../logout.php" class="text-danger mt-5"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a>
</div>

<div class="content">
    <div class="mb-4">
        <h2>Edit Detail Menu</h2>
        <p class="text-muted">Perbarui informasi makanan pada katalog Anda.</p>
    </div>

    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama Makanan</label>
                <input type="text" name="nama_makanan" class="form-control" value="<?= $row['nama_makanan']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold d-block">Foto Produk Saat Ini</label>
                <img src="../../assets/img/<?= $row['gambar']; ?>" class="img-preview">
                <input type="file" name="gambar" class="form-control">
                <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti gambar</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" name="update" class="btn btn-warning px-4 fw-bold">Simpan Perubahan</button>
                <a href="index.php" class="btn btn-light px-4 border">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>