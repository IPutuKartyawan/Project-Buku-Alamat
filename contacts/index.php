<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../check_session.php';
require_once __DIR__ . '/../config/database.php';

$baseUrl =
    (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
    . '://' . $_SERVER['HTTP_HOST']
    . dirname(dirname($_SERVER['SCRIPT_NAME']));

$search   = trim($_GET['search'] ?? '');
$userRole = $_SESSION['user_role'] ?? 'user';


if ($userRole === 'admin') {

    $sql = "
        SELECT 
            contacts.id,
            contacts.name,
            contacts.phone,
            contacts.category,
            users.name AS owner
        FROM contacts
        JOIN users ON contacts.user_id = users.id
        WHERE contacts.name LIKE :keyword
           OR contacts.phone LIKE :keyword
        ORDER BY contacts.name ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':keyword' => '%' . $search . '%'
    ]);

} else {

    $sql = "
        SELECT id, name, phone, category
        FROM contacts
        WHERE user_id = :user_id
          AND (
                name LIKE :keyword
                OR phone LIKE :keyword
              )
        ORDER BY name ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $_SESSION['user_id'],
        ':keyword' => '%' . $search . '%'
    ]);
}

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kontak</title>
    <link rel="stylesheet" href="<?= $baseUrl ?>/assets/style.css">
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
    <h2>Daftar Kontak</h2>

    <form method="get" class="search-box">
        <label for="search">Cari Kontak</label>
        <input
            type="text"
            name="search"
            id="search"
            placeholder="Nama atau nomor telepon"
            value="<?= htmlspecialchars($search); ?>"
        >
        <button type="submit">Cari</button>
    </form>

    <p>
        <a href="create.php" class="btn">+ Tambah Kontak</a>
        <a href="export_csv.php" class="btn btn-secondary">Export CSV</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Kategori</th>

                <?php if ($userRole === 'admin'): ?>
                    <th>Pemilik</th>
                <?php endif; ?>

                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($contacts)): ?>
            <?php foreach ($contacts as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['name']); ?></td>
                    <td><?= htmlspecialchars($c['phone']); ?></td>
                    <td><?= htmlspecialchars($c['category']); ?></td>

                    <?php if ($userRole === 'admin'): ?>
                        <td><?= htmlspecialchars($c['owner']); ?></td>
                    <?php endif; ?>

                    <td>
                        <a href="edit.php?id=<?= $c['id']; ?>" class="btn btn-secondary">Edit</a>
                        <a
                            href="delete.php?id=<?= $c['id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus kontak ini?')"
                        >
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?= $userRole === 'admin' ? 5 : 4; ?>" style="text-align:center;">
                    Data kontak tidak ditemukan.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="footer">
    &copy; <?= date('Y'); ?> Sistem Buku Alamat | PHP Native
</div>

</body>
</html>
