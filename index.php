<?php 

// set cores
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// check if user input is  null and if it is not number type in order to handle invalid user input
if(!isset($_GET['number']) || !is_numeric($_GET['number'])); 

// if user doesnt set any number , set a user input to null and convert array to json
echo json_encode(['number'=> $_GET['number'] ?? null, 'error' => true, 'message' => 'number is required']);

// send http response code to show the request is invalid
http_response_code(400);

//stop  execution
exit;
?>