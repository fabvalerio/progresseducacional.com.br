<div class="result">
<?php

//print_r($_POST);

extract($_POST);

include('../painel/php/db.class.php');

//VERIFICAR
$vis = new db();
$vis->query("SELECT esc_cnpj, esc_email FROM escola WHERE esc_cnpj = '".$_POST['esc_cnpj']."' OR esc_email = '".$_POST['esc_email']."' ");
$vis->execute();

// echo $vis->rowCount();

if( $vis->rowCount() >= 1 ){
     echo "<p class=\"lead\">Cadastro existe!</p>";
     echo "<p><a href=\"login.html\" class=\"text-white\">Clique aqui para fazer o login!</a></p>";
     exit();
}


//CADASTRO
$db = new db();
$db->query("INSERT INTO 
                escola 
                ( 
                    esc_nome,
                    esc_fantasia,
                    esc_cnpj,
                    esc_cep,
                    esc_end,
                    esc_num,
                    esc_complemento,
                    esc_bairro,
                    esc_cidade,
                    esc_estado,
                    esc_responsavel,
                    esc_rg,
                    esc_cpf,
                    esc_telefone,
                    esc_celular,
                    esc_email,
                    esc_senha,
                    esc_registro,
                    esc_status
                )
                VALUES
                (
                    :esc_nome,
                    :esc_fantasia,
                    :esc_cnpj,
                    :esc_cep,
                    :esc_end,
                    :esc_num,
                    :esc_complemento,
                    :esc_bairro,
                    :esc_cidade,
                    :esc_estado,
                    :esc_responsavel,
                    :esc_rg,
                    :esc_cpf,
                    :esc_telefone,
                    :esc_celular,
                    :esc_email,
                    :esc_senha,
                    :esc_registro,
                    :esc_status
                )
            ");
            
$db->bind(":esc_registro",    date("Y-m-d H:i:s"));
$db->bind(":esc_nome",        $_POST['esc_nome']);
$db->bind(":esc_fantasia",    $_POST['esc_fantasia']);
$db->bind(":esc_cnpj",        $_POST['esc_cnpj']);
$db->bind(":esc_cep",         $_POST['esc_cep']);
$db->bind(":esc_end",         $_POST['esc_end']);
$db->bind(":esc_num",         $_POST['esc_num']);
$db->bind(":esc_complemento", $_POST['esc_complemento']);
$db->bind(":esc_bairro",      $_POST['esc_bairro']);
$db->bind(":esc_cidade",      $_POST['esc_cidade']);
$db->bind(":esc_estado",      $_POST['esc_estado']);
$db->bind(":esc_responsavel", $_POST['esc_responsavel']);
$db->bind(":esc_rg",          $_POST['esc_rg']);
$db->bind(":esc_cpf",         $_POST['esc_cpf']);
$db->bind(":esc_telefone",    $_POST['esc_telefone']);
$db->bind(":esc_celular",     $_POST['esc_celular']);
$db->bind(":esc_email",       $_POST['esc_email']);
$db->bind(":esc_senha",       $_POST['esc_senha']);
$db->bind(":esc_status",      1);


if( $db->execute() ){
    echo "<p class=\"lead\">Cadastro realizado com sucesso!</p>";   
    echo "<meta http-equiv=\"refresh\" content=\"3;url=login.html\" />";
}else{
    echo "<p class=\"lead\">Erro no cadastro</p>";   
}


?>
</div>