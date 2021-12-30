<?php
session_start();
error_reporting (0);

/*Validar Usuario*/
if( empty( $_SESSION['user_id'] ) )
{
 echo '<meta http-equiv="refresh" content="0;URL='.$url.'login.php">';
 exit;
}


include('../includes/#notify.php');
include('../php/db.class.php');


deletar( $_POST['tabela'], $_POST['coluna'], $_POST['id'], $url, $_POST['deletar-diretorio'] );

?>