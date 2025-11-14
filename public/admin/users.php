<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/middleware/admin.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

$stmt = $pdo->query("SELECT id, fullname, username, role FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="page-header">
    <h1>Kelola User</h1>
    <p>Admin dapat melihat dan menghapus akun user.</p>
</section>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert error">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>
<a href="create_user.php" class="btn-primary" style="margin-bottom:1rem; display:inline-block;">
    + Tambah User
</a>

<table class="table-basic">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['fullname']) ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['role']) ?></td>

<td>
    <?php if ($u['id'] != $_SESSION['user_id']): ?>
        <a href="reset_password.php?id=<?= $u['id'] ?>"
           class="btn-sm info">
           Reset Password
        </a>

        <a href="delete_user.php?id=<?= $u['id'] ?>"
           class="btn-sm danger"
           onclick="return confirm('Yakin ingin menghapus user ini?')">
           Hapus
        </a>
    <?php else: ?>
        <span style="color:#94a3b8;">(akun sendiri)</span>
    <?php endif; ?>
</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../../app/views/templates/footer.php"; ?>
