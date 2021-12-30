<?php

session_start();

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);


include('../php/db.class.php');
include('../php/conex.class.php');
include('../php/conf.php');
include('../php/data.php');


// print_r($_POST);
// echo '<hr>';

$pedido = "#".$_SESSION['user_nivel'].'-'.$_POST['pedido_venda'].'-'.date('YmdHis');

$data = array(
    "tipoPagamentoId" => 3,
    "valor"             => $_POST['valor'],
    "parcelas"          => $_POST['parcelas'],
    "pedido_venda"      => $pedido,
    "cartao"            => array(
      "titular"         => $_POST['nomeCartao'],
      "numero"          => $_POST['numCartao'],
      "codigoSeguranca" => $_POST['numCcv'],
      "validade"        => $_POST['numValidade']
    ),
    "clienteId" => $_POST['clienteId']
);


$res = new onepay;
$res->url = $urlAPI."vendas";
$res->token = $tokenRegistro;
$res->input = json_encode($data);
$res->method = 'POST';
$data = $res->send($res->url, $res->token, $res->input);
// echo $data;

$obj = json_decode($data);

//Configuração
$statusPagamento = $obj->success;


// echo '<hr>';


if( $statusPagamento == '1' ){


  #Salvando no banco de dados
  $tipoPagamento = $_POST['tipo'];
  $idPgto = $obj->pedido->id;
  
  include('../curso/pagar.php');

    // echo "Status:".$obj->success;
    // echo "Pedido ID:".$obj->pedido->status_pedido_id;
    // echo "Cliente ID:".$obj->pedido->estabelecimento_id;
    // echo "Pedido:".$obj->pedido->sales_order;
    // echo "CartaoId:".$obj->pedido->cartaoId;

    echo '<div class="card card-body bg-success text-white"><h3>🥰 Pagamento realizado com sucesso!</h3></div>';
    echo '<div class="my-3"><a href="!/curso/lista" class="btn btn-warning w-100 mt-3">Meus cursos</a></div>';

}else{
    echo '<div class="card card-body bg-danger text-white"><h3>😥 Ops! Ocorreu um erro. <br> '.$obj->error->message.'</h3></div>';
    echo "<script> $('#pagar').removeClass('d-none'); </script>";
}