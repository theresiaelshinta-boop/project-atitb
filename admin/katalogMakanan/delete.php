<?php
include '../../config/config.php';
$id = $_GET['id'];

// Hapus file gambar dari folder
$data = mysqli_query($conn, "SELECT gambar FROM produk WHERE id=$id");
$row = mysqli_fetch_assoc($data);
unlink("../../assets/img/" . $row['gambar']);

// Hapus data dari database
mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
header("Location: index.php");
?>