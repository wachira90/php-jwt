<?php
include("src/JWT.php");
include("src/Key.php");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

//JWT::$leeway = 60; // $leeway in seconds

function encode_jwt($user)
{   
    $key = "seckey1234";

    // $payload = array(
    //     "data" => $user,
    //     "date_time" => date("Y-m-d H:i:s") //กำหนดวันเวลาที่สร้าง
    // );
    // $jwt = JWT::encode($payload, $key, 'HS256');
	$jwt = JWT::encode($user, $key, 'HS256');
    return $jwt;
}


function decode_jwt($jwt)
{
    try {
        $key = "seckey1234";

        $payload = JWT::decode($jwt, new Key($key, 'HS256'));
        return  $payload;

    } catch (\Exception $e) { return false; }
}

$pl = array(
	"username" => 'mr.wachira',
	"fullname" => 'Wachira Duangdee',
	"role" => 5,
	"date_time" => date("Y-m-d H:i:s") //กำหนดวันเวลาที่สร้าง
);

$tk = encode_jwt($pl);
echo $tk;

echo '<hr><pre>';


// print_r (decode_jwt($tk));

$d = decode_jwt($tk);

echo  json_encode($d);

// foreach($d as $v){
// 	echo $v[0]->fullname;
// }

echo '<hr>';

// stdClass Object
// (
//     [username] => mr.wachira
//     [fullname] => Wachira Duangdee
//     [role] => 5
//     [date_time] => 2022-01-29 18:51:44
// )
