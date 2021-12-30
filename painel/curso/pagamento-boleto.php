
<?php 

//echo ">>>>"; print_r($_GET);  echo "<<<<"; 

if( !empty($_GET['desconto']) ){
  $valor = $_GET['valor']-$_GET['desconto'];
}else{
  $valor = $_GET['valor'];
}

?>

          <div class="checkout-boleto">

            <h2>Pagamento via boleto bancário</h2>

            <form class="row g-2 mt-4" id="pagamento">
          
              <div class="form-floating input-group mb-3 col-lg-12">

                <div class="input-group-prepend">
                  <span class="input-group-text bg-light" id="inputGroup-sizing-default">R$</span>
                </div>
                <input type="text" class="form-control" id="valor" name="valor" readonly value="<?php echo $valor;?>" >
                
                <div class="input-group-prepend">
                  <span class="input-group-text bg-light" id="inputGroup-sizing-default">Valor a ser pago</span>
                </div>
              </div>
          
         
              <input type="hidden" id="descricao" name="descricao" value="<?php $_GET['descricao']?>">
              <input type="hidden" id="pedido_venda" name="pedido_venda" value="<?php echo $_GET['codigo']?>">
              <input type="hidden" id="clienteId" name="clienteId" value="<?php echo $_GET['idApi']?>">
              <input type="hidden" id="tipo" name="tipo" value="<?php echo $_GET['tipo']?>">
              <input type="hidden" id="cupom" name="cupom" value="<?php echo $_GET['cupom']?>">
              <input type="hidden" id="idCupom" name="idCupom" value="<?php echo $_GET['idCupom']?>">
          
              <div class="form-floating col-lg-12">
                <button id="pagar" type="button" class="btn btn-success w-100" onclick="pagamento()">Gerar Boleto</button>  
              </div>
          
              <div class="resultadoCompra w-100 p-3"></div>
          
          
            </form>
          </div>
          
    


    <script src="curso/js/pagamento-boleto.js"></script>
  
