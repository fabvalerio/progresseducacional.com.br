<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}
  
  $tipoVis = !empty($link[3]) ? $link[3] : '';

  if( $tipoVis == 'professores' ){
      $where = "WHERE a.aluno_tipo = '0'";
  }elseif( $tipoVis == 'alunos' ){
      $where = "WHERE a.aluno_tipo = '1'";
  }else{
    $where = "";
  }

  $InputSQL = new db();
  // $InputSQL->query( "SELECT a.aluno_id, a.aluno_nome, a.aluno_cpf, a.aluno_cidade, a.aluno_estado, a.aluno_email, a.aluno_status, a.aluno_registro, e.esc_nome,
  //                           (SELECT COUNT(ac.cursos_id) FROM aluno_cursos as ac WHERE ac.cursos_id_aluno = a.aluno_id AND ac.cursos_status = 1  ) as cursos,
  //                           (SELECT COUNT(ac.cursos_id) FROM aluno_cursos as ac WHERE ac.cursos_id_aluno = a.aluno_id AND ac.cursos_status = 0 ) as cursos_pgto,
  //                           IF( a.aluno_cpf = p.prof_cpf, '1', '0' ) as cadastrado,
  //                           IF( a.aluno_cpf = p.prof_cpf, p.prof_id, '0' ) as idCadastrado
  //                   FROM aluno as a

  //                   LEFT JOIN escola as e
  //                   ON e.esc_id = a.aluno_esc_id
                    
  //                   LEFT JOIN professores as p
  //                   ON p.prof_cpf = a.aluno_cpf
  //                   " );
  $InputSQL->query( "SELECT a.aluno_id, a.aluno_nome, a.aluno_cpf, a.aluno_cidade, a.aluno_estado, a.aluno_email, a.aluno_status, a.aluno_registro, e.esc_nome, a.aluno_tipo, c.class_nome,
                            (SELECT COUNT(ac.cursos_id) FROM aluno_cursos as ac WHERE ac.aluno_aluno_id = a.aluno_id AND ac.cursos_status = 1  ) as cursos,
                            (SELECT COUNT(ac.cursos_id) FROM aluno_cursos as ac WHERE ac.aluno_aluno_id = a.aluno_id AND ac.cursos_status = 0 ) as cursos_pgto
                    FROM aluno as a

                    LEFT JOIN escola as e
                    ON e.esc_id = a.aluno_esc_id

                    LEFT JOIN classe as c
                    ON c.class_id = a.classe_class_id
                    
                    {$where}

                    " );
  $InputSQL->execute();

?>


<h2 class="mb-3">Registros de Alunos<small> (<?php echo $InputSQL->rowCount()?>)</small></h2>
<hr>

<a href="<?php echo $url?>!/aluno/visualizar/professores" class="btn btn-<?php echo ($tipoVis == 'professores') ? 'outline-' : '' ; ?>info">Professores</a>
<a href="<?php echo $url?>!/aluno/visualizar/alunos" class="btn btn-<?php echo ($tipoVis == 'alunos') ? 'outline-' : '' ; ?>primary">Alunos</a>
<a href="<?php echo $url?>!/aluno/visualizar/" class="btn btn-<?php echo ($tipoVis == '') ? 'outline-' : '' ; ?>success">Todos</a>
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
          <th>Instituição</th>
          <th>Tipo</th>
          <th>Classe</th>
          <th>Email</th>
          <th>Cidade</th>
          <th>Estado</th>
          <th class="text-center">Cursos</th>
          <th class="text-center">Status</th>
          <th width="70" align="right"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if( !empty($InputSQL->row()) ){
          foreach( $InputSQL->row() AS $row ){
            ?>
            <tr>
              <td><?php echo $row['aluno_id']?></td>
              <td><?php echo $row['aluno_registro']?></td>
              <td><?php echo $row['aluno_nome']?></td>
              <td><?php echo $row['aluno_cpf']?></td>
              <td><?php echo $row['esc_nome']?></td>
              <td><?php echo ($row['aluno_tipo'] == '0') ? "Professor" : "Aluno"; ?></td>
              <td><?php echo $row['class_nome']?></td>
              <td><?php echo $row['aluno_email']?></td>
              <td><?php echo $row['aluno_cidade']?></td>
              <td><?php echo $row['aluno_estado']?></td>
              <td class="text-center">
                  <span class="badge badge-pill badge-success" data-toggle="tooltip" data-placement="top" title="Cursos Pagos"><?php echo $row['cursos']?></span>
                  <?php if( $row['cursos_pgto'] >= 1){ ?><span class="badge badge-pill badge-danger" data-toggle="tooltip" data-placement="top" title="Aguardando Pagamento"><?php echo $row['cursos_pgto']?></span><?php  } ?>
              </td>
              <td class="text-center"><?php echo !empty($row['aluno_status']) ? 'Ativo' : 'Inativo'?></td>
              <td align="right" >
                <a href="<?php echo $url?>!/aluno/editar/<?php echo $row['aluno_id']?>" class="btn btn-sm btn-outline-success"><i class="fas fa-vote-yea"></i></a>
                <!-- <a href="<?php echo $url?>!/aluno/deletar/<?php echo $row['aluno_id']?>&titulo=<?php echo $row['aluno_nome']?>" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a> -->
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
