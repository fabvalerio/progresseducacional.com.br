<?php
require '../../autoload.php';

use BrunoMoraisTI\JwtToken;

// Instancia Objeto
$jwtToken = new JwtToken("12345","localhost");

// Pega o Bearer Token
 $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJzdWIiOiI0YjcxMDczZWMzNjIzYTBhNWVlMTViNWE5NjdlMmEwZWI4NDI3ZDgyIiwianRpIjoiNzIyYTBmNGU4Y2IxZmZjNGU4YThjZDhjNTE4ZjJhMzFiMzgwNTE3OSIsImF1ZCI6MCwiaWF0IjoxNjQyNTM5NjEzLCJuYmYiOjE2NDI1Mzk2MTMsImRhdGEiOnsianNvbiI6eyJpZCI6MSwibmFtZSI6IlRlc3QifX19.9kv0Nf_EjeCRD0uX57hX3gffeCrWaBCgtqQwATLvZAo';

// Verifica se o token confere com a chave e se está com a data válida
$objToken = $jwtToken->decode($token);
if ($objToken){
    var_dump($objToken);
} else {
    echo "Token invalido";
}
