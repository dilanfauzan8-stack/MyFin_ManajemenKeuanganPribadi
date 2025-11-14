<?php
session_start();
require_once "../app/config/db.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

if ($username === '' || $password === '') {
    $_SESSION['error'] = "Username dan password wajib diisi!";
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT id, username, password, fullname, role, remember_token FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['error'] = "Username tidak ditemukan!";
    header("Location: login.php");
    exit();
}

if (!password_verify($password, $user['password'])) {
    $_SESSION['error'] = "Password salah!";
    header("Location: login.php");
    exit();
}

// ==== LOGIN BERHASIL ====
session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['fullname'] = $user['fullname'];
$_SESSION['role'] = $user['role'];


// ===== REMEMBER ME =====
if (isset($_POST['remember'])) {

    // buat token aman
    $token = bin2hex(random_bytes(32));  

    // simpan token ke database
    $update = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
    $update->execute([$token, $user['id']]);

    // simpan token ke cookie (7 hari)
    setcookie("remember_me", $token, time() + (86400 * 7), "/", "", false, true);
}

header("Location: index.php");
exit();
