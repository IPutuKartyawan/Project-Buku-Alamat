<?php
/**
 * File   : index.php
 * Fungsi : Halaman awal aplikasi Buku Alamat
 * Catatan: PHP Native tanpa framework
 */

session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Alamat - PHP Native</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="auth/login.php">Login</a>
    <a href="auth/register.php">Registrasi</a>
</div>

<div class="container">
    <h1>📘 Aplikasi Buku Alamat</h1>

    <p>
        Aplikasi Buku Alamat ini dibuat menggunakan 
        <strong>PHP Native tanpa framework backend</strong>.
        Sistem ini memungkinkan pengguna untuk menyimpan,
        mengelola, dan mencari data kontak secara aman.
    </p>

    <p>
        Setiap pengguna harus melakukan autentikasi terlebih dahulu
        sebelum dapat mengakses dan mengelola data kontak pribadinya.
    </p>

    <h3>✨ Fitur Utama</h3>
    <ul>
        <li>Registrasi dan Login pengguna</li>
        <li>Manajemen kontak (CRUD)</li>
        <li>Pencarian dan pengelompokan kontak</li>
        <li>Manajemen sesi pengguna</li>
        <li>Ekspor data kontak ke CSV</li>
    </ul>

    <p>
        Silakan <a href="auth/login.php">Login</a> atau
        <a href="auth/register.php">Registrasi</a>
        untuk mulai menggunakan aplikasi.
    </p>
</div>

<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> | Project Pengembangan Backend - PHP Native</p>
</div>

</body>
</html>
