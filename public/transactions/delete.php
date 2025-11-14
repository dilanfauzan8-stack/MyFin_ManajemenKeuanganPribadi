<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM transactions WHERE id=? AND user_id=?");
$stmt->execute([$id, $_SESSION['user_id']]);

header("Location: index.php");
exit();
