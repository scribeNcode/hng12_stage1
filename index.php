<?php
// Enable CORS and JSON response
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Get the request URI and script name
$request_uri = trim($_SERVER['REQUEST_URI'], '/');
$script_name = trim($_SERVER['SCRIPT_NAME'], '/');

// Remove the script name from the URI
$endpoint = str_replace($script_name, '', $request_uri);
$endpoint = trim($endpoint, '/');

// Route requests
if ($endpoint === 'api/classify-number') {
    require __DIR__ . '/api/classify-number.php'; // Correct path
} else {
    http_response_code(404);
    echo json_encode(["error" => "Invalid endpoint. Use /api/classify-number?number=371"]);
}
?>

