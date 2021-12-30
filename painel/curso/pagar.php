<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'aluno' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


    //print_r($_POST);
    //exit();


?>


            <div class="card card-body">
            
            <?php
            
                $curso = $_POST['pedido_venda'];
                $cupom = $_POST['idCupom'];
                $aluno = $_SESSION['user_id'];
                
                
            	/*
                **Listar Curso
                */
                $InputSQL = new db();
                $InputSQL->query( "SELECT *
                                   FROM curso
                                   WHERE curso_id = '".$curso."'" );
                $InputSQL->execute();
                $row = $InputSQL->object();

                $inicio = !empty($row->curso_validade_data_inicio) ? $row->curso_validade_data_inicio : NULL;
                $fim    = !empty($row->curso_validade_data_fim) ? $row->curso_validade_data_fim : NULL;
                $dias   = !empty($row->curso_validade_dias) ? $row->curso_validade_dias : NULL;



                /*
                **Listar Cupom
                */
                if( !empty($cupom) ){

                    $sqlCupom = "SELECT cp.cup_utilizado, c.cup_nome, c.cup_valor
                                FROM cupom_usado as cp
                                LEFT JOIN cupom as c
                                ON c.cup_id = cp.cup_id
                                WHERE c.cup_id = '{$cupom}'";

                    $InputSQLCup = new db();
                    $InputSQLCup->query($sqlCupom);
                    $InputSQLCup->execute();
                    $rowCup = $InputSQLCup->object();


                    $valorPagar = number_format( $row->curso_valor - ( $row->curso_valor * ( $rowCup->cup_valor / 100 ) ), 2, '.', '');

                }else{
                    $valorPagar = $row->curso_valor;
                }


                // echo $valorPagar;                
                // exit();

                //VERIFICAR STATUS
                $resStatus = new onepay;
                $resStatus->url = $urlAPI."vendas/".$idPgto;
                $resStatus->token = $tokenRegistro;
                $resStatus->method = 'GET';
                $dataStatus = $resStatus->api($resStatus->url, $resStatus->token, $resStatus->method);

                $objStatus = json_decode($dataStatus);

                if( $objStatus->success == true ){
                    $statusPagamento = $objStatus->venda->status->id;

                    if( $statusPagamento == 2 ){
                        $statusPagamentoDb = 1; //ativo
                    }else{
                        $statusPagamentoDb = 0; //inativo
                    }
                }

                
                
            	/*
                **Salvar venda
                */
            	$inserirSQL = "INSERT INTO 
                                aluno_cursos 
                                (cursos_id_curso, 
                                 aluno_aluno_id, 
                                 cursos_registro, 
                                 cursos_status,
                                 curso_valor,
                                 cursos_data_inicio,
                                 cursos_data_fim,
                                 cursos_data_dias,
                                 cursos_codigo,
                                 cursos_tipo_pagamento,
                                 cursos_pagmento_id) 
                                VALUES 
                                (:cursos_id_curso, 
                                 :aluno_aluno_id, 
                                 :cursos_registro, 
                                 :cursos_status, 
                                 :curso_valor,
                                 :cursos_data_inicio,
                                 :cursos_data_fim,
                                 :cursos_data_dias,
                                 :cursos_codigo,
                                 :cursos_tipo_pagamento,
                                 :cursos_pagmento_id)";
                $inserir = new db();
                $inserir->query( $inserirSQL );
                
                $inserir->bind(':cursos_id_curso', $curso);
                $inserir->bind(':aluno_aluno_id', $aluno);
                $inserir->bind(':cursos_registro', date('Y-m-d H:i:s'));
                $inserir->bind(':cursos_status', $statusPagamentoDb);
                $inserir->bind(':curso_valor', $valorPagar);
                $inserir->bind(':cursos_data_inicio', $inicio);
                $inserir->bind(':cursos_data_fim', $fim);
                $inserir->bind(':cursos_data_dias', $dias);
                $inserir->bind(':cursos_codigo', "#".$_SESSION['user_nivel'].'-'.$_POST['pedido_venda'].'-'.date('YmdHis'));
                $inserir->bind(':cursos_tipo_pagamento', $tipoPagamento); //boleto ou Credito
                $inserir->bind(':cursos_pagmento_id', $idPgto);




                //Salvandos os paranae
                if($inserir->execute()){


                    /*
                    **Salvar cupom 
                    */
                    if( $_POST['idCupom'] ){

                        //echo $inserir->lastInsertId();

                                $inserirSQLCup = "INSERT INTO 
                                                cupom_usado 
                                                (cup_utilizado, 
                                                cup_id, 
                                                cup_aulo_cursos_id) 
                                                VALUES 
                                                (:cup_utilizado, 
                                                :cup_id, 
                                                :cup_aulo_cursos_id)";
                                $inserirCup = new db();
                                $inserirCup->query( $inserirSQLCup );

                                $inserirCup->bind(':cup_utilizado', date('Y-m-d H:i:s'));
                                $inserirCup->bind(':cup_id', $_POST['idCupom']);
                                $inserirCup->bind(':cup_aulo_cursos_id', $inserir->lastInsertId());

                                if($inserirCup->execute()){
                                    //echo "Cupom registrado";
                                }else{
                                    //echo "Erro upom registrado";
                                }
                    }
                        



                    echo "<div class=\"text-success\"> 
                            <h3><i class=\"fa fa-star\"></i>  Oba! 🥳 </h3>
                            Sua compra foi realizado com sucesso!
                          </div>";
                    // echo "<meta http-equiv=\"refresh\" content=\"2;URL=".$url."!/curso/lista\" />";
                }else{
                    echo "<div class=\"text-danger\"> 
                            <h3> <i class=\"fa fa-hand-o-right\"></i>  Ops! 😥  </h3>
                            Ocorreu um erro, tente novamente!
                            <a href=\"javascript:history.go(-1)\">Voltar</a>
                          </div>";
                    //echo "<meta http-equiv=\"refresh\" content=\"4;URL=".$url."!/curso/comprar/".$curso."\" />";
                }
                
                
            ?>
            
            </div>