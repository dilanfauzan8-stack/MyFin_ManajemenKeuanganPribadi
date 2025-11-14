<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";

$id = $_POST['id'];
$category_id = $_POST['category_id'];
$amount = $_POST['amount'];
$date = $_POST['date'];
$description = trim($_POST['description']);

$stmt = $pdo->prepare("
    UPDATE transactions 
    SET category_id=?, amount=?, date=?, description=? 
    WHERE id=? AND user_id=?
");

$stmt->execute([$category_id, $amount, $date, $description, $id, $_SESSION['user_id']]);

header("Location: index.php");
exit();
