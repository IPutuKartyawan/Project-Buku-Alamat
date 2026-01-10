<?php

require '../check_session.php';
require '../config/database.php';

$stmt = $pdo->prepare(
    "DELETE FROM contacts WHERE id=? AND user_id=?"
);
$stmt->execute([$_GET['id'], $_SESSION['user_id']]);

header("Location: index.php");

