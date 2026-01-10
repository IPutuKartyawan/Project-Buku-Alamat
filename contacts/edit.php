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
    SELECT id, name, phone, email, address, category
    FROM contacts
    WHERE id = :id AND user_id = :user_id
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


$errors   = [];
$name     = $contact['name'];
$phone    = $contact['phone'];
$email    = $contact['email'];
$address  = $contact['address'];
$category = $contact['category'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = trim($_POST['name'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $address  = trim($_POST['address'] ?? '');
    $category = trim($_POST['category'] ?? '');

    if ($name === '') {
        $errors[] = "Nama wajib diisi.";
    }

    if ($phone === '') {
        $errors[] = "Nomor telepon wajib diisi.";
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if (empty($errors)) {
        $updateSql = "
            UPDATE contacts
            SET name = :name,
                phone = :phone,
                email = :email,
                address = :address,
                category = :category
            WHERE id = :id
              AND user_id = :user_id
        ";

        $update = $pdo->prepare($updateSql);
        $update->execute([
            ':name'     => $name,
            ':phone'    => $phone,
            ':email'    => $email,
            ':address'  => $address,
            ':category' => $category,
            ':id'       => $id,
            ':user_id'  => $_SESSION['user_id']
        ]);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kontak</title>
    <link rel="stylesheet" href="../assets/style.css">
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
    <h2>Edit Kontak</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post">
        <label>Nama</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name); ?>" required>

        <label>Telepon</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($phone); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email); ?>">

        <label>Alamat</label>
        <textarea name="address"><?= htmlspecialchars($address); ?></textarea>

        <label>Kategori</label>
        <select name="category">
            <option value="">-- Pilih Kategori --</option>
            <option value="Keluarga" <?= $category=='Keluarga'?'selected':''; ?>>Keluarga</option>
            <option value="Teman" <?= $category=='Teman'?'selected':''; ?>>Teman</option>
            <option value="Kerja" <?= $category=='Kerja'?'selected':''; ?>>Kerja</option>
            <option value="Lainnya" <?= $category=='Lainnya'?'selected':''; ?>>Lainnya</option>
        </select>

        <button type="submit">Update Kontak</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>


<div class="footer">
    &copy; <?= date('Y'); ?> Sistem Buku Alamat | PHP Native
</div>

</body>
</html>
