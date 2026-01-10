<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../check_session.php';
require_once __DIR__ . '/../config/database.php';

$baseUrl =
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST']
    . dirname(dirname($_SERVER['SCRIPT_NAME']));

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header("Location: index.php");
    exit;
}


$sql = "
    SELECT id, name
    FROM contacts
    WHERE id = :id
      AND user_id = :user_id
";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $id,
    ':user_id' => $_SESSION['user_id']
]);

$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    header("Location: index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {

        $deleteSql = "
            DELETE FROM contacts
            WHERE id = :id
              AND user_id = :user_id
        ";
        $delete = $pdo->prepare($deleteSql);
        $delete->execute([
            ':id' => $id,
            ':user_id' => $_SESSION['user_id']
        ]);
    }

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Kontak</title>
    <link rel="stylesheet" href="<?= $baseUrl ?>/asset/style.css">
</head>
<body>


<div class="navbar">
    <div class="brand">Buku Alamat</div>
    <div class="nav-link">
        <a href="<?= $baseUrl ?>/dashboard.php">Dashboard</a>
        <a href="<?= $baseUrl ?>/contacts/index.php">Kontak</a>
        <a href="<?= $baseUrl ?>/auth/logout.php">Logout</a>
    </div>
</div>


<div class="container">
    <h2>Konfirmasi Hapus Kontak</h2>

    <div class="alert alert-error">
        Apakah Anda yakin ingin menghapus kontak
        <strong><?= htmlspecialchars($contact['name']); ?></strong>?
        <br>
        Tindakan ini <strong>tidak dapat dibatalkan</strong>.
    </div>

    <form method="post">
        <button type="submit" name="confirm" value="yes" class="btn btn-danger">
            Ya, Hapus
        </button>

        <a href="index.php" class="btn btn-secondary">
            Batal
        </a>
    </form>
</div>


<div class="footer">
    &copy; <?= date('Y'); ?> Sistem Buku Alamat | PHP Native
</div>

</body>
</html>
