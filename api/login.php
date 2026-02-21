<?php
header("Content-Type: application/json");
echo json_encode(PDO::getAvailableDrivers());
print_r(PDO::getAvailableDrivers());
exit;
