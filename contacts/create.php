<?php



ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../check_session.php';
require_once __DIR__ . '/../config/database.php';


$errors = [];
$name = $phone = $email = $address = $category = '';


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

        $sql = "
            INSERT INTO contacts
            (user_id, name, phone, email, address, category)
            VALUES
            (:user_id, :name, :phone, :email, :address, :category)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id'  => $_SESSION['user_id'],
            ':name'     => $name,
            ':phone'    => $phone,
            ':email'    => $email,
            ':address'  => $address,
            ':category' => $category
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
    <title>Tambah Kontak</title>
    <link rel="stylesheet" href="/asset/style.css">
</head>
<body>


<div class="navbar">
    <a href="/dashboard.php">Dashboard</a>
    <a href="/contacts/index.php">Kontak</a>
    <a href="/auth/logout.php">Logout</a>
</div>


<div class="container">
    <h2>Tambah Kontak Baru</h2>

   
    <?php if (!empty($errors)): ?>
        <div style="color:red; margin-bottom:15px;">
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

        <button type="submit">Simpan Kontak</button>
        <a href="index.php">Batal</a>
    </form>
</div>


<div class="footer">
    &copy; <?= date('Y'); ?> Sistem Buku Alamat | PHP Native
</div>

</body>
</html>
