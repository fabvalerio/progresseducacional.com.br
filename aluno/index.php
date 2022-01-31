<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ProgressEducacional">
    <meta name="author" content="Fabio Valerio">
    <meta name="keywords" content="ProgressEducacional cadastro de escola">

    <!-- Title Page-->
    <title>ProgressEducacional | Cadastro de Aluno</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper p-t-10 p-b-10 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-body">
                    <div class="text-center">
                        <img src="../painel/images/logo.svg" width="200" alt="">
                        <h2 class="title">Cadastro</h2>
                        <hr class="mb-4 mt-3">
                    </div>
                    <form method="POST" class="enviando">

                        <div class="row g-3">

                            <div class="col-lg-12">
                                <h3>Dados da Aluno</h3>
                            </div>

                            <div class="col-lg-7">
                                <div class="input-group">
                                    <label for="">Nome Completo</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" name="aluno_nome">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <label for="">Sexo</label>
                                    <select name="aluno_sexo" class="select--style-2" required>
                                        <option value="" selected="selected" disabled>Selecione</option>
                                        <option value="F">Feminino</option>
                                        <option value="M">Masculino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <label for="">Você é professor?</label>
                                            <select name="aluno_tipo" class="select--style-2">
                                                <option value="1" selected="selected">Não</option>
                                                <option value="0">Sim</option>
                                            </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <label for="">Data Nascimento</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" id="nascimento" name="aluno_nascimento" maxlength="6" minlength="6" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <label for="">CPF</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" id="cpf" name="aluno_cpf">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <label for="">RG</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" maxlength="15" minlength="6" type="text" id="rg" name="aluno_rg">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <div class="input-group">
                                        <label for="">Escola conveniada</label>
                                            <select name="aluno_esc_id" class="select--style-2 text-uppercase">
                                                <option value="0" selected="selected">Nenhuma</option>
                                                <option disabled="disabled">----------</option>
                                                <?php  
                                                    include("../painel/php/db.class.php");
                                                    $escola = new db();
                                                    $escola->query("SELECT esc_id, esc_nome FROM escola ORDER BY esc_nome ASC");
                                                    $escola->execute();
                                                    foreach( $escola->row() AS $row ){
                                                ?>
                                                <option value="<?php echo $row['esc_id']?>"><?php echo $row['esc_nome']?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                    </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">CEP</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" id="cep" name="aluno_cep">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <label for="">Endereço</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" id="endereco" name="aluno_end">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <label for="">Número</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" id="numero" name="aluno_num">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Complemento (opcional)</label>
                                    <input autocomplete="chrome-off" class="input--style-2" type="text" id="complemento" maxlength="140" name="aluno_complemento">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Bairro</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" id="bairro" name="aluno_bairro">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Cidade</label>
                                    <input autocomplete="chrome-off" required readonly class="input--style-2" type="text" id="cidade" name="aluno_cidade">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Estado</label>
                                    <input autocomplete="chrome-off" required readonly class="input--style-2" type="text" maxlength="2" id="estado" name="aluno_estado">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Celular</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" id="celular" maxlength="15" name="aluno_celular">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Telefone (opcional)</label>
                                    <input autocomplete="chrome-off" class="input--style-2" type="text" id="telefone" maxlength="15" name="aluno_telefone">
                                </div>
                            </div>
                            <div class="col-12 mb-3 mt-5">
                                <h3>Acesso</h3>
                            </div>

                            <div class="col-12">
                                <div class="input-group">
                                    <label for="">Email</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="mail" name="aluno_email" maxlength="100">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Senha</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="password" maxlength="20" minlength="6" id="aluno_senha" name="aluno_senha">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="">Confirmar Senha</label>
                                    <input autocomplete="chrome-off" required class="input--style-2" type="password" maxlength="20" minlength="6" id="aluno_senha2" name="aluno_senha2">
                                </div>
                            </div>

                            <!-- <div class="col-lg-6">
                                <div class="input-group">
                                    <input autocomplete="chrome-off" required class="input--style-2 js-datepicker" type="text" placeholder="Birthdate"
                                        name="birthday">
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">Gender</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="class">
                                            <option disabled="disabled" selected="selected">Class</option>
                                            <option>Class 1</option>
                                            <option>Class 2</option>
                                            <option>Class 3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input autocomplete="chrome-off" required class="input--style-2" type="text" placeholder="Registration Code"
                                        name="res_code">
                                </div>
                            </div> -->
                            <div class="p-t-30">
                                <input autocomplete="chrome-off" type="hidden" name="aluno_registro" id="data_registro" value="">
                                <button class="btn btn--radius btn--green w-100 d-none" id="enviar" type="submit">Cadastrar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="result-formulario"></div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    
    
    <script src="../painel/js/jquery.maskedinput.js" type="text/javascript"></script>
    
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

                    //verificar senhas
                    $("#aluno_senha2").keyup(function(){
                        var senha1 = $("#aluno_senha2").val();
                        var senha = $("#aluno_senha").val();

                        console.log("Digitando "+senha1);
                        console.log("Senha "+senha);

                        if( senha1 == senha ){
                            $("#enviar").removeClass('d-none');
                        }

                    });
                
                
                    var d = new Date();
                    var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
                    $('#data_registro').val(strDate);
                    console.log(strDate);
                    
                    //MASK
                    //https://github.com/digitalBush/jquery.maskedinput
                    $('#cpf').mask("999.999.999-99");
                    $('#cep').mask("99999-999");
                    $('#celular').mask("(99) 99999-9999");
                    $('#telefone').mask("(99) 9999-9999");
                    $('#nascimento').mask("99/99/9999");
                    
                    
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

            $(".result-formulario").html('<div class="p-5 text-center text-danger bg-white rounded" style="width: 300px; position: fixed;z-index: 100;right: 10px;bottom: 10px;"><h3>Enviando...</h3></div>');

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

</body>

</html>