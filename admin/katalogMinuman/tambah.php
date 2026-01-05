<?php
session_start();
include '../../config/config.php';

if (isset($_POST['save'])) {
    $nama = $_POST['nama_minuman'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar_minuman']['name'];
    $tmp = $_FILES['gambar_minuman']['tmp_name'];

    if (move_uploaded_file($tmp, "../../assets/img/" . $gambar)) {
        mysqli_query($conn, "INSERT INTO minuman (nama_minuman, harga, gambar_minuman) VALUES ('$nama', '$harga', '$gambar')");
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Minuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 600px;">
        <div class="card p-4 shadow-sm border-0">
            <h3>Tambah Minuman Baru</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Nama Minuman</label>
                    <input type="text" name="nama_minuman" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label>Gambar Minuman</label>
                    <input type="file" name="gambar_minuman" class="form-control" required>
                </div>
                <button name="save" class="btn btn-primary w-100">Simpan Produk</button>
                <a href="index.php" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>