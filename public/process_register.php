<?php
session_start();
require_once "../app/config/db.php";

$fullname = trim($_POST['fullname']);
$username = trim($_POST['username']);
$password = trim($_POST['password']);

if ($fullname === '' || $username === '' || $password === '') {
    $_SESSION['error'] = "Semua bidang wajib diisi!";
    header("Location: register.php");
    exit();
}

// cek username sudah dipakai atau belum
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = "Username sudah digunakan!";
    header("Location: register.php");
    exit();
}

// hash password
$hashed = password_hash($password, PASSWORD_BCRYPT);

// simpan user baru (role default = user)
$insert = $pdo->prepare("
    INSERT INTO users (fullname, username, password, role)
    VALUES (?, ?, ?, 'user')
");
$insert->execute([$fullname, $username, $hashed]);

$_SESSION['success'] = "Registrasi berhasil! Silakan login.";

header("Location: login.php");
exit();
