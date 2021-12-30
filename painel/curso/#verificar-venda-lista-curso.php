<?php

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include('php/conex.class.php');
include('php/conf.php');

function statusPagto($urlAPI, $tokenRegistro, $id){

    $res = new onepay;
    $res->url = $urlAPI."vendas/".$id;
    $res->token = $tokenRegistro;
    $res->method = 'GET';
    $data = $res->api($res->url, $res->token, $res->method);
    
    $obj = json_decode($data);
    

    //Configuração
    $statusPagamento = $obj->success;

    if( $obj->success == true){

        if( $obj->venda->status->titulo == 'Aprovado' ){
            $resp = 1;
        }else{
            $resp = 0;
        }

    }else{
        $resp = 0;
    }

    return $resp;
}

