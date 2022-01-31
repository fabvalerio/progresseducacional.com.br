<?php

header('Content-Type: application/json');

include('conf.php');
include('autenticador.php');

if( !empty($_POST['chave']) ){

    $chave = $_POST['chave'];

    //exportar
    $part = explode(".",$chave);
    $header = $part[0];
    $payload = $part[1];
    $signature = $part[2];

    //chaves
    $valid = hash_hmac('sha256', "$header.$payload", $chaveSig, true);
    $valid = base64_encode($valid);
    $valid = str_replace(['=', '+', '/'], '', $valid);

        //Validar chave de assinatura JWT
        if($signature == $valid){

            $payload = base64_decode($payload);
            $payload = json_decode($payload);

            //Validar key de autenticação
            if($payload->key == $keyAuth){

                //Validar Header Bearer Token

                if( getAuthorizationHeader($token) == 1 ){

                    //exibir Cursos
                    include('#cursos.php');
                    echo json_encode($arr);

                }else{

                    echo 'token invalid';
    
                }

            }else{

                echo 'key invalid';

            }

        }else{

             echo 'assinatura invalid';

        }
}else{
    echo 'null';
 }
 


?>