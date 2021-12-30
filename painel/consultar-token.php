<?php

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include('conex.class.php');
include('conf.php');

$idEstabelecimento = 17171;

$res = new onepay;
$res->url = $urlAPI."estabelecimentos/" . $idEstabelecimento . '/token';
$res->token = $tokenRegistro;
$res->method = 'GET';
echo $res->api($res->url, $res->token, $res->method);




