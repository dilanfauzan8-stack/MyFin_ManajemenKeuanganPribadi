<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

// Ambil kategori milik user login
$stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$_SESSION['user_id']]);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="page-header">
    <h1>Kategori</h1>
    <p>Kelola kategori pemasukan dan pengeluaran Anda.</p>
</section>

<a href="create.php" class="btn-primary" style="margin-bottom:1rem; display:inline-block;">
    + Tambah Kategori
</a>

<section class="page-section">
<table class="table-basic">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($categories)): ?>
            <tr><td colspan="3">Belum ada kategori.</td></tr>
        <?php else: ?>
            <?php foreach ($categories as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= $c['type'] == 'income' ? 'Pemasukan' : 'Pengeluaran' ?></td>
                    <td>
                        <a class="btn-sm info" href="edit.php?id=<?= $c['id'] ?>">Edit</a>
                        <a class="btn-sm danger" 
                           onclick="return confirm('Yakin ingin hapus kategori?')"
                           href="delete.php?id=<?= $c['id'] ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
</section>

<?php include "../../app/views/templates/footer.php"; ?>
