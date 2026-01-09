<?php

require '../check_session.php';
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO contacts 
        (user_id,name,phone,email,address,category)
        VALUES (?,?,?,?,?,?)"
    );

    $stmt->execute([
        $_SESSION['user_id'],
        htmlspecialchars($_POST['name']),
        $_POST['phone'],
        $_POST['email'],
        htmlspecialchars($_POST['address']),
        $_POST['category']
    ]);

    header("Location: index.php");
}
