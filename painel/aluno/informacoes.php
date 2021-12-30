<?php


session_start();	

/*Validar Usuário*/
if(  $_SESSION['user_nivel'] != 'admin' ){
    echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
    exit();
}

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../php/conex.class.php');
include('../php/conf.php');
include('../php/db.class.php');

// print_r($_GET);

$idCurso = $_GET['curso'];
$idPto   = $_GET['pgto'];

//Verificar pagamento
$res = new onepay;
$res->url = $urlAPI."vendas/".$idPto;
$res->token = $tokenRegistro;
$res->method = 'GET';
$data = $res->api($res->url, $res->token, $res->method);

$obj = json_decode($data);

//Configuração

if( $obj->success == true){
    



$cur = new db();
$cur->query("SELECT c.curso_nome, a.cursos_registro, a.cursos_data_inicio, a.cursos_data_fim, a.cursos_tipo_pagamento, a.curso_valor
             FROM aluno_cursos AS a
             LEFT JOIN 
                curso AS C
             ON c.curso_id = a.cursos_id_curso
             WHERE
                a.cursos_id = '{$idCurso}'
            ");
$cur->execute();
$rowCur = $cur->object();

?>


<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Curso</th>
            <td><?php echo $rowCur->curso_nome;?></td>
        </tr>
        <tr>
            <th>Data da Compra</th>
            <td><?php echo $rowCur->cursos_registro;?></td>
        </tr>
        <tr>
            <th>Prazo</th>
            <td>
                <?php
                        if( empty($rowCur->cursos_data_dias) && empty($rowCur->cursos_data_fim) && empty($rowCur->cursos_data_inicio) ){

                            echo "Vitalício";
                            $DataExpirada = false;

                        }elseif( empty($rowCur->cursos_data_dias) && $rowCur->cursos_data_fim != NULL && $rowCur->cursos_data_inicio != NULL ){

                            echo "Validade ".dia($rowCur->cursos_data_inicio)." até ". dia($rowCur->cursos_data_fim);

                            if( $rowCur->cursos_data_inicio > date('Y-m-d')){
                            $DataExpirada = true;
                            $DataBTN = "Aguarde";
                            }elseif($rowCur->cursos_data_fim > date('Y-m-d') ){
                            $DataExpirada = true;
                            $DataBTN = "Encerado";
                            }else{
                            $DataExpirada = false;
                            }


                        }else{

                            $data_final = dia(SomarDia2($rowCur->cursos_data_dias, dia(somenteData($rowCur->cursos_registro))));
                            echo $rowCur->cursos_data_dias." dias, expira no dia ". $data_final;

                            if(date('Y-m-d') <= dia($data_final) ){ 
                            $DataExpirada = false;
                            }else{
                            $DataExpirada = true;
                            $DataBTN = "Encerado";
                            }
                            
                        }
                ?>
            </td>
        </tr>
        <tr>
            <th>Forma de pagamento</th>
            <td>
                <?php echo $obj->venda->tipoPagamento->titulo; ?>
            </td>
        </tr>
        <tr>
            <th>Valor total</th>
            <td>
                R$ <?php echo $rowCur->curso_valor; ?>
                <?php
                    //Cartão de crédito
                    if($rowCur->cursos_tipo_pagamento == 2){
                        echo " parcelado em ".count($obj->venda->pagamentos)."x de R$ ".($rowCur->curso_valor / count($obj->venda->pagamentos));
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <?php echo $obj->venda->status->titulo; ?>
            </td>
        </tr>

    </table>
</div>


<?php
    }else{
    ?>
        <div class="bg-danger text-white p-3 rounded">
            Ops! Ocorreu um erro brave, por favor, entrar em contato.
        </div>
    <?php
    }
?>