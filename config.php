<?php
header("Content-Type: application/json");

echo json_encode([
  "MYSQLHOST" => getenv("MYSQLHOST"),
  "MYSQLPORT" => getenv("MYSQLPORT"),
  "MYSQLDATABASE" => getenv("MYSQLDATABASE"),
  "MYSQLUSER" => getenv("MYSQLUSER"),
  "MYSQLPASSWORD_IS_SET" => getenv("MYSQLPASSWORD") ? "YES" : "NO",
]);

exit;
