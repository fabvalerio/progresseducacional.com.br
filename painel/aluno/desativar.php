<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'admin' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}

?>

<h2 class="mb-3">Deseja realmente desativar? </h2>
<!-- <p class="lead"><?php echo $row->aluno_nome?></p> -->

	<div class="card">
		<div class="card-body">
			<button class="btn btn-lg btn-outline-warning" name="Nao" type="button" onclick="javascript:history.go(-1);" /><i class="fas fa-chevron-left"></i> N&atilde;o &bull; Voltar</button>
			<a href="<?php echo $url?>!/aluno/desativar/<?php echo $link[3]?>/<?php echo $link[4]?>/desativar" class=" btn-lg btn btn-success">Sim • Salvar</a>
		</div>
	</div>

<?php



	 if( !empty($link[5] ) ) {		
			if( $link[5] == 'desativar' ) {		
				$editar = new db();
				$editar->query( "UPDATE aluno_cursos SET cursos_status = :cursos_status WHERE cursos_id = :cursos_id" );
		    $editar->bind(':cursos_status', '0');
		    $editar->bind(':cursos_id', $link[3]);
		    if($editar->execute()){
		        echo notify('success', "Ativação realizada com sucesso!");
				echo '<meta http-equiv="refresh" content="3;URL='.$url.'!/aluno/editar/'.$link[4].'" />';
			}else{
		        echo notify('danger', "Ops, ocorreu um erro!");
			}
		}
	}

?>