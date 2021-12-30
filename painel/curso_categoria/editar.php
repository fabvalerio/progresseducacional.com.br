<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

$edi = new db();
$edi->query( "SELECT *
              FROM curso_categoria
              WHERE cat_curso_id = '".$link[3]."'" );
$edi->execute();
$row = $edi->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>


<hr>

<h2 class="mb-3">Editar - <?php echo $row->cat_curso_nome?></h2>

<form enctype="multipart/form-data" id="form" method="post">
  <table class="table">
    <tr>
      <th width="150" valign="middle">Nome</th>
      <td valign="middle" colspan="3">
            <input type="text" class="form-control" id="cat_curso_nome" name="cat_curso_nome" value="<?php echo $row->cat_curso_nome?>">
      </td>
     
      <td  colspan="3">
      <input type="button" name="Enviar" id="salvar" value="Salvar" class="btn btn-success w-100"/>
        <input type="hidden" name="cat_curso_id" id="cat_curso_id" value="<?php echo $link[3]?>">
        <input type="hidden" name="redirecionar" value="visualizar">  <!--Redirecionar-->
        <input type="hidden" name="tabela" value="curso_categoria">              <!--Tabela-->
        <input type="hidden" name="url" value="<?php echo $url ?>">      <!--URL-->
        <input type="hidden" name="curso_registro" value="<?php echo $row->curso_registro?>">
      </td>
    </tr>
  </table>
</form>

<div id="result"></div>

<script>
  $(document).ready(function(){
    $("#data").change(function(){

      event.preventDefault();

      var reg = $(this).val();

      if(reg == 0){
        console.log('desativando todos');
        $('#curso_validade_dias').prop("disabled", true); 
        $('#curso_validade_data_inicio').prop("disabled", true); 
        $('#curso_validade_data_fim').prop("disabled", true); 
        $('#curso_validade_dias').val(''); 
        $('#curso_validade_data_inicio').val(''); 
        $('#curso_validade_data_fim').val(''); 
      }else if(reg == 1){
        console.log('desativando dia');
        $('#curso_validade_dias').prop("disabled", true); 
        $('#curso_validade_data_inicio').prop("disabled", false); 
        $('#curso_validade_data_fim').prop("disabled", false);
        $('#curso_validade_dias').val(''); 
      }else if(reg == 2){
        console.log('desativando datas');
        $('#curso_validade_dias').prop("disabled", false); 
        $('#curso_validade_data_inicio').prop("disabled", true); 
        $('#curso_validade_data_fim').prop("disabled", true);
        $('#curso_validade_data_inicio').val(''); 
        $('#curso_validade_data_fim').val('');
      }

    });
  });
</script>

<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
  /* EDITAR */
  editar('<?php echo $url; ?>', 'cat_curso_id', '<?php echo $row->cat_curso_id ?>', '');
</script>