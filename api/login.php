<?php
include '../app/config/db.php';
header("Content-Type: application/json");

// ambil data JSON dari frontend / Postman
$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

// validasi sederhana
if ($email == '' || $password == '') {
    http_response_code(400);
    echo json_encode([
        "status" => false,
        "message" => "Email dan password wajib diisi"
    ]);
    exit;
}

// cari user
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// cek password
if ($user && password_verify($password, $user['password'])) {
    echo json_encode([
        "status" => true,
        "message" => "Login berhasil",
        "token" => base64_encode($user['id']),
        "user" => [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email']
        ]
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        "status" => false,
        "message" => "Email atau password salah"
    ]);
}

