<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";

$category_id = $_POST['category_id'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$description = trim($_POST['description']);

if ($category_id == '' || $amount <= 0 || $date == '') {
    die("Input tidak valid!");
}

$stmt = $pdo->prepare("
    INSERT INTO transactions (user_id, category_id, amount, description, date)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->execute([$_SESSION['user_id'], $category_id, $amount, $description, $date]);

header("Location: index.php");
exit();
