<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'escola' ){
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

<h2 class="mb-3">Editar Professor</h2>


<form enctype="multipart/form-data" class="mb-2" id="form" method="post">

<div class="container-fluid">
<div class="row g-3">

<div class="col-lg-8">
    <div class="form-group">
        <label for="">Nome Completo</label>
        <input value="<?php echo $row->aluno_nome?>" autocomplete="chrome-off" required class="form-control" type="text" name="aluno_nome">
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group">
        <label for="">Classe</label>
        <?php echo Select( 'classe', 'class_nome', 'class_id', 'escola_esc_id', $row->classe_class_id, 'classe_class_id' );?>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">CPF</label>
        <input value="<?php echo $row->aluno_cpf?>" autocomplete="chrome-off" required class="form-control" type="text" id="cpf" name="aluno_cpf">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">RG</label>
        <input value="<?php echo $row->aluno_rg?>" autocomplete="chrome-off" required class="form-control" maxlength="15" minlength="6" type="text" id="rg" name="aluno_rg">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">CEP</label>
        <input value="<?php echo $row->aluno_cep?>" autocomplete="chrome-off" required class="form-control" type="text" id="cep" name="aluno_cep">
    </div>
</div>
<div class="col-lg-10">
    <div class="form-group">
        <label for="">Endereço</label>
        <input value="<?php echo $row->aluno_end?>" autocomplete="chrome-off" required class="form-control" type="text" id="endereco" name="aluno_end">
    </div>
</div>
<div class="col-lg-2">
    <div class="form-group">
        <label for="">Número</label>
        <input value="<?php echo $row->aluno_num?>" autocomplete="chrome-off" required class="form-control" type="text" id="numero" name="aluno_num">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Complemento (opcional)</label>
        <input value="<?php echo $row->aluno_complemento?>" autocomplete="chrome-off" class="form-control" type="text" id="complemento" name="aluno_complemento">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Bairro</label>
        <input value="<?php echo $row->aluno_bairro?>" autocomplete="chrome-off" required class="form-control" type="text" id="bairro" name="aluno_bairro">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Cidade</label>
        <input value="<?php echo $row->aluno_cidade?>" autocomplete="chrome-off" required readonly class="form-control" type="text" id="cidade" name="aluno_cidade">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Estado</label>
        <input value="<?php echo $row->aluno_estado?>" autocomplete="chrome-off" required readonly class="form-control" type="text" id="estado" name="aluno_estado">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Celular</label>
        <input value="<?php echo $row->aluno_celular?>" autocomplete="chrome-off" required class="form-control" type="text" id="celular" name="aluno_celular">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Telefone (opcional)</label>
        <input value="<?php echo $row->aluno_telefone?>" autocomplete="chrome-off" required class="form-control" type="text" id="telefone" name="aluno_telefone">
    </div>
</div>
<div class="col-12 mb-3 mt-5">
    <h3>Acesso</h3>
</div>

<div class="col-12">
    <div class="form-group">
        <label for="">Email</label>
        <input value="<?php echo $row->aluno_email?>" autocomplete="chrome-off" required class="form-control" type="mail" name="aluno_email">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Senha</label>
        <input value="<?php echo $row->aluno_senha?>" autocomplete="chrome-off" required class="form-control" type="password" maxlength="20" minlength="6" name="aluno_senha">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Confirmar Senha</label>
        <input value="<?php echo $row->aluno_senha?>" autocomplete="chrome-off" required class="form-control" type="password" maxlength="20" minlength="6" name="aluno_senha2">
    </div>
</div>

<div class="p-t-30">

        <input type="button" name="Enviar" id="salvar" value="Salvar" class="btn btn-success w-100"/>
        <input type="hidden" name="aluno_id" id="aluno_id" value="<?php echo $link[3]?>">
        <input type="hidden" name="redirecionar" value="lista">  <!--Redirecionar-->
        <input type="hidden" name="tabela" value="aluno">              <!--Tabela-->
        <input type="hidden" name="url" value="<?php echo $url ?>">      <!--URL-->
        <input type="hidden" name="aluno_registro" value="<?php echo $row->aluno_registro?>">
       <input type="hidden" name="aluno_esc_id" value="<?php echo $_SESSION['user_id']?>">
        <input type="hidden" name="aluno_tipo" value="0">

</div>

</div>
</div>



       
</form>

<div id="result"></div>

<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
  /* EDITAR */
  editar('<?php echo $url; ?>', 'aluno_id', '<?php echo $row->aluno_id ?>', '');
</script>


<script src="<?php echo $url?>js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    jQuery(document).ready(function ($) {



        //MASK
        //https://github.com/digitalBush/jquery.maskedinput
        $('#cpf').mask("999.999.999-99");
        $('#cep').mask("99999-999");
        $('#celular').mask("(99) 99999-9999");
        $('#telefone').mask("(99) 9999-9999");




    });


</script>
