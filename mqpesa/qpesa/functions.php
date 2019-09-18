<?php
function generateToken()
{
	# we generate token key
$headers = ['Content-Type:application/json; Charset:utf8'];
$consumerKey ='YOUR CUSTOMER KEY';
$consumerSecret ='YOUR CUSTOMER SECRET';

$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD,$consumerKey.":".$consumerSecret);

$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$result = json_decode($result);

$access_token = $result->access_token;
return $access_token;

curl_close($curl);
}


// Function to register url
function registerUrl(){

  $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.generateToken())); //setting custom header
  
  $ShortCode = '600427';
  $ResponseType = 'Completed';
  $ConfirmationURL = 'https://jolly-fox-53.localtunnel.me/mqpesa/qpesa/confirmation/index.php';
  $ValidationURL = 'https://jolly-fox-53.localtunnel.me/mqpesa/qpesa/validation/index.php';
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'ShortCode' => $ShortCode,
    'ResponseType' => $ResponseType,
    'ConfirmationURL' => $ConfirmationURL,
    'ValidationURL' => $ValidationURL
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  // print_r($curl_response);
  
  // echo $curl_response;
return $curl_response;

}

// function to perform simulation for C2B


function simulateC2B()
{
	
  $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.generateToken())); //setting custom header

  $ShortCode = '600000';
  $CommandID = 'CustomerPayBillOnline';
  $Amount = '570';
  $Msisdn = '254708374149'; // customer number in the format +2547000000 but remove '+'' sign.
  $BillRefNumber = 'invoice001'; //referesnce code e.g customer idno
  
    $curl_post_data = array(
            //Fill in the request parameters with valid values
           'ShortCode' => $ShortCode,
           'CommandID' => $CommandID,
           'Amount' => $Amount,
           'Msisdn' => $Msisdn,
           'BillRefNumber' => $BillRefNumber
    );
  
    $data_string = json_encode($curl_post_data);
  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
    $curl_response = curl_exec($curl);
    // print_r($curl_response);
  
    return $curl_response;
  
}


function logResponse()
{

/*LOG DATA HERE*/
echo "logging file... <br />";
$data = file_get_contents('php://stdin');
//$data = "Sample example";
$handle = fopen('Validation.txt', 'a');
$file = fwrite($handle, $data);

return $file;
}
 ?>
