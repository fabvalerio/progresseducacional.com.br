<?php

  //--------------------------
  // ADMIN
  //--------------------------
  
  if( $_SESSION['user_nivel'] == 'admin' ){


	$dados = new db();
	$dados->query("SELECT 
					(SELECT COUNT(aluno_id) FROM aluno WHERE aluno_tipo = 0) AS professores,
					(SELECT COUNT(aluno_id) FROM aluno WHERE aluno_tipo = 1) AS alunos,
					(SELECT COUNT(esc_id) FROM escola) AS escolas,
					(SELECT COUNT(curso_id) FROM curso WHERE curso_tipo = 1) AS curso,
					(SELECT COUNT(curso_id) FROM curso WHERE curso_tipo = 0) AS cursoProf,
					(SELECT COUNT(cursos_id) FROM aluno_cursos WHERE cursos_status = '1') AS aluno_cursos,
					(SELECT COUNT(cursos_id) FROM aluno_cursos WHERE cursos_status = '0') AS aluno_cursos_pagamentos
				");
	$dados->execute();
	$dds = $dados->object();

?>


<section id="minha-lista-de-desejos">
        
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-12 my-3">
                    <h1>
                       Área Administrativa
                    </h1>
                </div>
                <div class="col-12">
                    <div class="card card-body">
                        <div class="row g-3">
                            <div class="col-lg-3 mb-4">
                                <div class="card card-body bg-info text-white">
                                     <div class="d-flex justify-content-between">  
                                         <p>Cursos</p>
                                         <p><a href="<?php echo $url?>!/curso/visualizar" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Novo Carro"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-building-o"></i> <?php echo $dds->curso?></h3>
                                 </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <div class="card card-body bg-info text-white">
                                     <div class="d-flex justify-content-between">  
                                         <p>Cursos Professores</p>
                                         <p><a href="<?php echo $url?>!/curso/visualizar" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Novo Carro"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-building-o"></i> <?php echo $dds->cursoProf?></h3>
                                 </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <div class="card card-body bg-primary text-white">
                                     <div class="d-flex justify-content-between">  
                                         <p>Escolas cadastrados</p>
                                         <p><a href="<?php echo $url?>!/escola/visualizar" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Novo Carro"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-building-o"></i> <?php echo $dds->escolas?></h3>
                                 </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <div class="card card-body bg-danger text-white">
                                     <div class="d-flex justify-content-between">  
                                         <p>Professores cadastrados</p>
                                         <p><a href="<?php echo $url?>!/professores/visualizar" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Conversas"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-users"></i> <?php echo $dds->professores?></h3>
                                 </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <div class="card card-body bg-success text-white">
                                     <div class="d-flex justify-content-between">  
                                         <p>Alunos</p>
                                         <p><a href="<?php echo $url?>!/aluno/visualizar" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Relatório"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-user"></i> <?php echo $dds->alunos?></h3>
                                 </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <div class="card card-body bg-warning text-white">
                                     <div class="d-flex justify-content-between">  
                                         <p>Cursos Comprados</p>
                                         <p><a href="<?php echo $url?>!/aluno/visualizar" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Relatório"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-user"></i> <?php echo $dds->aluno_cursos?></h3>
                                 </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <div class="card card-body border-danger text-danger">
                                     <div class="d-flex justify-content-between">  
                                         <p>Cursos Pagamentos</p>
                                         <p><a href="<?php echo $url?>!/aluno/visualizar" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Relatório"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-user"></i> <?php echo $dds->aluno_cursos_pagamentos?></h3>
                                 </div>
                            </div>
                            <div class="col-lg-3 mb-4">
                               <div class="card card-body border-success text-success">
                                    <div class="d-flex justify-content-between">  
                                        <p>Meu saldo OnePay</p>
                                        <p><a href="<?php echo $url?>!/relatorio/visualizar" class="text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Adicionar Saldo"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                    </div>

									<?php
										include('php/conex.class.php');
										include('php/conf.php');
										
										//Verificar Saldo
										$resSaldo = new onepay;
										$resSaldo->url = $urlAPI."estabelecimentos/" . $idEstabelecimento . '/saldo';
										$resSaldo->token = $tokenRegistro;
										$resSaldo->method = 'GET';
										$dataSaldo =  $resSaldo->api($resSaldo->url, $resSaldo->token, $resSaldo->method);
										$objSaldo = json_decode($dataSaldo);
									?>
                                    <h6 class="mb-0">Atual R$ <?php echo $objSaldo->saldo->atual?></h6>
                                    <h6 class="mb-0">Futuro R$ <?php echo $objSaldo->saldo->futuro?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				        
                <div class="col-12 mt-3">
					<div class="card card-body bg-warning h-100">
						<div class="d-flex justify-content-between">  
							<p>Aviso</p>
						</div>
						<h5 class="lead"><i class="fa fa-exclamation-circle"></i> Toda ação realizada neste painel, não será possível desfazer as alterações. Faça tudo com atenção para evitar transtornos.</h5>
					</div>
                </div>

			</div>
        </div>


</section>


<!-- 
	
<section class="mt-4">
    <div class="container">
    <div class="card card-body">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
    </div>
            
</section>  


    <script src="<?php echo $url;?>js/jquery.canvasjs.min.js"></script>
	<script>
		window.onload = function () {
		
		var options = {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: "Registros",
				fontFamily: "Lato",
				fontWeight: "normal",
			},
			subtitles: [{
				text: "Escolas / Professores / Alunos",
				fontFamily: "Lato",
				fontWeight: "normal",
			}],
			// axisX: {
			// 	title: "Meses"
			// },
			axisY: {
				// title: "Escolas",
				titleFontColor: "#4F81BC",
				lineColor: "#4F81BC",
				labelFontColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY2: {
				// title: "Professores",
				titleFontColor: "#C0504E",
				lineColor: "#C0504E",
				labelFontColor: "#C0504E",
				tickColor: "#C0504E"
			},
			axisY3: {
				// title: "Escolas",
				titleFontColor: "#28a745",
				lineColor: "#28a745",
				labelFontColor: "#28a745",
				tickColor: "#28a745"
			},
			toolTip: {
				shared: true
			},
			legend: {
				cursor: "pointer",
				itemclick: toggleDataSeries
			},
			data: [{
				type: "spline",
				name: "Escolas",
				showInLegend: true,
				xValueFormatString: "MMM YYYY",
				yValueFormatString: "#,##0",
				dataPoints: [
					{ x: new Date(2021, 0, 1),  y: 120 },
					{ x: new Date(2021, 1, 1), y: 135 },
					{ x: new Date(2021, 2, 1), y: 144 },
					{ x: new Date(2021, 3, 1),  y: 103 },
					{ x: new Date(2021, 4, 1),  y: 93 },
					{ x: new Date(2021, 5, 1),  y: 129 },
					{ x: new Date(2021, 6, 1), y: 143 },
					{ x: new Date(2021, 7, 1), y: 156 },
					{ x: new Date(2021, 8, 1),  y: 122 },
					{ x: new Date(2021, 9, 1),  y: 106 },
					{ x: new Date(2021, 10, 1),  y: 137 },
					{ x: new Date(2021, 11, 1), y: 142 }
				]
			},
			{
				type: "spline",
				name: "Professores",
				axisYType: "secondary",
				showInLegend: true,
				xValueFormatString: "MMM YYYY",
				yValueFormatString: "#,##0",
				dataPoints: [
					{ x: new Date(2021, 0, 1),  y: 20.5 },
					{ x: new Date(2021, 1, 1), y: 300 },
					{ x: new Date(2021, 2, 1), y: 100 },
					{ x: new Date(2021, 3, 1),  y: 50 },
					{ x: new Date(2021, 4, 1),  y: 125 },
					{ x: new Date(2021, 5, 1),  y: 300 },
					{ x: new Date(2021, 6, 1), y: 200 },
					{ x: new Date(2021, 7, 1), y: 100 },
					{ x: new Date(2021, 8, 1),  y: 111 },
					{ x: new Date(2021, 9, 1),  y: 231 },
					{ x: new Date(2021, 10, 1),  y: 234 },
					{ x: new Date(2021, 11, 1), y: 232 }
				]
			},
			{
				type: "spline",
				name: "Alunos",
				axisYType: "secondary",
				showInLegend: true,
				xValueFormatString: "MMM YYYY",
				yValueFormatString: "#,##0",
				dataPoints: [
					{ x: new Date(2021, 0, 1),  y: 200.5 },
					{ x: new Date(2021, 1, 1), y: 200 },
					{ x: new Date(2021, 2, 1), y: 200 },
					{ x: new Date(2021, 3, 1),  y: 200 },
					{ x: new Date(2021, 4, 1),  y: 300 },
					{ x: new Date(2021, 5, 1),  y: 300 },
					{ x: new Date(2021, 6, 1), y: 300 },
					{ x: new Date(2021, 7, 1), y: 300 },
					{ x: new Date(2021, 8, 1),  y: 500 },
					{ x: new Date(2021, 9, 1),  y: 500 },
					{ x: new Date(2021, 10, 1),  y: 500 },
					{ x: new Date(2021, 11, 1), y: 200 }
				]
			}]
		};
		
		$("#chartContainer").CanvasJSChart(options);
		$(".canvasjs-chart-credit").html();
		
		
		
		function toggleDataSeries(e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
			e.chart.render();
		}
		
		}
	</script> 

-->

<?php

  }
  
//   print_r($_SESSION);
  
  //--------------------------
  // ESCOLA
  //--------------------------
  if( $_SESSION['user_nivel'] == 'escola' ){
  
  $visEsc = new db();
  $visEsc->query("SELECT COUNT(aluno_id) AS numPorf
                FROM aluno 
                WHERE aluno_tipo = '0' AND aluno_esc_id = '".$_SESSION['user_id']."'");
  $visEsc->execute();
  $rowEscola = $visEsc->object();
  
?>

<section id="minha-lista-de-desejos">
        
        <div class="container">
			  <div class="row g-3">
				  <div class="col-lg-12 my-3 position-relative d-flex align-items-center">
					  <h1 class="lead position-absolute p-3">
					  Seja bem vindo, tudo bem tudo bem <br> <b><?php echo $rowEscola->esc_nome; ?>.</b>
					  </h1>
					  <img src="images/banner-<?php echo $_SESSION['user_nivel']; ?>.php.jpg" alt="" class="w-100 rounded">
				  </div>
			  </div>
			  <div class="row g-3 d-flex align-items-center">           
                <div class="col-12">
                    <div class="card card-body">
                        <div class="row g-3">
                            <div class="col-lg-9 mb-3">
                               <div class="card card-body bg-warning h-100">
                                    <div class="d-flex justify-content-between">  
                                        <p>Aviso</p>
                                    </div>
                                    <h5 class="lead"><i class="fa fa-exclamation-circle"></i> Toda ação realizada neste painel, não será possível desfazer as alterações. Faça tudo com atenção para evitar transtornos.</h5>
                                </div>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <div class="card card-body bg-success text-white h-100">
                                     <div class="d-flex justify-content-between">  
                                         <p>Professores Cadastrados</p>
                                         <p><a href="<?php echo $url?>!/aluno/lista" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Relatório"><i class="fa-2x fa fa-plus-circle"></i></a></p>
                                     </div>
                                     <h3><i class="fa fa-users"></i> <?php echo $rowEscola->numPorf?></h3>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        
</section>

<?php
  
  }

  
  //--------------------------
  // ALUNO
  //--------------------------
  if( $_SESSION['user_nivel'] == 'aluno' ){
  
	$visAluno = new db();
	$visAluno->query("SELECT aluno_nome, (SELECT COUNT(cursos_id) FROM aluno_cursos WHERE aluno_aluno_id = '".$_SESSION['user_id']."') AS numCursos
				  FROM aluno 
				  WHERE aluno_id = '".$_SESSION['user_id']."'");
	$visAluno->execute();
	$rowAluno = $visAluno->object();
	
  ?>
  
  <section id="minha-lista-de-desejos">
		  
		  <div class="container">
			  <div class="row g-3">
				  <div class="col-lg-12 my-3 position-relative d-flex align-items-center">
					  <h1 class="lead position-absolute p-3">
					  Vamos começar a aprender,  
					  <br>
					    <b>
						  <?php echo ($_SESSION['user_tipo'] == 0) ? 'Prof(a).': ''; ?>
						  <?php echo $rowAluno->aluno_nome; ?>.
						</b>
					  </h1>
					  <img src="images/banner-<?php echo $_SESSION['user_nivel']; ?>.php.jpg" alt="" class="w-100 rounded">
				  </div>
			  </div>
			  <div class="row g-3 d-flex align-items-center">
				  <div class="col-12">
					  <div class="card card-body">
						  <div class="row g-3">
							  <div class="col-lg-6 mb-3">
								 <div class="card card-body bg-warning h-100">
									  <div class="d-flex justify-content-between">  
										  <p>Aviso</p>
									  </div>
									  <p><i class="fa fa-exclamation-circle"></i> Toda ação realizada neste painel, não será possível desfazer as alterações. Faça tudo com atenção para evitar transtornos.</p>
								  </div>
							  </div>
							  <div class="col-lg-3 mb-3">
								  <div class="card card-body bg-success text-white h-100">
									   <div class="d-flex justify-content-between">  
										   <p>Cursos</p>
										   <p><a href="<?php echo $url?>!/curso/lista" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Relatório"><i class="fa-2x fa fa-plus-circle"></i></a></p>
									   </div>
									   <h3><i class="fa fa-inbox"></i> Novo Curso</h3>
								   </div>
							  </div>
							  <div class="col-lg-3 mb-3">
								  <div class="card card-body bg-danger text-white h-100">
									   <div class="d-flex justify-content-between">  
										   <p>Meus Aprendizados</p>
										   <p><a href="<?php echo $url?>!/curso/lista" class="text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Relatório"><i class="fa-2x fa fa-plus-circle"></i></a></p>
									   </div>
									   <h3><i class="fa fa-inbox"></i> <?php echo $rowAluno->numCursos?></h3>
								   </div>
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
		  </div>
		  
  </section>
  
<?php
	// echo notify('danger', "teste");
	}
?>