<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/check_session.php';
require_once __DIR__ . '/config/database.php';


$baseUrl =
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST']
    . dirname($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>


    <link rel="stylesheet" href="<?= $baseUrl ?>/asset/style.css">
</head>
<body>

<div class="navbar">
    <div class="brand">Buku Alamat</div>
    <div class="nav-link">
        <a href="<?= $baseUrl ?>/dashboard.php">Dashboard</a>
        <a href="<?= $baseUrl ?>/contacts/index.php">Kontak</a>
        <a href="<?= $baseUrl ?>/auth/logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Dashboard</h2>

    <p>
        Selamat datang,
        <strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong>
    </p>

    <p>
        Melalui dashboard ini, pengguna dapat mengelola seluruh
        data kontak yang dimiliki, mulai dari menambah, mengubah,
        menghapus, hingga melihat detail informasi kontak secara terstruktur.
    </p>
</div>

<div class="footer">
    &copy; <?= date('Y'); ?> Sistem Buku Alamat | PHP Native
</div>

</body>
</html>
