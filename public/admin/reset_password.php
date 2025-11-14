<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/middleware/admin.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT id, fullname, username FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['error'] = "User tidak ditemukan.";
    header("Location: users.php");
    exit();
}
?>

<section class="page-header">
    <h1>Reset Password User</h1>
    <p>Setel ulang password untuk user: <strong><?= htmlspecialchars($user['username']) ?></strong></p>
</section>

<section class="page-section">
    <form action="reset_password_process.php" method="POST" class="form-basic" style="max-width:400px;">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <label>Password Baru</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password Baru</label>
        <input type="password" name="password_confirm" required>

        <button class="btn-primary" type="submit">Simpan Password Baru</button>
    </form>
</section>

<?php include "../../app/views/templates/footer.php"; ?>
