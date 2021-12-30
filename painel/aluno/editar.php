<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


  $edi = new db();
  $edi->query( "SELECT *
                FROM aluno
                WHERE aluno_id = '".$link[3]."'" );
  $edi->execute();
  $row = $edi->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>

<hr>

<h2 class="mb-3"><?php echo $row->aluno_nome?></h2>

<table class="table">
  <tr>
    <th width="100" valign="middle">Registro</th>
    <td valign="middle"><?php echo $row->aluno_registro?></td>
  </tr>
  <tr>
    <th width="100" valign="middle">Nome</th>
    <td valign="middle"><?php echo $row->aluno_nome?></td>
  </tr>
  <tr>
    <th>CPF</th>
    <td><?php echo $row->aluno_cpf?></td>
  </tr>
  <tr>
    <th>RG</th>
    <td><?php echo $row->aluno_rg?></td>
  </tr>
  <tr>
    <th>Endereço</th>
    <td><?php echo $row->aluno_end?>, num. <?php echo $row->aluno_num?>, Bairro <?php echo $row->aluno_bairro?> - <?php echo $row->aluno_cep?></td>
  </tr>
  <tr>
    <th>Cidade/UF</th>
    <td><?php echo $row->aluno_cidade?>/<?php echo $row->aluno_estado?></td>
  </tr>
  <tr>
    <th>E-mail</th>
    <td><?php echo $row->aluno_email?></td>
  </tr>
  <tr>
  <tr>
    <th>Telefone</th>
    <td><?php echo $row->aluno_celular?></td>
  </tr>
  <tr>
    <th>Celular</th>
    <td><?php echo $row->aluno_celular?></td>
  </tr>
    <th>Tipo</th>
    <td><?php echo empty($row->aluno_tipo) ? 'Professor' : 'Aluno'?></td>
  </tr>
    <th>Status</th>
    <td><?php echo !empty($row->aluno_status) ? 'Ativo' : 'Inativo'?></td>
  </tr>
</table>


<?php

  $cur = new db();
  $cur->query( "SELECT ac.cursos_registro, ac.cursos_status, c.curso_nome, ac.cursos_id, ac.cursos_pagmento_id, cursos_codigo
                FROM aluno_cursos as ac
                LEFT JOIN curso as c
                ON c.curso_id = ac.cursos_id_curso
                WHERE ac.aluno_aluno_id = '".$link[3]."'" );
  $cur->execute();

?>

<h2 class="mb-3">Cursos Adquirido (<?php echo $cur->rowCount()?>)</h2>
<?php
  foreach( $cur->row() as $curso ){
?>
<div class="mb-3">
<div class="card card-body table-responsive">
  <table class="table table-borderless mb-0">
    <tr>
      <td width="100" valign="middle" class="text-info">
         <a class="info" href="#" data-curso="<?php echo $curso['curso_nome']?>" data-id="<?php echo $curso['cursos_id']?>" data-pgto="<?php echo $curso['cursos_pagmento_id']?>">
             <i class="fa fa-info-circle"></i>
             <?php echo $curso['cursos_pagmento_id']?>
          </a>
      </td>

      <td>
         <?php echo $curso['cursos_codigo']?>
      </td>

      <th width="100" valign="middle">Registro</th>
      <td width="150" valign="middle"><?php echo $curso['cursos_registro']?></td>

      <th width="100" valign="middle">Curso</th>
      <td valign="middle"><?php echo $curso['curso_nome']?></td>

       <td>
          <?php echo empty($curso['cursos_status']) 
                      ? '<span class="badge py-1 badge-danger">Aguardando Pagamento</span>' 
                      : '<span class="badge py-1 badge-success">Pagamento realizado</span>'?>
      </td>
      <td align="right" width="300">
        <?php if( empty($curso['cursos_status']) ){  ?>
        <a href="<?php echo $url?>!/aluno/confirmar/<?php echo $curso['cursos_id'];?>/<?php echo $link[3];?>" class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Confirmar</a>
        <?php }else{
          ?>
         <a href="<?php echo $url?>!/aluno/desativar/<?php echo $curso['cursos_id'];?>/<?php echo $link[3];?>" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Desativar</a>
          <?php
        }  ?>

      </td>
    </tr>
  </table>
</div>
</div>
<?php
  }
?>




<!-- MODAL INFORMAÇÕES DO CURSO -->
<div class="modal" id="informacoes" tabindex="-1">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" class="text-danger">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>

    </div>
  </div>
</div>


<script>

        $(".info").click(function(){

            var id = $(this).data('id');
            var curso = $(this).data('curso');
            var pgto = $(this).data('pgto');

            $("#informacoes .modal-body").html('Carregando...');

            $('#informacoes').modal('show');
            $('#informacoes h5').html(curso);
           
            console.log('Modal '+id);

            $.get('<?php echo $url;?>aluno/informacoes.php?curso='+id+'&pgto='+pgto, function(data){
              $("#informacoes .modal-body").html(data);
            });

            return false;

        });

</script>