<?php
session_start();
require_once "../../app/config/db.php";
require_once "../../app/middleware/auth.php";
require_once "../../app/middleware/admin.php";

$fullname = trim($_POST['fullname'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$role     = $_POST['role'] ?? 'user';

if ($fullname === '' || $username === '' || $password === '') {
    $_SESSION['error'] = "Semua field wajib diisi.";
    header("Location: create_user.php");
    exit();
}

// cek username unik
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = "Username sudah digunakan.";
    header("Location: create_user.php");
    exit();
}

$hashed = password_hash($password, PASSWORD_BCRYPT);

$insert = $pdo->prepare("
    INSERT INTO users (fullname, username, password, role)
    VALUES (?, ?, ?, ?)
");
$insert->execute([$fullname, $username, $hashed, $role]);

$_SESSION['success'] = "User baru berhasil dibuat.";
header("Location: users.php");
exit();
