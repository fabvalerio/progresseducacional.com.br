<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


$InputSQL = new db();
$InputSQL->query( "SELECT p.prof_id, p.prof_nome, p.prof_cpf, p.prof_status, e.esc_nome, p.prof_registro,
                   IF( a.aluno_cpf = p.prof_cpf, 'Registrado', 'Não registrado' ) as cadastrado
                          
                   FROM professores as p

                   LEFT JOIN escola as e
                   ON e.esc_id = p.prof_esc_id

                   LEFT JOIN aluno as a
                   ON a.aluno_cpf = p.prof_cpf" );
$InputSQL->execute();

?>


<h2 class="mb-3">Professores/Alunos<small> (<?php echo $InputSQL->rowCount()?>)</small></h2>

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
          <th>CPF</th>
          <th>Escola</th>
          <th>Cadastro</th>
          <th>Status</th>
          <th width="70" align="right"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if( !empty($InputSQL->row()) ){
          foreach( $InputSQL->row() AS $row ){
            ?>
            <tr class="odd gradeX <?php if( empty($row['prof_status']) ) echo 'font-weight-bold'; ?>">
              <td><?php echo $row['prof_id']?></td>
              <td><?php echo $row['prof_registro']?></td>
              <td><?php echo $row['prof_nome']?></td>
              <td><?php echo $row['prof_cpf']?></td>
              <td><?php echo $row['esc_nome']?></td>
              <td><?php echo $row['cadastrado']?></td>
              <td><?php echo !empty($row['prof_status']) ? 'Ativo' : 'Inativo'?></td>
              <td align="right" >
                <a href="<?php echo $url?>!/professores/editar/<?php echo $row['prof_id']?>" class="btn btn-sm btn-outline-success"><i class="fas fa-vote-yea"></i></a>
                <!-- <a href="<?php echo $url?>!/professores/deletar/<?php echo $row['prof_id']?>&titulo=<?php echo $row['prof_nome']?>" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a> -->
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
