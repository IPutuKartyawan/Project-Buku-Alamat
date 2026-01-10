<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../config/database.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if ($email === '' || $pass === '') {
        $error = "Email dan password wajib diisi.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: ../dashboard.php");
            exit;
        } else {
            $error = "Email atau password salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Buku Alamat</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="brand">Buku Alamat</div>
    <div>
        <a href="register.php">Register</a>
    </div>
</div>

<div class="container">
    <h2>Login</h2>

    <?php if ($error): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun?
        <a href="register.php">Daftar di sini</a>
    </p>
</div>

<div class="footer">
    &copy; <?= date('Y'); ?> Buku Alamat
</div>

</body>
</html>
