<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'aluno' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


  include('curso/#verificar-venda-lista-curso.php');

$InputSQL = new db();
$InputSQL->query( "SELECT c.curso_id, c.curso_nome, ac.cursos_registro, ac.cursos_status, ac.cursos_id, ac.curso_valor, c.curso_descricao, ac.cursos_codigo, ac.cursos_tipo_pagamento, ac.cursos_pagmento_id,
                          c.curso_validade_dias, c.curso_validade_data_inicio, c.curso_validade_data_fim, ac.cursos_data_dias, ac.cursos_data_fim, ac.cursos_data_dias, ac.cursos_data_inicio
                    FROM aluno_cursos AS ac
                    LEFT JOIN curso as c
                    ON ac.cursos_id_curso = c.curso_id
                    WHERE ac.aluno_aluno_id = '".$_SESSION['user_id']."' AND c.curso_status = '1' " );
$InputSQL->execute();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>">Voltar</a>
<a class="btn btn-success" href="<?php echo $url?>!/curso/aluno-adquirir">Comprar novo Curso</a>
<hr>
<h2 class="mb-3">Meus Aprendizados <small> (<?php echo $InputSQL->rowCount()?>)</small></h2>
<hr>



<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.css"></style>
<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/buttons.dataTables.min.css"></style>
<script src="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="<?php echo $url; ?>assets/datatables/buttons.flash.min.js"></script> -->
<script src="<?php echo $url; ?>assets/datatables/buttons.html5.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/buttons.print.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/jszip.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/pdfmake.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/vfs_fonts.js"></script>
<script src="<?php echo $url; ?>assets/datatables/dataTables.select.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/dataTables.rowReorder.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#dataTables').DataTable( {
      select: true,
      stateSave: true,
      responsive: true,
      rowReorder: true,
      //"pagingType": "100",
      //"order": [[ 0, 'DESC' ], [ 1, 'asc' ]],
     // "dom": '<"top"i>lft<"bottom"Bi><"clear">',
      //buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    } );

    jQuery('.dataTables_length select').addClass('input-control');
    jQuery('.dataTables_filter label input').addClass('input-control');
    jQuery('.table').addClass('font-12');
    jQuery('.top #dataTables_info').css({'display':'none'});
    jQuery('.dt-buttons').css({'margin-top':'10px'});
  } );
</script>

<div class="card">
  <div class="card-body table-responsive">
    <table class="table table-striped table-hover" id="dataTables">
      <thead>
        <tr class="success">
          <!-- <th>ID</th> -->
          <th>Registro</th>
          <th>Curso</th>
          <th>Valor (R$)</th>
          <th>Pagamento</th>
          <th>Prazo</th>
          <th>Status</th>
          <th width="120" align="right"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if( !empty($InputSQL->row()) ){
          foreach( $InputSQL->row() AS $row ){
            ?>
            <tr>
              <!-- <td><?php echo $row['cursos_id']?></td> -->
              <td><?php echo somenteData($row['cursos_registro'])?></td>
              <td>
                <a class="info" href="#" data-curso="<?php echo $row['curso_nome']?>" data-id="<?php echo $row['cursos_id']?>" data-pgto="<?php echo $row['cursos_pagmento_id']?>">
                    <i class="fa fa-info-circle"></i>
                </a>
                <?php echo $row['curso_nome']?>
               </td>
              <td><?php echo $row['curso_valor']?></td>
              <td><?php echo ($row['cursos_tipo_pagamento'] == 1 ) ? 'Boleto' :  'Cartão'; ?></td>
              <td>
              <?php 
                    if( empty($row['cursos_data_dias']) && empty($row['cursos_data_fim']) && empty($row['cursos_data_inicio']) ){

                      echo "Vitalício";
                      $DataExpirada = false;

                    }elseif( empty($row['cursos_data_dias']) && $row['cursos_data_fim'] != NULL && $row['cursos_data_inicio'] != NULL ){

                      echo "Validade ".dia($row['cursos_data_inicio'])." até ". dia($row['cursos_data_fim']);

                      if( $row['cursos_data_inicio'] > date('Y-m-d')){
                        $DataExpirada = true;
                        $DataBTN = "Aguarde";
                      }elseif($row['cursos_data_fim'] > date('Y-m-d') ){
                        $DataExpirada = true;
                        $DataBTN = "Encerado";
                      }else{
                        $DataExpirada = false;
                      }


                    }else{

                      $data_final = dia(SomarDia2($row['cursos_data_dias'], dia(somenteData($row['cursos_registro']))));
                      echo $row['cursos_data_dias']." dias, expira no dia ". $data_final;

                      if(date('Y-m-d') <= dia($data_final) ){ 
                        $DataExpirada = false;
                      }else{
                        $DataExpirada = true;
                        $DataBTN = "Encerado";
                      }
                      
                    }
                ?>
              </td>
              <td>
                
              <?php 
             
              //$acesso = statusPagto($urlAPI, $tokenRegistro, $row['cursos_pagmento_id']);
              $acesso = $row['cursos_status'];
             
              echo $acesso == 1
                                     ? 
                                    '<span class="badge badge-pill badge-success py-1"><i class="fa fa-toggle-on"></i> Pagamento confirmado</span>' 
                                    : 
                                    '<span class="badge badge-pill badge-danger py-1"><i class="fa fa-toggle-off"></i> Aguardando pagamento</span>';
              ?>
              </td>
              <td align="right">

              <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#Modal_<?php echo $row['curso_id']?>_"><i class="fa fw fa-th-list"></i></button>
              <!-- Modal -->
              <div class="modal fade" id="Modal_<?php echo $row['curso_id']?>_" tabindex="-1" aria-labelledby="Modal_<?php echo $row['curso_id']?>_Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="Modal_<?php echo $row['curso_id']?>_Label"><?php echo $row['curso_nome']?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-left">
                    <?php echo $row['curso_descricao']?>
                    </div>
                  </div>
                </div>
              </div>

              
                   <?php 
                   
                   if( $acesso == 1 AND $DataExpirada == false ){
                      echo '<a href="#" class="btn btn-sm btn-outline-success"> <i class="fw fa fa-play-circle"></i></a>' ;
                   }else{
                      if( !empty($DataBTN) ){
                        echo '<span class="btn btn-sm btn-outline-danger"><i class="fas fw fa-times"></i> '.$DataBTN.' </span>' ;
                      }else{
                        echo '<span class="btn btn-sm btn-outline-danger"><i class="fas fw fa-times"></i> </span>' ;
                      }
                      echo '<!--<a href="'.$url.'!/curso/pagar/'.$row['curso_id'].'" class="btn btn-sm btn-outline-danger"><i class="fa fw fa-shopping-cart"></i> Pagar</a>-->';;
                   }

                   //Limpar
                   $DataExpirada = '';
                   $DataBTN = '';
                   $acesso = '';
                   
                   ?>
                
                
              </td>
            </tr>
            <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


<!-- MODAL INFORMAÇÕES DO CURSO -->
<div class="modal" id="informacoes" tabindex="-1">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-danger">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>

    </div>
  </div>
</div>


<script>

        $(".info").click(function(){

            var id = $(this).data('id');
            var curso = $(this).data('curso');
            var pgto = $(this).data('pgto');

            $("#informacoes .modal-body").html('Carregando...');

            $('#informacoes').modal('show');
            $('#informacoes h5').html(curso);
           
            console.log('Modal '+id);

            $.get('<?php echo $url;?>curso/informacoes-venda.php?curso='+id+'&pgto='+pgto, function(data){
              $("#informacoes .modal-body").html(data);
            });

            return false;

        });

</script>