<?php

header("Access-Control-Allow-Origin: *");
require_once(__DIR__.'/../../app/model/config.php');
require_once(__DIR__.'/../../app/model/user.php');

//$decodedUser = $_POST;
$frontSent = file_get_contents('php://input');
$decodedUser = json_decode($frontSent, true);
//print_r($decodedUser);

$user->add($decodedUser);

$userCreated['success'] = 'User created successfully';
$jsonstring = json_encode($userCreated);

header('Content-type: application/json');
echo $jsonstring;



