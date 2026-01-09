<?php

require '../check_session.php';
require '../config/database.php';

$search = $_GET['search'] ?? '';

$stmt = $pdo->prepare(
    "SELECT * FROM contacts
     WHERE user_id=? AND 
     (name LIKE ? OR phone LIKE ?)
     ORDER BY name ASC"
);

$stmt->execute([
    $_SESSION['user_id'],
    "%$search%",
    "%$search%"
]);

$contacts = $stmt->fetchAll();
?>

<h3>Daftar Kontak</h3>
<form method="get">
    <input type="text" name="search" placeholder="Cari kontak">
    <button>Cari</button>
</form>

<a href="create.php">Tambah Kontak</a> |
<a href="export_csv.php">Export CSV</a>

<table border="1">
<tr>
    <th>Nama</th><th>Telepon</th><th>Kategori</th><th>Aksi</th>
</tr>
<?php foreach ($contacts as $c): ?>
<tr>
    <td><?= htmlspecialchars($c['name']); ?></td>
    <td><?= $c['phone']; ?></td>
    <td><?= $c['category']; ?></td>
    <td>
        <a href="edit.php?id=<?= $c['id']; ?>">Edit</a> |
        <a href="delete.php?id=<?= $c['id']; ?>">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
