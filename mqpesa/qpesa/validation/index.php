<?php
header("Content-Type: application/json");

$data = file_get_contents('php://input');

$json_decode = json_decode($data);

//Grab inputs from the response

header("Content-Type: application/json");

$amount_recieved = $data['TransAmount'];//amount sent by the customer
$amount_expected = 150;//amount to be paid
if ($amount_recieved == $amount_expected) {
    
    //you can store data in the database
    //Then do other logics like proceed to next page
    
    $response = '{
    "ResultCode":0,
    "ResultDesc":"Payment recieved successfully"
}';

$json_response = json_encode($response);
echo $json_response;

} else {
    $response = '{
    "ResultCode":1,
    "ResultDesc":"Payment failed"
}';
$json_response = json_encode($response);
echo $json_response;
}
   
?>
