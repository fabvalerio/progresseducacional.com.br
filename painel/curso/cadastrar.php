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
            <input type="text" class="form-control" id="curso_nome" name="curso_nome">
      </td>
      <th width="150">Valor (R$) <i>Regra: 1199.99</i></th>
      <td>
            <input type="text" class="form-control" id="curso_valor" name="curso_valor">
      </td>
      <td>
              <select id="data" class="form-control">
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
          <input type="date" require class="form-control" disabled name="curso_validade_data_inicio" id="curso_validade_data_inicio">
        </td>
        <th>Fim</th>
        <td>
          <input type="date" require class="form-control" disabled name="curso_validade_data_fim" id="curso_validade_data_fim">
        </td>
        <th>Dias da Compra</th>
        <td colspan="2">
          <input type="number" require class="form-control" disabled name="curso_validade_dias" id="curso_validade_dias">
        </td>
    </tr>
    <tr>
      <th>Descrição</th>
      <td colspan="6">
          <textarea class="form-control" name="curso_descricao" id="curso_descricao" rows="3"></textarea>
      </td>
    </tr>
    <tr>
      <th>Tipo de Curso</th>
      <td>
          <select name="curso_tipo" id="curso_tipo" class="form-control">
            <option value="1">Alunos</option>
            <option value="0">Professores</option>
          </select>
      </td>

      <th>Tipo de Curso</th>
      <td>
          <?php echo Select( 'curso_categoria', 'cat_curso_nome', 'cat_curso_id', '', '', 'curso_categoria_cat_curso_id' ); ?>
      </td>

      <th>Status</th>
      <td>
          <select name="curso_status" id="curso_status" class="form-control">
            <option value="1">Ativo</option>
            <option value="0">Inativo</option>
          </select>
      </td>
      <td colspan="3">
        <input type="button" name="Enviar" id="salvar" value="Enviar" class="btn btn-success w-100" />
        <input type="hidden" name="redirecionar" value="visualizar">  <!--Redirecionar-->
        <input type="hidden" name="tabela" value="curso">      <!--Tabela de edição-->
        <input type="hidden" name="url" value="<?php echo $url ?>"> <!--Url -->
        <input type="hidden" name="curso_registro" value="<?php echo date('Y-m-d H:i:s'); ?>"> <!--Url -->
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
  /* REGISTRO */
  cadastro('<?php echo $url; ?>', '');


</script>