<?php
require "../../vendor/autoload.php";
use \Firebase\JWT\JWT;

// echo "yolla<br/>";
$header = headers_list();
$token = $header[0][1];
print_r($header);

// $data_from_token = jwt::decode($token,'mySecret',array('HS256'));
// $data_from_token = json_encode($data_from_token);

// // header("content-type:application/json");
// // echo $data_from_token;

// $data = json_decode($data_from_token,false);
// echo $data->name;