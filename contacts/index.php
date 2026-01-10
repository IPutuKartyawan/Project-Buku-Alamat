<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../check_session.php';

require_once __DIR__ . '/../config/database.php';

$search = $_GET['search'] ?? '';
$search = trim($search);

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

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kontak</title>
    <link rel="stylesheet" href="/asset/style.css">
</head>
<body>

<div class="navbar">
    <a href="/dashboard.php">Dashboard</a>
    <a href="/contacts/index.php">Kontak</a>
    <a href="/auth/logout.php">Logout</a>
</div>

<div class="container">
    <h2>Daftar Kontak</h2>


    <form method="get">
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
        <a href="create.php">+ Tambah Kontak</a> |
        <a href="export_csv.php">Export CSV</a>
    </p>

    
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($contacts) > 0): ?>
            <?php foreach ($contacts as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['name']); ?></td>
                    <td><?= htmlspecialchars($c['phone']); ?></td>
                    <td><?= htmlspecialchars($c['category']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $c['id']; ?>">Edit</a> |
                        <a
                            href="delete.php?id=<?= $c['id']; ?>"
                            onclick="return confirm('Yakin ingin menghapus kontak ini?')"
                        >
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Data kontak tidak ditemukan.</td>
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
