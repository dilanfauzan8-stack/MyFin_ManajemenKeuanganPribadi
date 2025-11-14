<?php
session_start();
require_once "../app/config/db.php";

if (isset($_SESSION['user_id'])) {

    // hapus token di database
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

// hapus cookie
setcookie("remember_me", "", time() - 3600, "/");

// hapus session
session_unset();
session_destroy();

header("Location: login.php");
exit();
