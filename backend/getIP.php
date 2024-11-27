<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$ip = $_SERVER['REMOTE_ADDR'];

// Fetching the ISP and Country information
function getIspInfo($ip) {
    $json = file_get_contents('https://ipinfo.io/' . $ip . '/json?token=652c590dac3eb4');
    $data = json_decode($json, true);
    return [
        'processedString' => $data['ip'] . ' - ' . $data['org'] . ', ' . $data['country']
    ];
}

$info = getIspInfo($ip);
echo json_encode($info);
?>
