<?php

include('../painel/php/db.class.php');
include('../painel/php/conex.class.php');
include('../painel/php/conf.php');

$InputSQL = new db();
$InputSQL->query( "SELECT cursos_status, cursos_pagmento_id
                    FROM aluno_cursos
                    WHERE cursos_status = 0 " );
$InputSQL->execute();


//Verificar pagamento
$res = new onepay;


foreach( $InputSQL->Row() as $row ){

    echo "-".$row['cursos_pagmento_id'];

    $res->url = $urlAPI."vendas/".$row['cursos_pagmento_id'];
    $res->token = $tokenRegistro;
    $res->method = 'GET';
    $data = $res->api($res->url, $res->token, $res->method);
    $obj = json_decode($data);

    
    if( $obj->success == true){
        echo "-".$obj->venda->status->id;
        echo "-".$obj->venda->status->titulo;

        /*
        ** ATIVAR
        ** API Status 1 - Pendente
        ** API Status 2 - Aprovado
        **
        ** Banco de dados Progress
        ** Status 0 - Inativo
        ** Status 1 - Aprovado
        */
        if( $obj->venda->status->id == 2 ){


            $editar = new db();
            $editar->query( "UPDATE aluno_cursos SET cursos_status = :cursos_status WHERE cursos_pagmento_id = :cursos_pagmento_id" );
            $editar->bind(':cursos_status', '1');
            $editar->bind(':cursos_pagmento_id', $row['cursos_pagmento_id']);
            if($editar->execute()){
                echo "Ativação realizada com sucesso!";
            }


        }


    }else{
        echo "-sem registro";
    }

    echo "<hr>";

    $obj = '';

}

?>