<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../check_session.php';


require_once __DIR__ . '/../config/database.php';


$filename = "kontak_" . date('Ymd_His') . ".csv";


header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');


$output = fopen('php://output', 'w');


fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));


fputcsv($output, [
    'Nama',
    'Telepon',
    'Email',
    'Alamat',
    'Kategori'
]);


$sql = "
    SELECT name, phone, email, address, category
    FROM contacts
    WHERE user_id = :user_id
    ORDER BY name ASC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':user_id' => $_SESSION['user_id']
]);


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, [
        $row['name'],
        $row['phone'],
        $row['email'],
        $row['address'],
        $row['category']
    ]);
}

fclose($output);
exit;
