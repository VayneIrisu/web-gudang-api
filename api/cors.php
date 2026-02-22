<?php
// api/cors.php

// ⚠️ PENTING: jangan ada spasi / BOM sebelum ini

header("Access-Control-Allow-Origin: https://web-gudang-seven.vercel.app");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// ⛔ HANDLE PREFLIGHT SEBELUM APAPUN
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    echo json_encode(["status" => "preflight ok"]);
    exit;
}