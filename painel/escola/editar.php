<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


$edi = new db();
$edi->query( "SELECT *
              FROM escola
              WHERE esc_id = '".$link[3]."'" );
$edi->execute();
$row = $edi->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>
<?php if( empty($row->esc_status) ):?>
<a class="btn btn-outline-info" href="<?php echo $url?>!/<?php echo $link[1]?>/<?php echo $link[2]?>/<?php echo $link[3]?>/lido">Confirma Leitura</a>
<?php endif;?>

<hr>

<h2 class="mb-3">Visualizar • <?php echo $row->esc_nome?></h2>

<table class="table">
  <tr>
    <th width="100" valign="middle">Registro</th>
    <td valign="middle"><?php echo $row->esc_registro?></td>
  </tr>
  <tr>
    <th width="100" valign="middle">Razão</th>
    <td valign="middle"><?php echo $row->esc_nome?></td>
  </tr>
  <tr>
    <th width="100" valign="middle">Fantasia</th>
    <td valign="middle"><?php echo $row->esc_fantasia?></td>
  </tr>
  <tr>
    <th>CNPJ</th>
    <td><?php echo $row->esc_cnpj?></td>
  </tr>
  <tr>
    <th>Endereço</th>
    <td><?php echo $row->esc_end?>, num. <?php echo $row->esc_num?>, Bairro <?php echo $row->esc_bairro?> - <?php echo $row->esc_cep?></td>
  </tr>
  <tr>
    <th>Cidade/UF</th>
    <td><?php echo $row->esc_cidade?>/<?php echo $row->esc_estado?></td>
  </tr>
  <tr>
    <th>Responsável</th>
    <td><?php echo $row->esc_responsavel?></td>
  </tr>
  <tr>
    <th>Cargo</th>
    <td><?php echo $row->esc_cargo?></td>
  </tr>
  <tr>
    <th>CPF</th>
    <td><?php echo $row->esc_cpf?></td>
  </tr>
  <tr>
    <th>RG</th>
    <td><?php echo $row->esc_rg?></td>
  </tr>
  <tr>
    <th>E-mail</th>
    <td><?php echo $row->esc_email?></td>
  </tr>
  <tr>
  <tr>
    <th>Telefone</th>
    <td><?php echo $row->esc_telefone?></td>
  </tr>
  <tr>
    <th>Celular</th>
    <td><?php echo $row->esc_celular?></td>
  </tr>
    <th>Status</th>
    <td><?php echo !empty($row->esc_status) ? 'Ativo' : 'Inativo'?></td>
  </tr>
</table>
