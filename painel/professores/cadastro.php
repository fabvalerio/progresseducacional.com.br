
<?php
	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'escola' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}
?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>
<?php if( empty($row->prof_status) ):?>
<a class="btn btn-outline-info" href="<?php echo $url?>!/<?php echo $link[1]?>/<?php echo $link[2]?>/<?php echo $link[3]?>/lido">Confirma Leitura</a>
<?php endif;?>

<hr>

<h2 class="mb-3">Cadastrar</h2>


<form enctype="multipart/form-data"  id="cadastro" method="post">
<table class="table">
  <tr>
    <th width="100" valign="middle">Professor</th>
    <td valign="middle"><input autocomplete="chrome-off" required class="form-control" type="text" name="prof_nome"></td>
  </tr>
  <tr>
    <th width="100" valign="middle">CPF</th>
    <td valign="middle"><input autocomplete="chrome-off" required class="form-control" type="text" id="cpf" name="prof_cpf"></td>
  </tr>
  <tr>
    <td colspan="2">
       <input type="button" name="Enviar" id="salvar" value="Enviar" class="btn btn-success w-100" />
       <input type="hidden" name="redirecionar" value="lista">  <!--Redirecionar-->
       <input type="hidden" name="tabela" value="professores">      <!--Tabela de edição-->
       <input type="hidden" name="url" value="<?php echo $url ?>"> <!--Url -->
       <input type="hidden" name="prof_esc_id" value="<?php echo $_SESSION['user_id']?>">
       <input type="hidden" name="prof_status" value="1">
       <input type="hidden" name="prof_registro" value="<?php echo date("Y-m-d H:i:s")?>">
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


<script src="<?php echo $url?>js/jquery.maskedinput.js" type="text/javascript"></script>
<script>

    jQuery(document).ready(function ($) {


        //MASK
        //https://github.com/digitalBush/jquery.maskedinput
        $('#cpf').mask("999.999.999-99");

    });
    
</script>
