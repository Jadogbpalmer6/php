<?php

require "../../vendor/autoload.php";
use \Firebase\JWT\JWT;

date_default_timezone_set('Africa/Kigali');
$payload = array('name' =>'jado' ,'job' => 'back-end developer','exp'=>time()+1000 );

$jwt = jwt::encode($payload,'mySecret');

// print_r($jwt);
$decoded = jwt::decode($jwt,'mySecret',array('HS256'));

$data = json_encode($decoded);


// header('content-type:application/json');
// echo $data;

//decoding second parameter set to false to decode it as a PHP object
$myObject = json_decode($data,false);
// echo $myObject->name ;

// echo $jwt;

header("Authorization: Bearer $jwt");
header("location: ./testJWT1.php",false);

?>