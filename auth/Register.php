<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../config/database.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $pass === '') {
        $message = "Semua field wajib diisi.";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );
        $stmt->execute([$name, $email, $hash]);

        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi | Buku Alamat</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="brand">Buku Alamat</div>
    <div>
        <a href="login.php">Login</a>
    </div>
</div>

<div class="container">
    <h2>Registrasi</h2>

    <?php if ($message): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <label>Nama Lengkap</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun?
        <a href="login.php">Login di sini</a>
    </p>
</div>

<div class="footer">
    &copy; <?= date('Y'); ?> Buku Alamat
</div>

</body>
</html>
