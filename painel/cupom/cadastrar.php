<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>

<hr>

<h2 class="mb-3">Cadastrar Cupom</h2>

<form enctype="multipart/form-data"  id="cadastro" method="post">
  <table class="table">
    <tr>
      <th width="150">Nome</th>
      <td colspan="3">
            <input type="text" class="form-control" id="cup_nome" name="cup_nome">
      </td>
      <th width="150">Valor (%) <i>Regra: 10</i></th>
      <td>
            <input type="number" class="form-control" id="cup_valor" name="cup_valor">
      </td>

    <tr>
        <th>Início</th>
        <td>
          <input type="date" require class="form-control" name="cup_data" id="cup_data">
        </td>
        <th>Fim</th>
        <td>
          <input type="date" require class="form-control" name="cup_validade" id="cup_validade">
        </td>

<th>Status</th>
<td>
    <select name="cup_status" id="cup_status" class="form-control">
      <option value="1">Ativo</option>
      <option value="0">Inativo</option>
    </select>
</td>
    </tr>
      <td colspan="6">
        <input type="button" name="Enviar" id="salvar" value="Enviar" class="btn btn-success w-100" />
        <input type="hidden" name="redirecionar" value="visualizar">  <!--Redirecionar-->
        <input type="hidden" name="tabela" value="cupom">      <!--Tabela de edição-->
        <input type="hidden" name="url" value="<?php echo $url ?>"> <!--Url -->
        <input type="hidden" name="cup_registro" value="<?php echo date('Y-m-d H:i:s'); ?>"> <!--Url -->
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