<?php

require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        die("Data tidak boleh kosong");
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare(
        "INSERT INTO users (name,email,password) VALUES (?,?,?)"
    );
    $stmt->execute([
        htmlspecialchars($_POST['name']),
        $_POST['email'],
        $password
    ]);

    header("Location: login.php");
}
?>
