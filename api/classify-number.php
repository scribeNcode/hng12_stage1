<?php 

// set cores
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');




// check if user input is  null and if it is not number type in order to handle invalid user input
if(!isset($_GET['number']) || !is_numeric($_GET['number'])){

  // if user doesnt set any number , set a user input to null and convert array to json
echo json_encode(['number'=> $_GET['number'] ?? "alphabet", 'error' => true]);


// send http response code to show the request is invalid
http_response_code(400);

//stop  execution
exit;

} 




// convert user input to number 
$number = intval($_GET['number']);

// process number entered by user 
$isEven = $number % 2 === 0;  //Checks if it's even or odd.
$digitSum = array_sum(str_split((string) $number)); //Calculates the sum of its digits.
$isArmstrong = isArmstrong($number);


// Fetches a fun fact from http://numbersapi.com.
$funFact = file_get_contents("http://numbersapi.com/$number/math");


// Determine properties array correctly
$properties = $isArmstrong ? 
    ($isEven ? ["armstrong", "even"] : ["armstrong", "odd"]) : 
    ($isEven ? ["even"] : ["odd"]);


// Creates a JSON response with all calculated properties and send it back to the frontend.
echo json_encode([
  "number" => $number,
  "is_prime" => isPrime($number),
  "is_perfect" => isPerfect($number),
  "properties" =>  $properties,
  "digit_sum" => $digitSum,
  "fun_fact" => $funFact
]);

// Define Functions

// Function to check if a number is an Armstrong number
function isArmstrong($num) {
  $sum = 0;
  $digits = str_split((string) abs($num)); // Convert number to array of digits
  $power = count($digits);

  foreach ($digits as $digit) {
      $sum += pow($digit, $power);
  }

  return $sum == abs($num);
}


// Function to check if a number is prime
function isPrime($num) {
  if ($num < 2) return false;
  for ($i = 2; $i <= sqrt($num); $i++) {
      if ($num % $i == 0) return false;
  }
  return true;
}

// Function to check if a number is perfect
function isPerfect($num) {
  if ($num < 1) return false;
  $sum = 0;
  for ($i = 1; $i < $num; $i++) {
      if ($num % $i == 0) {
          $sum += $i;
      }
  }
  return $sum == $num;
}




?>


