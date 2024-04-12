<?php
include($_SERVER['DOCUMENT_ROOT'] . "/crud/crud_MVC/model/JWT.php");

function decode_token($token){
    $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/model/jwt.ini');
    $secret = $jwt['secret'];



    $JWT = new JWT;

    //$secret="elcocomalote";
    $token_dec = $JWT->decode($token, $secret);
    $rt_token = json_decode($token_dec, TRUE);
    return $rt_token['username'];
    //return $rt_token;
}

function create_token($username){
     $jwt = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/crud/crud_MVC/model/jwt.ini');
     $header = $jwt['header'];
     $secret = $jwt['secret'];//secret a piñon
    //return $username;


    $payload = '{"iat":"' . time() . '","exp":"' . time() + (600) . '","username":"' . $username . '"}';

    //return $payload;
    //echo json_encode("************************************");

    $JWT = new JWT;
    $token = $JWT->encode($header, $payload, $secret);
    return $token;
}
