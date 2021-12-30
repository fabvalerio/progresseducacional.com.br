<?php
ob_start();
@session_start();

 //Validar Usuбrio
if( !empty( $_COOKIE['id'] ) )
{
 echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
 exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex">

  <title>Login Painel Administrativo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

  <style type="text/css">
  body{
    background-image: url('images/estrutura/painel.svg');
    background-size: cover;
    background-position: center bottom;
    height: 100vh;
    background-color: #f0f0f0;
    color: #000;
  }
  .container,
  .row{
    height: 100vh;
  }
</style>

<!-- Favicon -->
<link rel="shortcut icon" href="images/Icone.png" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

</head>
<body>
 <div class="container">    
  <div class="row d-flex align-items-center">                    
    <div class="col-lg-5 order-lg-1 order-2 card hvr-bounce-in <?php if($_GET['alert'] == 'error'){ echo 'border border-danger'; } ?>" >    
      <div class="card-body" >
        <form action="validar.php" method="post" id="loginform" class="form-horizontal" role="form">
          <div class="input-group text-center my-3">
            <h2 class="text-center w-100">Acesso administrativo</h2>
          </div>
          <div class="mb-1 input-group">
            <span class="input-group-addon px-3 py-1 badge-dark"><i class="fa-w fa-2x fas fa-at pt-1"></i></span>
            <input id="login-username" type="text" class="form-control form-control-lg" autocomplete="off" name="mail" value="" placeholder="login ou e-mail">                                        
          </div>

          <div class="mb-1 input-group">
            <span class="input-group-addon px-3 py-1 badge-dark"><i class="fa-w fa-2x fas fa-key pt-1"></i></span>
            <input id="login-password" type="password" class="form-control form-control-lg" autocomplete="off" name="senha" placeholder="senha">
          </div>


          <!-- Button -->
          <div class="col-sm-12 px-0 my-3">
            <button type="submit" class="btn btn-lg btn-warning w-100">Entrar</button>
          </div>
        </form>     
      </div>                     
    </div> 

    <div class="col-lg-7 order-lg-2 order-1 text-center">
        <img src="images/logo.svg" height="70" alt="">
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
