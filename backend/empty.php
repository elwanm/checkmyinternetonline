<?php
// Set headers before any output is sent
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, s-maxage=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Connection: keep-alive');

// Check for CORS query parameter and add extra headers if needed
if (isset($_GET['cors'])) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header('Access-Control-Allow-Headers: Content-Encoding, Content-Type');
}

// Set response code and return JSON data
header('HTTP/1.1 200 OK');
echo json_encode(["status" => "Empty cleanup completed successfully."]);
exit; // Ensure no further output after sending the response
?>
