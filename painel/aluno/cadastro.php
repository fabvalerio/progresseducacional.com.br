
<?php
	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'escola' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}
?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>

<hr>

<h2 class="mb-3">Cadastrar</h2>


<form enctype="multipart/form-data"  id="cadastro" method="post">

<div class="container-fluid">
<div class="row g-3">

<div class="col-lg-10">
    <div class="form-group">
        <label for="">Nome Completo</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" name="aluno_nome">
    </div>
</div>
<div class="col-lg-10">
    <div class="form-group">
        <label for="">Classe</label>
        <?php //echo Select( $tabela, $coluna, $valor, $where, $selectValue = NULL, $id );?>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">CPF</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" id="cpf" name="aluno_cpf">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">RG</label>
        <input autocomplete="chrome-off" required class="form-control" maxlength="15" minlength="6" type="text" id="rg" name="aluno_rg">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">CEP</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" id="cep" name="aluno_cep">
    </div>
</div>
<div class="col-lg-10">
    <div class="form-group">
        <label for="">Endereço</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" id="endereco" name="aluno_end">
    </div>
</div>
<div class="col-lg-2">
    <div class="form-group">
        <label for="">Número</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" id="numero" name="aluno_num">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Complemento (opcional)</label>
        <input autocomplete="chrome-off" class="form-control" type="text" id="complemento" name="aluno_bairro">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Bairro</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" id="bairro" name="aluno_complemento">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Cidade</label>
        <input autocomplete="chrome-off" required readonly class="form-control" type="text" id="cidade" name="aluno_cidade">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Estado</label>
        <input autocomplete="chrome-off" required readonly class="form-control" type="text" id="estado" name="aluno_estado">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Celular</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" id="celular" name="aluno_celular">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Telefone (opcional)</label>
        <input autocomplete="chrome-off" required class="form-control" type="text" id="telefone" name="aluno_telefone">
    </div>
</div>
<div class="col-12 mb-3 mt-5">
    <h3>Acesso</h3>
</div>

<div class="col-12">
    <div class="form-group">
        <label for="">Email</label>
        <input autocomplete="chrome-off" required class="form-control" type="mail" name="aluno_email">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Senha</label>
        <input autocomplete="chrome-off" required class="form-control" type="password" maxlength="20" minlength="6" name="aluno_senha">
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label for="">Confirmar Senha</label>
        <input autocomplete="chrome-off" required class="form-control" type="password" maxlength="20" minlength="6" name="aluno_senha2">
    </div>
</div>

<div class="p-t-30">

       <input type="button" name="Enviar" id="salvar" value="Enviar" class="btn btn-success w-100" />
       <input type="hidden" name="redirecionar" value="lista">  <!--Redirecionar-->
       <input type="hidden" name="tabela" value="aluno">      <!--Tabela de edição-->
       <input type="hidden" name="url" value="<?php echo $url ?>"> <!--Url -->
       <input type="hidden" name="aluno_tipo" value="0">
       <input type="hidden" name="aluno_esc_id" value="<?php echo $_SESSION['user_id']?>">
       <input type="hidden" name="aluno_status" value="1">
       <input type="hidden" name="aluno_registro" value="<?php echo date("Y-m-d H:i:s")?>">

</div>

</div>
</div>



       
</form>

<div id="result"></div>

<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
  /* REGISTRO */
  cadastro('<?php echo $url; ?>', '');
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


        var d = new Date();
        var strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + " " + d.getHours() +
            ":" + d.getMinutes() + ":" + d.getSeconds();
        $('#data_registro').val(strDate);
        console.log(strDate);

        //MASK
        //https://github.com/digitalBush/jquery.maskedinput
        $('#cpf').mask("999.999.999-99");
        $('#cep').mask("99999-999");
        $('#celular').mask("(99) 99999-9999");
        $('#telefone').mask("(99) 9999-9999");


        //CEP
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#endereco").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
            //$("#ibge").val("");
        }

        // Quando o campo cep perde o foco.
        $("#cep").blur(function () {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#endereco").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");
                    //$("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (
                        dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                            //$("#ibge").val(dados.ibge);

                            $("#numero").focus();
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

    });


</script>
