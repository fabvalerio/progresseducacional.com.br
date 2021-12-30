<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] == 'aluno' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


if( $_SESSION['user_nivel'] == 'escola' ){
  $addWhere = " AND prof_esc_id = '".$_SESSION['user_id']."'";
}else{
  $addWhere = '';
}

$edi = new db();
$edi->query( "SELECT prof_id, prof_nome, prof_cpf, prof_status, esc_nome, prof_registro
              FROM professores
              LEFT JOIN escola
              ON esc_id = prof_esc_id
              WHERE prof_id = '".$link[3]."' {$addWhere} " );
$edi->execute();
$row = $edi->object();

?>

<a class="btn btn-outline-warning" href="javascript:history.go(-1)">Voltar</a>
<?php if( empty($row->prof_status) ):?>
<a class="btn btn-outline-info" href="<?php echo $url?>!/<?php echo $link[1]?>/<?php echo $link[2]?>/<?php echo $link[3]?>/lido">Confirma Leitura</a>
<?php endif;?>

<hr>

<h2 class="mb-3">Visualizar</h2>

<table class="table">
  <tr>
    <th width="100" valign="middle">Registro</th>
    <td valign="middle"><?php echo $row->prof_registro?></td>
  </tr>
  <tr>
    <th width="100" valign="middle">Nome</th>
    <td valign="middle"><?php echo $row->prof_nome?></td>
  </tr>
  <tr>
    <th>CPF</th>
    <td><?php echo $row->prof_cpf?></td>
  </tr>
  <tr>
    <th>Escola</th>
    <td><?php echo $row->esc_nome?></td>
  </tr>
  <tr>
    <th>Status</th>
    <td><?php echo empty($row->prof_status) ? 'Em Aberto' : 'Registrado'?></td>
  </tr>
</table>
