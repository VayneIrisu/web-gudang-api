<?php
require __DIR__ . "/cors.php";
require __DIR__ . "/../config.php"; //DB

/* === READ JSON === */
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
  echo json_encode(["message" => "Request kosong"]);
  exit;
}

$username = $data["username"] ?? "";
$password = $data["password"] ?? "";

/* === CEK USERNAME === */
$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  http_response_code(401);
  echo json_encode(["message" => "Username tidak ditemukan"]);
  exit;
}

/* === CEK PASSWORD === */
if ($user["password"] !== $password) {
  http_response_code(401);
  echo json_encode(["message" => "Password salah"]);
  exit;
}

/* === LOGIN SUKSES === */
$payload = [
  "id" => $user["id"],
  "username" => $user["username"],
  "name" => $user["name"] ?? $user["username"], // Fallback to username if nama is empty
  "akses" => [
    "inputMasuk" => (bool)$user["input_barang_masuk"],
    "inputKeluar" => (bool)$user["input_barang_keluar"]
  ]
];

echo json_encode([
  "message" => "Login berhasil",
  "user" => $payload
]);