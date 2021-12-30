<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>

<hr>

<h2 class="mb-3">Cadastrar Curso</h2>

<form enctype="multipart/form-data"  id="cadastro" method="post">
  <table class="table">
    <tr>
      <th width="150">Nome</th>
      <td colspan="3">
            <input type="text" class="form-control" id="cat_curso_nome" name="cat_curso_nome">
      </td>
      <td colspan="3">
        <input type="button" name="Enviar" id="salvar" value="Enviar" class="btn btn-success w-100" />
        <input type="hidden" name="redirecionar" value="visualizar">  <!--Redirecionar-->
        <input type="hidden" name="tabela" value="curso_categoria">      <!--Tabela de edição-->
        <input type="hidden" name="url" value="<?php echo $url ?>"> <!--Url -->
        <input type="hidden" name="curso_registro" value="<?php echo date('Y-m-d H:i:s'); ?>"> <!--Url -->
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