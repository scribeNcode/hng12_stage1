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


// convert user input to number 
$number = intval($_GET['number']);

// process number entered by user 
$isEven = $number % 2 === 0;  //Checks if it's even or odd.
$digitSum = array_sum(str_split((string) $number)); //Calculates the sum of its digits.


// Fetches a fun fact from http://numbersapi.com.
$funFact = file_get_contents("http://numbersapi.com/$number/math");



// Creates a JSON response with all calculated properties and send it back to the frontend.
echo json_encode([
  "number" => $number,
  "is_prime" => isPrime($number),
  "is_perfect" => isPerfect($number),
  "properties" => $isEven ? ["even"] : ["odd"],
  "digit_sum" => $digitSum,
  "fun_fact" => $funFact
]);

?>


