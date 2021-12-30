<?php

session_start();

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


include('php/db.class.php');
include('php/htaccess.php');

$_email = trim( $_POST['mail'] );
$_senha = trim( $_POST['senha'] );


	echo $LoginSql = "SELECT user_id FROM usuario WHERE user_email = '{$_email}' AND user_senha = '{$_senha}' AND user_status = '1' ";


	$Login = new db();	   
	$Login->query($LoginSql);
	$Login->execute();
	$resultLogin = $Login->object();	
	

		if(!empty($resultLogin->user_id)){

			//3600 dias * 24 horas
			$_SESSION["user_id"] = $resultLogin->user_id;
			$_SESSION["user_nivel"] = "admin";
			
			//echo 'logado';
			header('location: '.$url);
		}else{
			//echo 'erro';
			$_SESSION["user_id"] = '';
			$_SESSION["user_nivel"] = '';
			header('location: '.$url.'/login.php?alert=error');
		}

?>

