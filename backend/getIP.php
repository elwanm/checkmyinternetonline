<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set response headers for JSON and CORS
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Function to fetch ISP and location details from IPInfo
function getIspInfo($ip) {
    $apiToken = '652c590dac3eb4'; // Replace with your valid IPInfo API token
    $url = 'https://ipinfo.io/' . $ip . '?token=' . $apiToken;

    // Fetch data using file_get_contents
    try {
        $response = @file_get_contents($url);

        if ($response === false) {
            return ["error" => "Unable to fetch ISP info. Check your API token or network connection."];
        }

        $data = json_decode($response, true);

        // Ensure necessary fields are available
        return [
            'ip' => $data['ip'] ?? 'Unknown',
            'org' => $data['org'] ?? 'Unknown ISP',
            'country' => $data['country'] ?? 'Unknown Country'
        ];
    } catch (Exception $e) {
        return ["error" => "Exception occurred: " . $e->getMessage()];
    }
}

// Get the client IP address
$ip = $_SERVER['REMOTE_ADDR'];

// Fetch ISP information
$info = getIspInfo($ip);

// Output JSON response
echo json_encode($info);
?>
