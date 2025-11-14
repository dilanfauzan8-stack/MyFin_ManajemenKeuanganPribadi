<?php
session_start();
require_once "../../app/config/db.php";
require_once "../../app/middleware/auth.php";
require_once "../../app/middleware/admin.php";

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id = $_GET['id'];

if ($id == $_SESSION['user_id']) {
    $_SESSION['error'] = "Tidak bisa menghapus akun sendiri!";
    header("Location: users.php");
    exit();
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

$_SESSION['success'] = "User berhasil dihapus.";
header("Location: users.php");
exit();
