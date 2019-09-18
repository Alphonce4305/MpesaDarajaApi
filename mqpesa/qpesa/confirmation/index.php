<?php
// my confirmation file
header("Content-Type: application/json");

$data = file_get_contents('php://input');

$json_decode = json_decode($data);
$handle = fopen('../logs/Mpesa_confirmation.txt', 'w');
fwrite($handle, $data);
fclose($handle);

   
?>
