<h2 class="mb-3">Deseja realmente excluir, <small><?php echo $_GET['titulo']; ?></small> ?</h2>

<h3 class="bg-danger text-white p-3 mb-3"><i class="fas fa-skull-crossbones"></i> Cuidado, essa opção é sem volta!!!</h3>

<form action="" id="form">
	<div class="card">
		<div class="card-body">
			<input type="hidden" name="id" value="<?php echo $link[3]; ?>">
			<input type="hidden" name="redirecionar" value="visualizar">
			<input type="hidden" name="tabela" value="css">
			<input type="hidden" name="coluna" value="css_id">
			<input type="hidden" name="url" value="<?php echo $url ?>">
			<button class="btn btn-lg btn-info" name="Nao" type="button" onclick="javascript:history.go(-1);" /><i class="fas fa-chevron-left"></i> N&atilde;o &bull; Voltar</button>
			<button class="btn btn-lg btn-danger" id="deletar" name="Sim" type="button"><i class="fas fa-check"></i> Sim</button>
		</div>
	</div>
</form>

<div id="result"></div>

<script src="<?php echo $url ?>php/db.class.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript">
	/* DELETAR */
	deletar('<?php echo $url; ?>');
</script>
