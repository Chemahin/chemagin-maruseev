<?php

//header("Access-Control-Allow-Origin: *");
require_once(__DIR__.'/../../app/model/config.php');
require_once(__DIR__.'/../../app/model/functions.php');

enable_cors();

//$formData = json_encode($_REQUEST);
//$decodedFormData = json_decode($formData, true);
//$decodedFormData = json_decode($_REQUEST, true);
$frontSent = file_get_contents('php://input');
$decodedFormData = json_decode($frontSent, true);

$name = sql::$con->real_escape_string($decodedFormData['name']);
$email = sql::$con->real_escape_string($decodedFormData['email']);
$phone = sql::$con->real_escape_string($decodedFormData['phone']);
$question = sql::$con->real_escape_string($decodedFormData['question']);

$query = "INSERT INTO feedback_form (name, email, phone, question) VALUES ('$name', '$email', '$phone', '$question')";
if(sql::$con->query($query)){
    $result = 'ok';
}else{
    $result = 'error';
}

header('Content-type: application/json');
echo json_encode($result);
