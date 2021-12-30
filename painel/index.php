<?php


$paginaExibi = '';

 error_reporting(1);
 error_reporting(E_ERROR & ~E_NOTICE);
// ob_start();
session_start();

//  print_r($_SESSION);
// exit();

include('php/db.class.php');
include('php/function.php');
include('php/htaccess.php');
include('includes/#notify.php');
//include('php/deletapasta.php');
include('php/data.php');

/*Validar Usuário*/
if( empty( $_SESSION['user_id'] ) ){
 echo '<meta http-equiv="refresh" content="0;URL='.$url.'login.php">';
 exit();
}


?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Painel Administrativo </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo $url; ?>images/estrutura/Icone.png" />
  <link rel="stylesheet/less" type="text/css" href="<?php echo $url; ?>curso/less/pagamento.boleto.less" />
  <link rel="stylesheet/less" type="text/css" href="<?php echo $url; ?>curso/less/pagamento.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>

  <base href="<?php echo $url; ?>">


  <!-- *** LESS *** -->
  <?php
  $PastaStyle = 'assets/less/';
  $arq_Style = glob("$PastaStyle{*.less,*.css,*.sass}", GLOB_BRACE);
  foreach ($arq_Style as $Style){
    $ExtStyle = @end( @explode('.', $Style) );
    echo '<link href="'.$url.$Style.'" rel="stylesheet/'.$ExtStyle.'">'."\n";
  }
  ?>
  <script src="<?php echo $url; ?>js/less.js"></script>


  <!-- *** SCRIPT *** -->
  <script>
    function url(site)
    {
      window.location = '<?php echo $url?>'+site;
    }
  </script>


</head>
<body >
  <div class="container-fluid" id="main">
    <div class="row row-offcanvas row-offcanvas-left">

     <div class="col-md-12">
      <?php include('includes/#nav.php'); ?>
      <div class="px-4">
        <?php include($paginaExibi);?>
      </div>
    </div>
    
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="<?php echo $url; ?>js/scripts.js"></script>


</body>
</html>