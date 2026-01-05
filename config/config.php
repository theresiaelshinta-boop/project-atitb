<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "database_user";

// Menonaktifkan laporan error mysqli_sql_exception agar halaman tidak crash
mysqli_report(MYSQLI_REPORT_OFF);

// Mencoba koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Kita tidak menggunakan die() agar file dashboard tetap bisa terbaca sampai bawah
?>