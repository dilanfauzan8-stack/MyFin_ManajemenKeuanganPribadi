<?php
include '../app/config/db.php';
header("Content-Type: application/json");

$q = $pdo->query("SELECT * FROM transactions");
$data = $q->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);
