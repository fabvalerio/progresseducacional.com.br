
<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>
<hr>
<h2 class="mb-3">Usu&aacute;rio &bull; <span>Cadastro</span></h2>

<form enctype="multipart/form-data"  id="cadastro" method="post">
  <table  class="table table-striped table-hover" >
    <tr>
      <th>Status</th>
      <td><select class="form-control" name="user_status" id="user_status">
        <option value="1" selected="selected">Ativo</option>
        <option value="0">Inativo</option>
      </select></td>
    </tr>
    <tr>
      <th>Email</th>
      <td><input class="form-control" name="user_email" type="email" autofocus id="user_email" autocomplete="off" size="60" /></td>
    </tr>
    <tr>
      <th>Senha</th>
      <td><input class="form-control" name="user_senha" type="text" autofocus id="user_senha" autocomplete="off" size="60" /></td>
    </tr>
    <tr>
      <td colspan="2">
       <input type="button" name="Enviar" id="salvar" value="Enviar" class="btn btn-success w-100" />
       <input type="hidden" name="redirecionar" value="visualizar">  <!--Redirecionar-->
       <input type="hidden" name="tabela" value="usuario">      <!--Tabela de edição-->
       <input type="hidden" name="url" value="<?php echo $url ?>"> <!--Url -->
     </td>
   </tr>
 </table>
</form>

<div id="result"></div>

<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
  /* REGISTRO */
  cadastro('<?php echo $url; ?>', '');
</script>
