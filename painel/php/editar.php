<?php
session_start();
/*Validar Usuario*/
if( empty( $_SESSION['user_id'] ) )
{
 echo '<meta http-equiv="refresh" content="0;URL='.$url.'login.php">';
 exit;
}


include('../includes/#notify.php');
include('../php/db.class.php');

editar( $_POST['tabela'], $_POST, $_POST['coluna'], $_POST['id'], $url );

?>