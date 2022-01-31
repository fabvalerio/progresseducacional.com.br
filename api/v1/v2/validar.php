<?php 
require '../../../vendor/autoload.php';
use BrunoMoraisTI\JwtToken;

// Instancia Objeto
$jwtToken = new JwtToken("12345","localhost");

// Pega o Bearer Token
$token = $jwtToken->getBearerToken();

// Verifica se o token confere com a chave e se está com a data válida
$objToken = $jwtToken->decode($token);
if ($objToken){
    echo "Token válido";
} else {
    echo "Token invalido";
}

?>