<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

$InputSQL = new db();
$InputSQL->query( "SELECT * FROM usuario WHERE user_id != '1' ORDER BY user_email ASC" );
$InputSQL->execute();

?>

<a class="btn btn-outline-success" href="<?php echo $url?>!/<?php echo $link[1]?>/cadastro">Novo cadastro</a>
<hr>
<h2 class="mb-3">Usu&aacute;rio <span>Lista (<?php echo $InputSQL->rowCount()?>)</span></h2>

<div class="card">
  <div class="card-body">
    <table class="table table-striped table-hover" id="dataTables-example">
      <thead>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th class="text-md-center">Status</th>
          <th width="110" align="right"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if( !empty($InputSQL->row()) ){
          foreach( $InputSQL->row() AS $row ){
            ?>
            <tr class="odd gradeX">
              <td><?php echo $row['user_id']?></td>
              <td><?php echo $row['user_email']?></td>
              <td class="text-md-center"><?php echo status($row['user_status'])?></td>
              <td align="right" >
                <a href="<?php echo $url?>!/<?php echo $link[1]?>/editar/<?php echo $row['user_id']?>" class="btn btn-outline-success btn-sm"><i class="fas fa-edit"></i></a>
                <a href="<?php echo $url?>!/<?php echo $link[1]?>/deletar/<?php echo $row['user_id']?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i></a>
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

