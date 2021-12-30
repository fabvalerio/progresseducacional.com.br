<?php

session_start();

/*Validar Usuário*/
if(  $_SESSION['user_nivel'] != 'aluno' ){
    echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
    exit();
}


ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);


include('../php/db.class.php');
include('../php/conex.class.php');
include('../php/conf.php');
include('../php/data.php');


// print_r($_POST);
// echo '<hr>';
// exit();

$dataInput = array(
    "tipoPagamentoId"=> 1,
    "valor"=>$_POST['valor'],
    "dataVencimento"=>SomarDia2(5, date('Y-m-d')),
    "descricao"=>$_POST['descricao'],
    "pedido_venda"=>"#".$_SESSION['user_nivel'].'-'.$_POST['pedido_venda'].'-'.date('YmdHis'),
    "clienteId"=>$_POST['clienteId']
);



$res = new onepay;
$res->url = $urlAPI."vendas";
$res->token = $tokenRegistro;
$res->input = json_encode($dataInput);
$data = $res->send($res->url, $res->token, $res->input);
// echo $data;
// echo '<hr>';

$obj = json_decode($data);


//Configuração
$statusPagamento = $obj->success;


if( $statusPagamento == true ){


    #Salvando no banco de dados
    $tipoPagamento = $_POST['tipo'];
    $idPgto = $obj->pedido->id;
    include('../curso/pagar.php');



     echo '<div class="card mt-3">
              <div class="card-body">
              <h5 class="card-title">Código de barra digitável</h5>
              <p class="card-text">
               '.$obj->pedido->boleto->codigo_barras.'
              </p>
              <a target="new" href="'.$obj->pedido->boleto->url.'" class="btn btn-outline-success w-100">Visualizar boleto</a>
              <a href="!/curso/lista" class="btn btn-warning w-100 mt-3">Meus cursos</a>
            </div>
            </div>';

}else{
   
    echo '...';

    if( !empty($obj->error->message) ){
        echo '<div class="card card-body text-white bg-danger"><h>😥 Ops! Ocorreu um erro. <br> '.$obj->error->message.'</h></div>';
    }
}

