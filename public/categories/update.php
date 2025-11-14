<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";

$id = $_POST['id'];
$name = trim($_POST['name']);
$type = trim($_POST['type']);

if ($name === '' || !in_array($type, ['income', 'expense'])) {
    die("Input tidak valid!");
}

$stmt = $pdo->prepare("UPDATE categories SET name=?, type=? WHERE id=? AND user_id=?");
$stmt->execute([$name, $type, $id, $_SESSION['user_id']]);

header("Location: index.php");
exit();
