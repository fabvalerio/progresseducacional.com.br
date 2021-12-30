
//Com o ID de sessão obtido, você deve definí-lo no lado cliente.

$(function() {

    var urlToken =  "consultar-token.php";


    //VERICAR TOKEN 
    $.getJSON( urlToken, function(data) {
        var validarToken = data['success'];

        if( validarToken != true ){

            console.log('OK');

            $('.checkout').html("<div class=\"card card-body bg-danger text-white\"><h1>Ops!</h1><p>Parece que estamos com problema no pagamento, tente novamente ou mais tarde!</p><a href=\"javascript:history.go(-1)\" class=\"btn btn-light\">Voltar</a></div>");

        }
    });

});

//Exibir no cartão
$('#numValidade').on('keyup', function () {
    var numValidade = $(this).val();
    $(".validadeNoCard").html(numValidade);
    $("#numValidade").removeClass("border-danger");
});
$('#nomeCartao').on('keyup', function () {
    var nomeCard = $(this).val();
    $(".cardNome").html(nomeCard);
    $("#nomeCartao").removeClass("border-danger");
});

$('#docCartao').on('keyup', function () {
    $("#docCartao").removeClass("border-danger");
});

$('#dataNascimento').on('keyup', function () {
    $("#dataNascimento").removeClass("border-danger");
});

//Validando Cartão
$('#numCartao').on('keyup', function () {
    //Quando o usuário seleciona o método de Cartão de Crédito, precisamos identificar a bandeira do cartão.
    
    var numCartao = $(this).val();
    var qntNumero = numCartao.length;

    $(".numNoCard").html(numCartao);


    if (qntNumero == 16) {


        //CARTÃO BANDEIRA
        var tgdeveloper = {

            getCardFlag: function(cardnumber) {
                var cardnumber = cardnumber.replace(/[^0-9]+/g, '');
          
                var cards = {
                    visa      : /^4[0-9]{12}(?:[0-9]{3})/,
                    mastercard : /^5[1-5][0-9]{14}/,
                    diners    : /^3(?:0[0-5]|[68][0-9])[0-9]{11}/,
                    amex      : /^3[47][0-9]{13}/,
                    discover  : /^6(?:011|5[0-9]{2})[0-9]{12}/,
                    hipercard  : /^(606282\d{10}(\d{3})?)|(3841\d{15})/,
                    elo        : /^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})/,
                    jcb        : /^(?:2131|1800|35\d{3})\d{11}/,       
                    aura      : /^(5078\d{2})(\d{2})(\d{11})$/     
                };
          
                for (var flag in cards) {
                    if(cards[flag].test(cardnumber)) {
                        return flag;
                    }
                }       
          
                return false;
            }
          
          }

          var bandeira = tgdeveloper.getCardFlag(numCartao);
          console.log(bandeira);

          //FIM CARTÃO BANDEIRA


                $(".bandeira-cartao").html("<img src=\"bandeiras/"+bandeira+".svg\" >");
                $("#bandeira").val(bandeira);

                if($("#bandeira").val() != ''){
                    $("#numValidade").removeClass('d-none');
                    $("#numCcv").removeClass('d-none');
                    $("#pagar").removeClass("d-none");
                }

                //Limpar a lista de parcelas
                $('#parcelas').empty().append('');


                    //Valirdar quantidade de vezes
                    var parcelas = 12;

                    for(var i=1; i<=parcelas; i++){
                        $("<option/>", {
                            value: i,
                            text: i+"x de R$"+($("#valor").val() / i).toFixed(2)
                        }).appendTo($("#parcelas"));
                    }
        

    }
});


function pagamento(){

    //verificar campos

    var nomeCartao = $("#nomeCartao").val();
    var cpf_cnpj = $("#docCartao").val();
    var dataNasc = $("#dataNascimento").val().split("/");
    var cartao = $("#numCartao").val();
    var bandeira = $("#bandeira").val();
    var validade = $("#numValidade").val().split("/");
    var ccv = $("#numCcv").val();

    if( nomeCartao == '' ){ $("#nomeCartao").addClass("border-danger"); return false; }
    else if( cpf_cnpj == '' ){ $("#docCartao").addClass("border-danger"); return false; }
    else if( dataNasc == '' ){ $("#dataNascimento").addClass("border-danger"); return false; }
    else if( validade == '' ){ $("#numValidade").addClass("border-danger"); return false; }
    else if( ccv == '' ){ $("#numCcv").addClass("border-danger"); return false; }


    //------------------------------------

    
    $(".resultadoCompra").html('<div class="m-3"><button class="btn btn-outline-danger w-100" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...</button></div>');
    $('#pagar').addClass('d-none');

    console.log('btn pagar');

    $.ajax({
        url: "../painel/curso/enviar-venda-cartao-credito.php",
        type: "post",
        data: $("#pagamento").serialize(),
        success: function(send){
            console.log("Enviando Pagamento");
            console.log(send);
            $(".resultadoCompra").html(send);
        }
    });

}

