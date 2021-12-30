<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

$edi = new db();
$edi->query( "SELECT *
              FROM curso
              WHERE curso_id = '".$link[3]."'" );
$edi->execute();
$row = $edi->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>


<hr>

<h2 class="mb-3">Editar - <?php echo $row->curso_nome?></h2>

<form enctype="multipart/form-data" id="form" method="post">
  <table class="table">
    <tr>
      <th width="150" valign="middle">Nome</th>
      <td valign="middle" colspan="3">
            <input type="text" class="form-control" id="curso_nome" name="curso_nome" value="<?php echo $row->curso_nome?>">
      </td>
      <th width="150" valign="middle">Valor (R$) <i>Regra: 1199.99</i></th>
      <td valign="middle">
            <input type="text" class="form-control" id="curso_valor" name="curso_valor" value="<?php echo $row->curso_valor?>">
      </td>
      <td>
              <select id="data" class="form-control">
                <option disabled selected>Prazos</option>
                <option value="0">Nenhum Prazo</option>
                <option value="1">Prazo entre Datas</option>
                <option value="2">Prazo por Dias</option>
              </select>
      </td>
    </tr>
    <tr>
        <td class="bg-warning text-center" colspan="4">DATA</td>
        <th class="text-center">ou</th>
        <td colspan="2" class="bg-warning text-center">DIAS</td>
    </tr>
    <tr>
        <th>Início</th>
        <td>
          <input type="date" class="form-control" <?php if(empty($row->curso_validade_data_inicio)){  echo 'disabled'; } ?> name="curso_validade_data_inicio" id="curso_validade_data_inicio" value="<?php echo $row->curso_validade_data_inicio?>">
        </td>
        <th>Fim</th>
        <td>
          <input type="date" class="form-control" <?php if(empty($row->curso_validade_data_fim)){  echo 'disabled'; } ?> name="curso_validade_data_fim" id="curso_validade_data_fim" value="<?php echo $row->curso_validade_data_fim?>">
        </td>
        <th>Dias da compra</th>
        <td colspan="2">
          <input type="number" class="form-control" <?php if(empty($row->curso_validade_dias)){  echo 'disabled'; } ?> name="curso_validade_dias" id="curso_validade_dias" value="<?php echo $row->curso_validade_dias?>">
        </td>
    </tr>
    <tr>
      <th>Descrição</th>
      <td colspan="6">
          <textarea class="form-control" name="curso_descricao" id="curso_descricao" rows="3"><?php echo $row->curso_descricao?></textarea>
      </td>
    </tr>
    <tr>
      <th>Tipo do Curso</th>
      <td>
          <select name="curso_tipo" id="curso_tipo" class="form-control">
            <option value="1" <?php if( $row->curso_tipo == '1' ){ echo "selected"; }?>>Alunos</option>
            <option value="0" <?php if( $row->curso_tipo == '0' ){ echo "selected"; }?>>Professores</option>
          </select>
      </td>

      <th>Tipo de Curso</th>
      <td>
          <?php echo Select( 'curso_categoria', 'cat_curso_nome', 'cat_curso_id', '', $row->curso_categoria_cat_curso_id, 'curso_categoria_cat_curso_id' ); ?>
      </td>

      <th>Status</th>
      <td>
          <select name="curso_status" id="curso_status" class="form-control">
            <option value="1" <?php if( $row->curso_status == '1' ){ echo "selected"; }?>>Ativo</option>
            <option value="0" <?php if( $row->curso_status == '0' ){ echo "selected"; }?>>Inativo</option>
          </select>
      </td>

      <td  colspan="3">
      <input type="button" name="Enviar" id="salvar" value="Salvar" class="btn btn-success w-100"/>
        <input type="hidden" name="curso_id" id="curso_id" value="<?php echo $link[3]?>">
        <input type="hidden" name="redirecionar" value="visualizar">  <!--Redirecionar-->
        <input type="hidden" name="tabela" value="curso">              <!--Tabela-->
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
  editar('<?php echo $url; ?>', 'curso_id', '<?php echo $row->curso_id ?>', '');
</script>