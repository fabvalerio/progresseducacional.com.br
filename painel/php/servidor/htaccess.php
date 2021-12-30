<?php

// paginas htaccess ----------------------------------------------------


if( $_SERVER['SERVER_NAME'] == 'localhost' ){ //SERVIDOR OFF
  $server = $_SERVER['SERVER_NAME'].":8080";
  $endereco = (@explode("/", $_SERVER ['REQUEST_URI'])); 
  $url = $server."/".$endereco[1].'';
  $url = str_replace('//', '/', $url);
  $url_site = "http://".$url.'/registro/';
  $url = "http://".$url.'/registro/painel/';
}else{ //SERVIDOR ON
  $url = "http://".$_SERVER['SERVER_NAME']."/registro/painel/";
  $url_site = "http://".$_SERVER['SERVER_NAME']."/registro/";
}


define('url', $url);

$verificarUrl = @explode('/', $url);
$verificarUrlWWW =  @explode('.', $verificarUrl[2]);


//explode link por "/" come�ando com o "0" .."1" .. "2" ... ... "20"
if( !empty($_GET['page']) ){
$link = explode('/', $_GET['page']);
}else{
   $link = [];
}

if( !empty($link) ){
   foreach( $link AS $key => $val ){
      define('url'.$key, $val);
   }
}


if( empty($link[0]) ){
$paginaExibi = "_home.php";
}
elseif( $link[0] == '!' ){
		
	if( is_file($link[1]) ){
		$paginaExibi = "_".$link[1].".php";
	}
	elseif( is_dir($link[1]) ){
		$paginaExibi = $link[1]."/".$link[2].".php";
	}
	else{
        $paginaExibi = "_404.php";
	}
	
}
elseif( $link[0] != '!' ){
   $paginaExibi = "_".$link[0].".php";
}
else
{
   $paginaExibi = "_404.php";
}
//--------------------------------------------------------------



///// FIM htacess------------------------------------------------
