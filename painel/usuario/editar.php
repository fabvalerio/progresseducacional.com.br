<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

$edi = new db();
$edi->query( "SELECT * FROM usuario WHERE user_id = '".$link[3]."' AND  user_id != '1'" );
$edi->execute();
$row = $edi->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>
<hr>
<h2 class="mb-3">Editar usu&aacute;rio &bull; <span>Cadastro</span></h2>

<form enctype="multipart/form-data"  id="form" method="post">
  <table  class="table table-striped table-hover" >
    <tr>
      <th>Status</th>
      <td><select name="user_status" id="user_status" class="form-control">
        <option value="1">Ativo</option>
        <option value="0">Inativo</option>
      </select></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><input name="user_email" class="form-control" type="text" autofocus id="user_email" autocomplete="off" size="60" value="<?php echo $row->user_email?>" /></td>
    </tr>
    <tr>
      <th>Senha</th>
      <td><input name="user_senha" class="form-control" type="text" autofocus id="user_senha" autocomplete="off" size="60" value="<?php echo $row->user_senha?>" /></td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="button" name="Enviar" id="salvar" value="Editar" class="btn btn-success w-100" />
        <input type="hidden" name="redirecionar" value="visualizar">  <!--Redirecionar-->
        <input type="hidden" name="tabela" value="usuario">           <!--Tabela-->
        <input type="hidden" name="url" value="<?php echo $url ?>">      <!--URL-->
        <input type="hidden" name="user_id" value="<?php echo $row->user_id ?>"><!--Valor Editar-->
      </td>
    </tr>
  </table>
</form>

<div id="result"></div>

<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
  /* EDITAR */
  editar('<?php echo $url; ?>', 'user_id', '<?php echo $row->user_id ?> ', '');
</script>
