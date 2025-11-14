<?php
session_start();
require_once "../../app/config/db.php";
require_once "../../app/middleware/auth.php";
require_once "../../app/middleware/admin.php";

$id = $_POST['id'] ?? null;
$pass = $_POST['password'] ?? '';
$confirm = $_POST['password_confirm'] ?? '';

if (!$id || $pass === '' || $confirm === '') {
    $_SESSION['error'] = "Semua field wajib diisi.";
    header("Location: users.php");
    exit();
}

if ($pass !== $confirm) {
    $_SESSION['error'] = "Password dan konfirmasi tidak sama.";
    header("Location: reset_password.php?id=" . $id);
    exit();
}

$hashed = password_hash($pass, PASSWORD_BCRYPT);

$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->execute([$hashed, $id]);

$_SESSION['success'] = "Password user berhasil direset.";
header("Location: users.php");
exit();
