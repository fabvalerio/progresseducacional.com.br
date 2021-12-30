<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'escola' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

$edi = new db();
$edi->query( "SELECT *
              FROM escola
              WHERE esc_id = '".$_SESSION["user_id"]."'" );
$edi->execute();
$row = $edi->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>">Voltar</a>

<hr>

<h2 class="mb-3">Meus Dados</h2>

<form enctype="multipart/form-data"  id="form" method="post">

    <table class="table">
        <tr>
            <th width="100" valign="middle">Registro</th>
            <td valign="middle"><input autocomplete="chrome-off" required class="form-control" type="text" name="esc_registro" value="<?php echo $row->esc_registro?>"></td>
        </tr>
        <tr>
            <th width="100" valign="middle">Razão Social</th>
            <td valign="middle"><input autocomplete="chrome-off" required class="form-control" type="text" name="esc_nome" value="<?php echo $row->esc_nome?>"></td>
        </tr>
        <tr>
            <th width="100" valign="middle">Fantasia</th>
            <td valign="middle"><input autocomplete="chrome-off" required class="form-control" type="text" name="esc_fantasia" value="<?php echo $row->esc_fantasia?>"></td>
        </tr>
        <tr>
            <th>CNPJ</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="cnpf" name="esc_cnpj" value="<?php echo $row->esc_cnpj?>">
            </td>
        </tr>
        <tr>
            <th>CEP</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="cep" name="esc_cep" value="<?php echo $row->esc_cep?>"></td>
        </tr>
        <tr>
            <th>Endereço</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="endereco" name="esc_end" value="<?php echo $row->esc_end?>"></td>
        </tr>
        <tr>
            <th>Número</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="num" name="esc_num" value="<?php echo $row->esc_num?>"></td>
        </tr>
        <tr>
            <th>Bairro</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="bairro" name="esc_bairro" value="<?php echo $row->esc_bairro?>"></td>
        </tr>
        <tr>
            <th>Cidade</th>
            <td><input autocomplete="chrome-off" required readonly class="form-control" type="text" id="cidade" name="esc_cidade" value="<?php echo $row->esc_cidade?>"></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td><input autocomplete="chrome-off" required readonly class="form-control" type="text" id="estado" readeronly name="esc_estado" value="<?php echo $row->esc_estado?>"></td>
        </tr>
        <tr>
            <td colspan="2" class="lead">Dados do Responsável</td>
        </tr>
        <tr>
            <th>Responsável</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" name="esc_responsavel" value="<?php echo $row->esc_responsavel?>"></td>
        </tr>
        <tr>
            <th>Cargo</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" name="esc_cargo" value="<?php echo $row->esc_cargo?>"></td>
        </tr>
        <tr>
            <th>CPF</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="cpf" name="esc_cpf" value="<?php echo $row->esc_cpf?>"></td>
        </tr>
        <tr>
            <th>RG</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="rg" name="esc_rg" value="<?php echo $row->esc_rg?>"></td>
        </tr>
        <tr>
        <tr>
            <th>Telefone</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="telefone" name="esc_telefone" value="<?php echo $row->esc_telefone?>"></td>
        </tr>
        <tr>
            <th>Celular</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" id="celular" name="esc_celular" value="<?php echo $row->esc_celular?>"></td>
        </tr>
        <th>Status</th>
        <td><?php echo !empty($row->esc_status) ? 'Ativo' : 'Inativo'?></td>
        </tr>
        <tr>
            <td colspan="2" class="lead">Acesso (login)</td>
        </tr>
        <tr>
            <th>E-mail</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="text" name="esc_email" value="<?php echo $row->esc_email?>">
            </td>
        </tr>
        <tr>
            <th>Senha</th>
            <td><input autocomplete="chrome-off" required class="form-control" type="password" name="esc_senha" value="<?php echo $row->esc_senha?>"></td>
        </tr>
        <td colspan="2">
                <input type="button" name="Enviar" id="salvar" value="Editar" class="btn btn-success w-100" />
                <input type="hidden" name="redirecionar" value="dados">  <!--Redirecionar-->
                <input type="hidden" name="tabela" value="escola">           <!--Tabela-->
                <input type="hidden" name="url" value="<?php echo $url ?>">      <!--URL-->
                <input type="hidden" name="esc_id" value="<?php echo $row->esc_id ?>"><!--Valor Editar-->
        </td>
        </tr>
    </table>

</form>

<div id="result"></div>

<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
  /* EDITAR */
  editar('<?php echo $url; ?>', 'esc_id', '<?php echo $row->esc_id ?> ', '');
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
        $('#cnpj').mask("99.999.999/9999-99");
        $('#cep').mask("99999-999");
        $('#telefone').mask("(99) 9999-9999");
        $('#celular').mask("(99) 99999-9999");


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


    //ENVIANDO
    $(".enviando").submit(function (event) {
        $.ajax({
            url: "registrando.php",
            type: 'post',
            data: $(this).serialize(),
            // cache: false,
            // processData: false,
            success: function (result) {
                $('.result-formulario').html(result);
                // $('.news').each(function () {
                // 	this.reset();
                // });
                console.log(result);
            }
        });
        event.preventDefault();
    });
</script>
