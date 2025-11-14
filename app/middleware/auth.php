<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// PATH DB FIX 100%
require_once __DIR__ . '/../config/db.php';

// === AUTO LOGIN COOKIE ===
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {

    $token = $_COOKIE['remember_me'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];

        session_regenerate_id(true);
    }
}

// === BLOKIR JIKA BELUM LOGIN ===
if (!isset($_SESSION['user_id'])) {
    header("Location: /keuangan_pribadi/public/login.php");
    exit();
}
