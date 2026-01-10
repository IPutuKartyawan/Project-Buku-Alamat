<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../check_session.php';
require_once __DIR__ . '/../config/database.php';


$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header("Location: index.php");
    exit;
}


$checkSql = "
    SELECT id
    FROM contacts
    WHERE id = :id
      AND user_id = :user_id
";
$checkStmt = $pdo->prepare($checkSql);
$checkStmt->execute([
    ':id' => $id,
    ':user_id' => $_SESSION['user_id']
]);

$contact = $checkStmt->fetch(PDO::FETCH_ASSOC);


if (!$contact) {
    header("Location: index.php");
    exit;
}


$deleteSql = "
    DELETE FROM contacts
    WHERE id = :id
      AND user_id = :user_id
";
$deleteStmt = $pdo->prepare($deleteSql);
$deleteStmt->execute([
    ':id' => $id,
    ':user_id' => $_SESSION['user_id']
]);


header("Location: index.php");
exit;
