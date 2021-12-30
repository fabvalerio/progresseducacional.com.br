<?php

	/*Validar Usuário*/
	if(  $_SESSION['user_nivel'] != 'aluno' ){
		echo '<meta http-equiv="refresh" content="0;URL='.$url.'">';
		exit();
	}


    $InputSQL = new db();
    $InputSQL->query( "SELECT *
                       FROM curso
                       WHERE curso_id = '".$link['3']."'" );
    $InputSQL->execute();
    $row = $InputSQL->object();
    
?>

<hr>

<div class="container">
<div class="row">
    <div class="col-lg-8">
                <h2 class="mb-3">Finalizar compra</h2>
                <p>O pagamento parcelado está disponível apenas com cartões de crédito. <br> Não é possível escolher parcelamento com pagamento via boleto.</p>

                <div class="my-5 mx-lg-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Cupom de Desconto</span>
                    </div>
                    <input type="text" class="form-control" placeholder="#SeuCupom" aria-label="#SeuCupom" id="cupom" aria-describedby="validar">
                    <div class="input-group-append">
                      <a class="btn btn-outline-success" href="#" id="validar">Validar</a>
                    </div>
                  </div>

                  <input type="hidden" name="desconto" id="valDesc" value="">
                  <input type="hidden" name="cupId" id="cupId" value="">

                  <div class="result-cupom"></div>

                </div>
                
                <div class="my-5 text-center">
                    <?php
                        if(
                          $row->curso_validade_data_inicio < date('Y-m-d') 
                          && !empty($row->curso_validade_data_inicio)
                    ){
                        echo '<spam class="btn btn-lg w-100 btn-danger"><i class="fas fa-times"></i> Expirado</spam>';
                        echo '<a href="'.$url.'!/curso/aluno-adquirir" class="btn btn-lg w-100 btn-warning mt-2"><i class="fa fa-chevron-left"></i> Voltar</a>';
                      }else{  
                        ?>
                        <a class="btn my-lg-0 my-1 btn-lg btn-outline-success" id="pag-credito" href="#"><i class="fa fa-credit-card"></i> Pagar com cartão de crédito até 12x</a>
                        <a class="btn my-lg-0 my-1 btn-lg btn-success" id="pag-boleto" href="#"><i class="fa fa-barcode"></i> Pagar com boleto bancário</a>
                        <?php
                          // echo '<a href="'.$url.'!/curso/pagar/'.$link[3].'" class="btn btn-success btn-lg w-100 py-3 text-white"><i class="fa fa-check"></i> Finalizar o pagamento</a>';
                      } 
                    ?>
                    
                    </div>
                <div class="mt-5">
                    <img src="<?php echo $url?>images/pagamentos/boleto.svg" alt="MasterCard" height="18">
                    <!-- <img src="<?php echo $url?>images/pagamentos/pix.png" alt="MasterCard" height="18"> -->
                    <img src="<?php echo $url?>images/pagamentos/card-mastercard.svg" alt="MasterCard"height="18">
                    <img src="<?php echo $url?>images/pagamentos/card-visa.svg" alt="VISA" height="18">
                    <img src="<?php echo $url?>images/pagamentos/card-elo.svg" alt="elo" height="18">
                    <img src="<?php echo $url?>images/pagamentos/card-hiper.svg" alt="hiper" height="18">
                    <img src="<?php echo $url?>images/pagamentos/card-amex.svg" alt="AMEX"height="18">
                </div>

                <div class="result-pagamento"></div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-3">Resumo</h2>

                <div>
                  <h5 class="font-weight-bolder mb-4">
                      Curso <?php echo $row->curso_nome?>
                  </h5>
                  <div class="d-flex my-1">
                      <strong class="mr-auto">Total</strong>
                      R$ <span id="total"><?php echo $row->curso_valor?></span>
                  </div>
                </div>

                <div>
                  <div class="d-flex my-1">
                      <strong class="mr-auto">Desconto</strong>
                      R$ <span id="desconto">0.00</span>
                  </div>
                </div>

                <div>
                  <hr>
                  <div class="d-flex my-1">
                      <strong class="mr-auto">SubTotal</strong>
                      R$ <span id="subtotal"><?php echo $row->curso_valor?></span>
                  </div>
                </div>


                <div>
                    <hr>
                    <p>A lei exige que a ProgressEducacional colete impostos sobre transações aplicáveis para compras feitas em determinadas regiões fiscais.</p>
                    <p>Ao concluir sua compra, você concorda com estes <a href="#" data-toggle="modal" data-target="#TermoServico">Termos de Serviço.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="TermoServico" tabindex="-1" aria-labelledby="TermoServicoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TermoServicoLabel">Termos de Uso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include('termo.php');?>
      </div>
    </div>
  </div>
</div>



<script>


    $("#validar").click(function(){
        var cupom = $("#cupom").val().replace("#", "");


        console.log('Verificar Desconto ' + cupom);

        $(".result-cupom").html('<div class="text-center py-3"><div class="spinner-border text-danger" role="status"><span class="sr-only">Loading...</span></div><div>');

      $.get('cupom/verificar.php?codigo=' + cupom, function(data, status){ 
        $(".result-cupom").html(data);
        $(".result-pagamento").html('');
       });
      return false;

    });
  

    $("#pag-credito").click(function(){
      console.log("Pagamento credito");
      var cupom = $("#cupom").val().replace("#", "");
      var desconto = $('#valDesc').val();
      var cupId = $('#cupId').val();
      $.get('curso/pagamento-cartao.php?idCupom='+cupId+'&codigo=<?php echo $link['3']?>&desconto='+desconto+'&cupom='+cupom+'&idApi=<?php echo $_SESSION["idApi"]?>&valor=<?php echo $row->curso_valor?>&descricao=<?php echo $row->curso_nome?>&tipo=2', function(data, status){ 
        $(".result-pagamento").html(data);
       });
      return false;
    });


    $("#pag-boleto").click(function(){
      console.log("Pagamento boleto");
      var cupom = $("#cupom").val().replace("#", "");
      var desconto = $('#valDesc').val();
      var cupId = $('#cupId').val();
      $.get('curso/pagamento-boleto.php?idCupom='+cupId+'&codigo=<?php echo $link['3']?>&desconto='+desconto+'&cupom='+cupom+'&idApi=<?php echo $_SESSION["idApi"]?>&valor=<?php echo $row->curso_valor?>&descricao=<?php echo $row->curso_nome?>&tipo=1', function(data, status){ 
        $(".result-pagamento").html(data);
       });
      return false;
    });

</script>