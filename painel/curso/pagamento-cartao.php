
<?php 

//echo ">>>>"; print_r($_GET);  echo "<<<<"; 

if( !empty($_GET['desconto']) ){
  $valor = $_GET['valor']-$_GET['desconto'];
}else{
  $valor = $_GET['valor'];
}

?>

          <div class="checkout">
            <div class="credit-card-box">
              <div class="flip">
                <div class="front">
                <div class="bandeira-cartao mb-3 logo"></div>
                  <div class="chip"></div>
          
                  <div class="number"><div class="numNoCard"></div></div>
                  <div class="card-holder">
                    
                    <label>Número</label>
                    <div class="cardNome"></div>
                  </div>
                  <div class="card-expiration-date">
                    <label>Validade</label>
                    <div class="validadeNoCard"></div>
                  </div>
                </div>
                <div class="back">
                  <div class="strip"></div>
                  <div class="ccv">
                    <label>CCV</label>
                    ***
                  </div>
                </div>
              </div>
            </div>
            <form class="row g-2" id="pagamento">
          
              <div class="form-floating input-group col-lg-12 my-2">


                    <div class="input-group-prepend">
                      <span class="input-group-text bg-light" id="inputGroup-sizing-default">R$</span>
                    </div>
                    <input type="text" class="form-control" id="valor" name="valor" readonly value="<?php echo $valor;?>" >
                    
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-light" id="inputGroup-sizing-default">Valor a ser pago</span>
                    </div>
                  </div>



          
              <div class="form-floating col-lg-4 my-3">
                <input type="text" class="form-control" id="nomeCartao" name="nomeCartao" maxlength="30" autocomplete="off">
                <label for="nomeCartao">Nome no cartão</label>
              </div>
          
              <div class="form-floating col-lg-4 my-3">
                <input type="text" class="form-control" id="docCartao" name="docCartao" maxlength="30" aria-describedby="somenteNumeroCartao" autocomplete="off">
                <label for="docCartao">CPF ou CNPJ do cartão</label>
                <!-- <div id="somenteNumeroCartao" class="form-text">Somente número</div> -->
              </div>
          
              <div class="form-floating col-lg-4 my-3">
                <input type="text" class="form-control" id="dataNascimento" name="dataNascimento" maxlength="10" autocomplete="off">
                <label for="dataNascimento">Data de nascimento do responsável</label>
              </div>
          
              <div class="form-floating col-lg-4 my-3">
                <input type="text" class="form-control" id="numCartao" name="numCartao" maxlength="16" minlength="16" autocomplete="off">
                <label for="numCartao">Número do cartão</label>
                <!-- <div id="" class="form-text">Somente número</div> -->
              </div>
              <input type="hidden" name="bandeira" id="bandeira" value="" />
          
              <div class="form-floating col-lg-4 my-3">
                <input type="text" class="form-control d-none" id="numValidade" name="numValidade" maxlength="7" autocomplete="off">
                <label for="numValidade">Data de validade</label>
              </div>
          
              <div class="form-floating col-lg-4 my-3">
                <input type="password" class="form-control d-none" id="numCcv" name="numCcv" maxlength="3" autocomplete="off">
                <label for="numCcv">CCV</label> 
              </div> 
              <div class="form-floating col-lg-12"><hr></div>
          
              
              <div class="col-lg-2 col-2">
                <div class="bandeira-cartao p-2 card h-100 w-100 d-flex justify-content-center align-items-center"></div>
              </div>
          
              <div class="form-floating col-lg-10 col-10">
                <select name="parcelas" id="parcelas" class="form-select form-control">
                  <option disabled selected>digite o número do cartão primeiro</option>
                </select>
                <label for="numCcv">Quantidade de vezes</label>
              </div>
          
              <input type="hidden" id="descricao" name="descricao" value="<?php $_GET['descricao']?>">
              <input type="hidden" id="pedido_venda" name="pedido_venda" value="<?php echo $_GET['codigo']?>">
              <input type="hidden" id="clienteId" name="clienteId" value="<?php echo $_GET['idApi']?>">
              <input type="hidden" id="tipo" name="tipo" value="<?php echo $_GET['tipo']?>">
              <input type="hidden" id="cupom" name="cupom" value="<?php echo $_GET['cupom']?>">
              <input type="hidden" id="idCupom" name="idCupom" value="<?php echo $_GET['idCupom']?>">

              <div class="form-floating col-lg-12">
                <button id="pagar" type="button" class="btn btn-success w-100 d-none mt-4" onclick="pagamento()">Finalizar Pagar</button>  
              </div>
          
              <div class="resultadoCompra w-100 p-3"></div>
          
          
            </form>
          </div>
          
    </div>
    

    <script src="curso/js/pagamento-cartao.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script>

        $(document).ready(function() {
            $('#dataNascimento').mask('00/00/0000', {reverse: true});
            $('#numValidade').mask('00/0000');
        });

    </script>    

  </body>
</html>