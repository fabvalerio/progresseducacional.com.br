



<nav class="navbar border-bottom <?php if( $_SESSION['user_nivel'] == 'aluno' ){ echo 'border-warning'; }elseif( $_SESSION['user_nivel'] == 'escola' ){ echo 'border-primary';}else{ echo 'border-dark'; } ?> navbar-expand-lg navbar-light bg-light fixed-top navbar-fixed-top ">
  <a class="navbar-brand pb-0" href="#">
    <img src="<?php echo $url;?>images/logo.svg" alt="" height="30">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php 
    if( $_SESSION['user_nivel'] == 'admin' ){ 
  ?>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $url;?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/escola/visualizar">Escolas</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/professores/visualizar">Professores</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/aluno/visualizar">Alunos/Professores</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Configuração
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo $url;?>!/curso_categoria/visualizar">Categoria dos Cursos</a>
            <a class="dropdown-item" href="<?php echo $url;?>!/curso/visualizar">Cursos</a>
            <a class="dropdown-item" href="<?php echo $url;?>!/relatorios/visualizar">Relatórios</a>
            <a class="dropdown-item" href="<?php echo $url;?>!/cupom/visualizar">Cupom</a>
            <a class="dropdown-item" href="<?php echo $url;?>!/cupom/relatorio">Cupom Utilizados</a>
          </div>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
              <button type="button" id="DropConf" class="btn btn-secondary dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-top dropdown-menu-tip-nw dropdown-menu-right" aria-labelledby="DropConf">
              <a class="dropdown-item" href="<?php echo $url?>!/usuario/visualizar"><i class="fa fa-user"></i> Usu&aacute;rios</a>
              <a class="dropdown-item" href="<?php echo $url?>sair"><i class="fa fa-power-off"></i> Logout</a>
           </div>
        </div>
    </div>
  <?php 
  
  }
  if( $_SESSION['user_nivel'] == 'escola' ){ 
  
  ?>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $url;?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/escola/dados">Meus Dados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/aluno/lista">Alunos/Professores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/classe/visualizar">Classe</a>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
              <button type="button" id="DropConf" class="btn btn-secondary dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-top dropdown-menu-tip-nw dropdown-menu-right" aria-labelledby="DropConf">
              <a class="dropdown-item" href="<?php echo $url?>sair"><i class="fa fa-power-off"></i> Logout</a>
           </div>
      </div>
      
    </div>
  
  
  <?php
  
  }
  if( $_SESSION['user_nivel'] == 'aluno' ){ 
  
  ?>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $url;?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/aluno/dados">Meus Dados</a>
        </li>
        <?php if($_SESSION['user_tipo'] == 0){ ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $url;?>!/aluno/lista-alunos">Alunos</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $url;?>!/curso/lista">Cursos</a>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
              <button type="button" id="DropConf" class="btn btn-secondary dropdown-toggle mr-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-top dropdown-menu-tip-nw dropdown-menu-right" aria-labelledby="DropConf">
              <a class="dropdown-item" href="<?php echo $url?>sair"><i class="fa fa-power-off"></i> Logout</a>
           </div>
      </div>
      
    </div>
  
  
  <?php
  
  }
  
  ?>
  
</nav>