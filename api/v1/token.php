<?php

/*
** Testando JWT
** https://jwt.io/
*/

include('conf.php');

/*
** Header
*/

$header = [
   'alg' => 'HS256',
   'typ' => 'JWT'
];

$header = json_encode($header);
$header = base64_encode($header);
$header = str_replace(['=', '+', '/'], '', $header);

/*
** PlayLoad
*/

/*
“iss” O domínio da aplicação geradora do token
“sub” É o assunto do token, mas é muito utilizado para guarda o ID do usuário
“aud” Define quem pode usar o token
“exp” Data para expiração do token
“nbf” Define uma data para qual o token não pode ser aceito antes dela
“iat” Data de criação do token
“jti” O id do token
*/

$payload = [
    'iss' => 'localhost',
    'key' => $keyAuth
];

$payload = json_encode($payload);
$payload = base64_encode($payload);
$payload = str_replace(['=', '+', '/'], '', $payload);


/*
** Assinatura
*/

$chave = $chaveSig;

$signature = hash_hmac('sha256',"$header.$payload",$chave,true);
$signature = base64_encode($signature);
$signature = str_replace(['=', '+', '/'], '', $signature);


echo "$header.$payload.$signature";

?>