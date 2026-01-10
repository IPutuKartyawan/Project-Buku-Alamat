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
    <title>Registrasi Pengguna</title>
    <link rel="stylesheet" href="/asset/style.css">
</head>
<body>

<h2>Registrasi Buku Alamat</h2>

<?php if ($message): ?>
    <p style="color:red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <label>Nama Lengkap</label><br>
    <input type="text" name="name"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Daftar</button>
</form>

<p>Sudah punya akun? <a href="login.php">Login</a></p>

</body>
</html>
