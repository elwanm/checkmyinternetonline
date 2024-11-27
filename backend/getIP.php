<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$ip = $_SERVER['REMOTE_ADDR'];

// Fetching ISP and Country information
function getIspInfo($ip) {
    $apiToken = '652c590dac3eb4'; // Your IPInfo token
    $url = 'https://ipinfo.io/' . $ip . '/json?token=' . $apiToken;

    try {
        $response = @file_get_contents($url);
        if (!$response) {
            return ["error" => "Unable to fetch ISP info"];
        }

        $data = json_decode($response, true);
        return [
            'ip' => $data['ip'] ?? 'Unknown',
            'org' => $data['org'] ?? 'Unknown',
            'country' => $data['country'] ?? 'Unknown'
        ];
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}

$info = getIspInfo($ip);
echo json_encode($info);
?>
