<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: https://web-gudang-seven.vercel.app");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

/* === DB === */
require __DIR__ . "/../config.php";

try {
    // Get all materials with stock information
    $query = "SELECT nomer_material, nama_material, satuan, stok FROM tbl_master_material ORDER BY nomer_material ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($materials);

}
catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
?>
