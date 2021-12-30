<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

$edi = new db();
$edi->query( "SELECT *
              FROM cupom
              WHERE cup_id = '".$link[3]."'" );
$edi->execute();
$row = $edi->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>


<hr>

<h2 class="mb-3">Editar - <?php echo $row->cup_nome?></h2>

<form enctype="multipart/form-data" id="form" method="post">
  <table class="table">
    <tr>
      <th width="150" valign="middle">Nome</th>
      <td valign="middle" colspan="3">
        <input type="text" class="form-control" id="cup_nome" name="cup_nome" value="<?php echo $row->cup_nome?>">
      </td>
      <th width="150" valign="middle">Valor (%) <i>Regra: 10</i></th>
      <td valign="middle">
        <input type="text" class="form-control" id="cup_valor" name="cup_valor" value="<?php echo $row->cup_valor?>">
      </td>
    </tr>
    <tr>
      <th>Início</th>
      <td>
        <input type="date" class="form-control" name="cup_data" id="cup_data"
          value="<?php echo $row->cup_data?>">
      </td>
      <th>Fim</th>
      <td>
        <input type="date" class="form-control" name="cup_validade" id="cup_validade" value="<?php echo $row->cup_validade?>">
      </td>

      <th>Status</th>
      <td>
        <select name="cup_status" id="cup_status" class="form-control">
          <option value="1" <?php if( $row->cup_status == '1' ){ echo "selected"; }?>>Ativo</option>
          <option value="0" <?php if( $row->cup_status == '0' ){ echo "selected"; }?>>Inativo</option>
        </select>
      </td>

    </tr>
    <tr>

      <td colspan="3">
        <input type="button" name="Enviar" id="salvar" value="Salvar" class="btn btn-success w-100" />
        <input type="hidden" name="cup_id" id="cup_id" value="<?php echo $link[3]?>">
        <input type="hidden" name="redirecionar" value="visualizar">
        <!--Redirecionar-->
        <input type="hidden" name="tabela" value="cupom">
        <!--Tabela-->
        <input type="hidden" name="url" value="<?php echo $url ?>">
        <!--URL-->
        <input type="hidden" name="cup_registro" value="<?php echo $row->cup_registro?>">
      </td>
    </tr>
  </table>
</form>

<div id="result"></div>


<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
  /* EDITAR */
  editar('<?php echo $url; ?>', 'cup_id', '<?php echo $row->cup_id ?>', '');
</script>