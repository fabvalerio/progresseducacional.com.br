<div class="result">
<?php

//echo date('H:i:s');

include('../painel/php/conex.class.php');
include('../painel/php/conf.php');
include('../painel/php/data.php');

$dataNasc = dataSQL($_POST['aluno_nascimento']);


//Registrar usuário no onepay
$data = array(
    "nome"           => $_POST['aluno_nome'],
    "documento"      => $_POST['aluno_cpf'],
    "dataNascimento" => $dataNasc,
    "email"          => $_POST['aluno_email'],
    "celular"        => $_POST['aluno_celular'],
    "sexo"           => $_POST['aluno_sexo'],
    "endereco"       => array(
      "logradouro"   => $_POST['aluno_end'],
      "numero"       => $_POST['aluno_num'],
      "cep"          => $_POST['aluno_cep'],
      "cidade"       => $_POST['aluno_cidade'],
      "estado"       => $_POST['aluno_estado'],
      "complemento"  => $_POST['aluno_complemento']
    )
);


$res = new onepay;
$res->url = $urlAPI."clientes";
$res->token = $tokenRegistro;
$res->input = json_encode($data);
$res->method = 'POST';
$data = $res->send($res->url, $res->token, $res->input);


$obj = json_decode($data);

//Configuração
$statusRegistro = $obj->success;


$idUserOnePay = '';

if( $statusRegistro == '1' ){ #registrado com sucesso

    //print_r($obj);
    //echo "Novo: ";
    $idUserOnePay = $obj->cliente->id;

}else{  #usuario existente na plataforma onepay

   //echo "Usuario existente: ";
   $idUserOnePay = $obj->cliente->id;

   if( empty($idUserOnePay) ){  #Erro feio
        echo "<b>Ops 😫...</b> <br> Ocorreu um erro ao registrar, por favor, valide os dados preenchidos!";
        exit();
   }
}

//exit();


extract($_POST);

include('../painel/php/db.class.php');

//VERIFICAR
$vis = new db();
$vis->query("SELECT aluno_cpf, aluno_email FROM aluno WHERE aluno_cpf = '".$_POST['aluno_cpf']."' OR aluno_email = '".$_POST['aluno_email']."' ");
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
                aluno 
                ( 
                    aluno_nome,
                    aluno_cep,
                    aluno_end,
                    aluno_num,
                    aluno_bairro,
                    aluno_complemento,
                    aluno_cidade,
                    aluno_estado,
                    aluno_esc_id,
                    aluno_rg,
                    aluno_cpf,
                    aluno_celular,
                    aluno_telefone,
                    aluno_email,
                    aluno_senha,
                    aluno_registro,
                    aluno_status,
                    aluno_nascimento,
                    aluno_sexo,
                    aluno_id_onepay
                )
                VALUES
                (
                    :aluno_nome,
                    :aluno_cep,
                    :aluno_end,
                    :aluno_num,
                    :aluno_bairro,
                    :aluno_complemento,
                    :aluno_cidade,
                    :aluno_estado,
                    :aluno_esc_id,
                    :aluno_rg,
                    :aluno_cpf,
                    :aluno_celular,
                    :aluno_telefone,
                    :aluno_email,
                    :aluno_senha,
                    :aluno_registro,
                    :aluno_status,
                    :aluno_nascimento,
                    :aluno_sexo,
                    :aluno_id_onepay
                )
            ");
            
$db->bind(":aluno_registro",    date("Y-m-d H:i:s"));
$db->bind(":aluno_nome",        $_POST['aluno_nome']);
$db->bind(":aluno_cep",         $_POST['aluno_cep']);
$db->bind(":aluno_end",         $_POST['aluno_end']);
$db->bind(":aluno_num",         $_POST['aluno_num']);
$db->bind(":aluno_bairro",      $_POST['aluno_bairro']);
$db->bind(":aluno_complemento", $_POST['aluno_complemento']);
$db->bind(":aluno_cidade",      $_POST['aluno_cidade']);
$db->bind(":aluno_estado",      $_POST['aluno_estado']);
$db->bind(":aluno_esc_id",      $_POST['aluno_esc_id']);
$db->bind(":aluno_rg",          $_POST['aluno_rg']);
$db->bind(":aluno_cpf",         $_POST['aluno_cpf']);
$db->bind(":aluno_telefone",    $_POST['aluno_telefone']);
$db->bind(":aluno_celular",     $_POST['aluno_celular']);
$db->bind(":aluno_email",       $_POST['aluno_email']);
$db->bind(":aluno_senha",       $_POST['aluno_senha']);
$db->bind(":aluno_status",      1);
$db->bind(":aluno_nascimento",  $dataNasc);
$db->bind(":aluno_sexo",        $_POST['aluno_sexo']);
$db->bind(":aluno_id_onepay",   $idUserOnePay);


if( $db->execute() ){
    echo "<p class=\"lead\">Cadastro realizado com sucesso!</p>";   
    echo "<meta http-equiv=\"refresh\" content=\"3;url=login.html\" />";
}else{
    echo "<p class=\"lead\">Erro no cadastro</p>";   
}


?>
</div>