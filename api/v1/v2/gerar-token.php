<?php

//https://www.linkedin.com/pulse/autentica%C3%A7%C3%A3o-em-apis-utilizando-jwt-e-php-bruno-morais/?originalSubdomain=pt
require '../../../vendor/autoload.php';

use BrunoMoraisTI\JwtToken;
$jwtToken = new JwtToken("12345","localhost");


// print_r($_POST);
// print_r($_SERVER);

$objJson = array(
    "id" => 1,
    "name" => "Test"
);




echo $jwtToken->encode($objJson);



?>