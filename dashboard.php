<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/check_session.php';
require_once __DIR__ . '/config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="brand">Buku Alamat</div>
    <div class="nav-link">
        <a href="dashboard.php">Dashboard</a>
        <a href="contacts/index.php">Kontak</a>
        <a href="auth/logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Dashboard</h2>

    <p>
        Selamat datang,
        <strong><?= htmlspecialchars($_SESSION['user_name']); ?></strong>
    </p>

    <p>
        Melalui halaman ini, pengguna dapat mengelola seluruh
        data kontak yang dimiliki, mulai dari menambah, mengubah,
        menghapus, hingga melihat detail informasi kontak secara terstruktur.
    </p>
</div>

<div class="footer">
    &copy; <?= date('Y'); ?> Buku Alamat Kenalan | Simpan Kontak dan Informasi
</div>

</body>
</html>
