<?php

header('Content-Type: application/json');

include('../../painel/php/db.class.php');

function status($val){
    if( empty($val) ){ $resul = NULL; }
    else{ $resul = TRUE; }
    return $resul;
}


$alu = new db();
$alu->query( "SELECT a.aluno_nome, a.aluno_email, ac.cursos_id_curso, a.aluno_id, ac.cursos_status, c.curso_nome, ac.cursos_id
              FROM aluno AS a
              LEFT JOIN aluno_cursos AS ac
              ON ac.aluno_aluno_id = a.aluno_id
              LEFT JOIN curso AS c
              ON c.curso_id = ac.cursos_id_curso
              WHERE aluno_status = '1' 
              AND c.curso_nome IS NOT NULL
            " );
$alu->execute();


//obter os resultados
$result = $alu->row();

//matriz de configuração para manter informações
$arr = array();

//suportes de configuração para os diferentes tipos para que possamos filtrar os dados
$aluno_id = 0;
$modelId = 0;

//configuração para manter nosso índice atual
$arrIndex = -1;
$modelIndex = -1;


foreach($alu->row() as $row){
    if($aluno_id != $row['aluno_id']){
        $arrIndex++;
        $modelIndex = -1;
        $aluno_id = $row['aluno_id'];

        //adicionar o console
        $arr[$arrIndex]['id']  = $row['aluno_id'];
        $arr[$arrIndex]['nome']  = $row['aluno_nome'];
        $arr[$arrIndex]['email'] = $row['aluno_email'];

        //configurar o array de informações
        $arr[$arrIndex]['curso'] = array();
    }

    if($modelId != $row['cursos_id_curso']){
        $modelIndex++;

        //adicionar o modelo ao console
        // $arr[$arrIndex]['curso'][$modelIndex]['model'] = $row['aluno_nome'];
        $arr[$arrIndex]['curso'][$modelIndex] = $row['aluno_nome'];

        //configurar a matriz de títulos
        // $arr[$arrIndex]['curso'][$modelIndex]['title'] = array();
        $arr[$arrIndex]['curso'][$modelIndex] = array();
    }

    //adicionar o jogo ao console e modelo atuais
    // $arr[$arrIndex]['curso'][$modelIndex]['title'][] = array(
        $arr[$arrIndex]['curso'][$modelIndex] = array(
        'id'        => $row['cursos_id_curso'],
        //'compra'    => $row['cursos_id'],
        'nome'      => $row['curso_nome'],
        'status'    => status($row['cursos_status'])
    );
}





?>