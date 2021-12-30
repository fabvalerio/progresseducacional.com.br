<?php


	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


$InputSQL = new db();
$InputSQL->query( "SELECT esc_id, esc_nome, esc_cnpj, esc_cidade, esc_estado, esc_email, esc_status, esc_registro
                   FROM escola" );
$InputSQL->execute();

?>


<h2 class="mb-3">Registros de Escolas<small> (<?php echo $InputSQL->rowCount()?>)</small></h2>

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
          <th>Nome</th>
          <th>CNPJ</th>
          <th>Email</th>
          <th>Cidade</th>
          <th>Estado</th>
          <th>Status</th>
          <th width="70" align="right"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if( !empty($InputSQL->row()) ){
          foreach( $InputSQL->row() AS $row ){
            ?>
            <tr>
              <td><?php echo $row['esc_id']?></td>
              <td><?php echo $row['esc_registro']?></td>
              <td><?php echo $row['esc_nome']?></td>
              <td><?php echo $row['esc_cnpj']?></td>
              <td><?php echo $row['esc_email']?></td>
              <td><?php echo $row['esc_cidade']?></td>
              <td><?php echo $row['esc_estado']?></td>
              <td><?php echo !empty($row['esc_status']) ? 'Ativo' : 'Inativo'?></td>
              <td align="right" >
                <a href="<?php echo $url?>!/escola/editar/<?php echo $row['esc_id']?>" class="btn btn-sm btn-outline-success"><i class="fas fa-vote-yea"></i></a>
                <!-- <a href="<?php echo $url?>!/escola/deletar/<?php echo $row['esc_id']?>&titulo=<?php echo $row['esc_nome']?>" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a> -->
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
