<?php
session_start();
include '../../config/config.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM minuman WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_minuman'];
    $harga = $_POST['harga'];
    
    if ($_FILES['gambar_minuman']['name'] != "") {
        $gambar = $_FILES['gambar_minuman']['name'];
        move_uploaded_file($_FILES['gambar_minuman']['tmp_name'], "../../assets/img/" . $gambar);
        $sql = "UPDATE minuman SET nama_minuman='$nama', harga='$harga', gambar_minuman='$gambar' WHERE id=$id";
    } else {
        $sql = "UPDATE minuman SET nama_minuman='$nama', harga='$harga' WHERE id=$id";
    }
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>