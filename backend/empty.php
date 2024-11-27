<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0); // Preflight request handled, exit
}

header('HTTP/1.1 200 OK');
echo json_encode(["status" => "Empty cleanup completed successfully."]);
exit;
?>
