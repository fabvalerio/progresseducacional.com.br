<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}



$InputSQL = new db();
$InputSQL->query( "SELECT curso.*, curso_categoria.*
                   FROM curso
                   LEFT JOIN curso_categoria
                   ON curso_categoria.cat_curso_id = curso.curso_categoria_cat_curso_id
                   " );
$InputSQL->execute();

?>

<a class="btn btn-success" href="<?php echo $url?>!/curso/cadastrar">Novo Curso</a>

<hr>
<h2 class="mb-3">Registros de curso<small> (<?php echo $InputSQL->rowCount()?>)</small></h2>
<hr>


<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.css"></style>
<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/buttons.dataTables.min.css"></style>
<script src="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/buttons.flash.min.js"></script>
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
      "order": [[ 0, 'DESC' ], [ 1, 'asc' ]],
      "dom": '<"top"i>lft<"bottom"Bi><"clear">',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      "pagingType": "full_numbers"
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
          <th>ID</th>
          <th>Registro</th>
          <th>Curso</th>
          <th>Tipo</th>
          <th>Categoria</th>
          <th>Valor</th>
          <th width="100">Data início do curso</th>
          <th width="100">Data fim do curso</th>
          <th width="100">Dias para concluir / após compra</th>
          <th width="50">Status</th>
          <th width="70" align="right"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if( !empty($InputSQL->row()) ){
          foreach( $InputSQL->row() AS $row ){
            ?>
            <tr class="odd gradeX <?php if( empty($row['curso_status']) ) echo 'font-weight-bold'; ?>">
              <td><?php echo $row['curso_id']?></td>
              <td><?php echo $row['curso_registro']?></td>
              <td><?php echo $row['curso_nome']?></td>
              <td><?php echo empty($row['curso_tipo']) ? 'Professores' : 'Alunos'?></td>
              <td><?php echo $row['cat_curso_nome']?></td>
              <td>R$ <?php echo $row['curso_valor']?></td>
              <td><?php if( $row['curso_validade_data_inicio'] != '0000-00-00'){ echo $row['curso_validade_data_inicio']; }else{ echo "-"; } ?></td>
              <td><?php if( $row['curso_validade_data_fim'] != '0000-00-00'){ echo $row['curso_validade_data_fim']; }else{ echo "-"; } ?></td>
              <td><?php if( !empty($row['curso_validade_dias']) ){ echo $row['curso_validade_dias']; }else{ echo "-"; } ?></td>
              <td><?php echo empty($row['curso_status']) ? 'Inativo' : 'Ativo'?></td>
              <td align="right" >
                <a href="<?php echo $url?>!/curso/editar/<?php echo $row['curso_id']?>" class="btn btn-sm btn-outline-success"><i class="fas fa-vote-yea"></i></a>
                <!-- <a href="<?php echo $url?>!/curso/deletar/<?php echo $row['curso_id']?>&titulo=<?php echo $row['curso_nome']?>" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a> -->
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
