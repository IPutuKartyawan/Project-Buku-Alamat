<?php


require '../check_session.php';
require '../config/database.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=kontak.csv');

$output = fopen("php://output", "w");
fputcsv($output, ['Nama','Telepon','Email','Kategori']);

$stmt = $pdo->prepare(
    "SELECT name,phone,email,category FROM contacts WHERE user_id=?"
);
$stmt->execute([$_SESSION['user_id']]);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, $row);
}
fclose($output);


