<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";

$name = trim($_POST['name']);
$type = trim($_POST['type']);

if ($name === '' || !in_array($type, ['income', 'expense'])) {
    die("Input tidak valid!");
}

$stmt = $pdo->prepare("INSERT INTO categories (user_id, name, type) VALUES (?, ?, ?)");
$stmt->execute([$_SESSION['user_id'], $name, $type]);

header("Location: index.php");
exit();
