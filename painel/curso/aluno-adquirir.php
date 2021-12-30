<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'aluno' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

  $where = '';
  if( $_SESSION["user_tipo"] == '1' ){
    $where = " WHERE curso_tipo= '1' ";
  }


$InputSQL = new db();
$InputSQL->query( "SELECT *
                   FROM curso 
                   {$where}" );
$InputSQL->execute();

?>

<a class="btn btn-outline-warning" href="javascript:history.go(-1)">Voltar</a>
<hr>

<h2 class="mb-3">Cursos<small> (<?php echo $InputSQL->rowCount()?>)</small></h2>

<hr>

<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.css"></style>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/buttons.dataTables.min.css"></style> -->
<script src="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/buttons.flash.min.js"></script>
<!-- <script src="<?php echo $url; ?>assets/datatables/buttons.html5.min.js"></script> -->
<!-- <script src="<?php echo $url; ?>assets/datatables/buttons.print.min.js"></script> -->
<script src="<?php echo $url; ?>assets/datatables/dataTables.buttons.min.js"></script>
<!-- <script src="<?php echo $url; ?>assets/datatables/jszip.min.js"></script> -->
<!-- <script src="<?php echo $url; ?>assets/datatables/pdfmake.min.js"></script> -->
<!-- <script src="<?php echo $url; ?>assets/datatables/vfs_fonts.js"></script> -->
<script src="<?php echo $url; ?>assets/datatables/dataTables.select.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/dataTables.rowReorder.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#dataTables').DataTable( {
      select: true,
      stateSave: true,
      responsive: true,
      rowReorder: true,
      "order": [[ 0, 'DESC' ], [ 1, 'asc' ]],
    //   "dom": '<"top"i>lft<"bottom"Bi><"clear">',
    //   buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    //   "pagingType": "full_numbers"
    } );

    jQuery('.dataTables_length select').addClass('input-control');
    jQuery('.dataTables_filter label input').addClass('input-control');
    jQuery('.table').addClass('font-12');
    jQuery('.top #dataTables_info').css({'display':'none'});
    jQuery('.dt-buttons').css({'margin-top':'10px'});
  } );
</script>

<div class="card">
  <div class="card-body">
    <table class="table table-striped table-hover" id="dataTables">
      <thead>
        <tr class="success">
          <th>Código</th>
          <th>Curso</th>
          <th>Valor</th>
          <th>Prazo</th>
          <th width="120" align="right"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if( !empty($InputSQL->row()) ){
          foreach( $InputSQL->row() AS $row ){
            ?>
            <tr class="odd gradeX <?php if( 
                                               ( $row['curso_validade_data_inicio'] < date('Y-m-d')  
                                               AND !empty($row['curso_validade_data_inicio']) )
                                          ){ 
                                                 echo 'text-danger'; 
                                          } ?>">
              <td><?php echo $row['curso_id']?></td>
              <td><?php echo $row['curso_nome']?></td>
              <td>R$ <?php echo $row['curso_valor']?></td>
              <td>
                <?php 
                    if( empty($row['curso_validade_dias']) && empty($row['curso_validade_data_fim']) && empty($row['curso_validade_data_inicio']) ){
                      echo "Vitalício";
                    }elseif( empty($row['curso_validade_dias']) && !empty($row['curso_validade_data_fim']) && !empty($row['curso_validade_data_inicio']) ){
                      echo "Início ".dia($row['curso_validade_data_inicio'])." e termino ". dia($row['curso_validade_data_fim']);
                    }else{
                      echo $row['curso_validade_dias']." dias, comprando hoje expira no dia ". dia(SomarDia($row['curso_validade_dias']));
                    }
                ?>
              </td>
              <td align="right" >

              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Modal_<?php echo $row['curso_id']?>_"><i class="fa fa-th-list"></i></button>
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
                   if(
                        ( $row['curso_validade_data_inicio'] < date('Y-m-d')  
                        AND !empty($row['curso_validade_data_inicio']) )
                    ){
                     echo '<spam class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i> Expirado</spam>';
                   }else{  
                      echo '<a href="'.$url.'!/curso/comprar/'.$row['curso_id'].'" class="btn btn-sm btn-outline-success"><i class="fas fa-check-circle"></i> Comprar</a>';
                   } 
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
