<?php

require '../check_session.php';
require '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare(
    "SELECT * FROM contacts WHERE id=? AND user_id=?"
);
$stmt->execute([$id, $_SESSION['user_id']]);
$contact = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update = $pdo->prepare(
        "UPDATE contacts SET name=?, phone=?, category=? 
         WHERE id=? AND user_id=?"
    );
    $update->execute([
        $_POST['name'],
        $_POST['phone'],
        $_POST['category'],
        $id,
        $_SESSION['user_id']
    ]);

    header("Location: index.php");
}
