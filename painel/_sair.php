<h2>Desconectando...</h2>

<?php

switch( $_SESSION['user_nivel'] ){
    case "aluno"  : $redPage = "../aluno/login.html"; ; break;
    case "escola" : $redPage = "../escola/login.html"; ; break;
    default       : $redPage = "login.php"; ; break;
}



//Apagando todos os dados da sessão:
session_unset();
//Destruindo a sessão:
session_destroy();

?>

<meta http-equiv="refresh" content="0;URL=<?php echo $redPage?>" />
