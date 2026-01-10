<?php


require_once __DIR__ . '/check_session.php';
require_once __DIR__ . '/config/database.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="contacts/index.php">Kontak</a>
    <a href="auth/logout.php">Logout</a>
</div>

<div class="container">
    <h2>Dashboard</h2>
    <p>Selamat datang, <strong><?= $_SESSION['name']; ?></strong></p>

    <p>
        Melalui dashboard ini, pengguna dapat mengelola seluruh
        data kontak yang dimiliki.
    </p>
</div>

</body>
</html>
