<?php

//https://www.linkedin.com/pulse/autentica%C3%A7%C3%A3o-em-apis-utilizando-jwt-e-php-bruno-morais/?originalSubdomain=pt
require '../../../vendor/autoload.php';

use BrunoMoraisTI\JwtToken;
//$jwtToken = new JwtToken("12345","localhost");


function jwt_request($token, $post) {

    header('Content-Type: application/json');
    $ch = curl_init('http://localhost/registro.progresseducacional.com.br/api/v1/v2/enviar-bearer.php');
    $post = json_encode($post);
    $authorization = "Authorization: Bearer ".$token_gerado; 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result);
}

 $post = ['nome'=>'Fabio', 'email'=>'valerio.fabio@gmail.com'];
 $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJzdWIiOiIzMGI2NWJiMmRjY2Q4YzhkZjUwMDQwMDk4Mzk5ZmNmNmEzOGZmYjg5IiwianRpIjoiNGIwMzFiNDIzYzAwZGVhOGVkNGVlMWI2M2RkN2ZkODZjMTQxODY1NiIsImF1ZCI6MCwiaWF0IjoxNjQyNTM4OTE0LCJuYmYiOjE2NDI1Mzg5MTQsImRhdGEiOnsianNvbiI6eyJpZCI6MSwibmFtZSI6IlRlc3QifX19.XaAgUxS19--0lo-HDyuXbOmpT2mOKNjHegar_OglcRs';

 echo jwt_request($token, $post)


?>