<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0); // Preflight request handled
}

echo json_encode(["status" => "Garbage cleanup completed successfully."]);

@ini_set('zlib.output_compression', 'Off');
@ini_set('output_buffering', 'Off');
@ini_set('output_handler', '');

function getChunkCount() {
    $defaultChunks = 4;
    if (!isset($_GET['ckSize']) || !ctype_digit($_GET['ckSize'])) {
        return $defaultChunks;
    }

    $size = (int)$_GET['ckSize'];
    return ($size > 0 && $size <= 1024) ? $size : $defaultChunks;
}

function sendHeaders() {
    header('HTTP/1.1 200 OK');
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=random.dat');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
}

$chunks = getChunkCount();
$data = openssl_random_pseudo_bytes(1048576); // 1MB

sendHeaders();

for ($i = 0; $i < $chunks; $i++) {
    echo $data;
    flush();
}
?>
