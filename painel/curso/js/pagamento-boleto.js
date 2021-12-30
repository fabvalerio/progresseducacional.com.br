
//Com o ID de sessão obtido, você deve definí-lo no lado cliente.

$(function() {

    var urlToken =  "consultar-token.php";


    //VERICAR TOKEN 
    $.getJSON( urlToken, function(data) {
        var validarToken = data['success'];

        if( validarToken != true ){

            console.log('OK');

            $('.checkout').html("<div class=\"card card-body bg-danger  w-100 text-white\"><h1>Ops!</h1><p>Parece que estamos com problema no pagamento, tente novamente ou mais tarde!</p><a href=\"javascript:history.go(-1)\" class=\"btn btn-light\">Voltar</a></div>");

        }
    });

});



function pagamento(){

    $(".resultadoCompra").html('<button class="btn btn-outline-danger w-100" type="button" disabled><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando...</button>');

    $('#pagar').addClass('d-none');
    

    //verificar campos

    var valor          = $("#valor").val();
    var dataVencimento = $("#dataVencimento").val();
    var descricao      = $("#descricao").val();
    var pedido_venda   = $("#pedido_venda").val();
    var clienteId      = $("#clienteId").val();


    var msg = '<div class="card card-body bg-danger text-white">Aguarde um momento 🕐, estamos gerando o boleto...</div>';


    if( valor == '' ){               $(".resultadoCompra").html(msg); console.log(msg);  }
    else if( dataVencimento == '' ){ $(".resultadoCompra").html(msg); console.log(msg);  }
    else if( descricao == '' ){      $(".resultadoCompra").html(msg); console.log(msg);  }
    else if( pedido_venda == '' ){   $(".resultadoCompra").html(msg); console.log(msg);  }
    else if( clienteId == '' ){      $(".resultadoCompra").html(msg); console.log(msg);  }


    //------------------------------------

    console.log('btn pagar');

    $.ajax({
        url: "../painel/curso/enviar-venda-boleto.php",
        type: "post",
        data: $("#pagamento").serialize(),
        success: function(send){
            console.log("Enviando Pagamento");
            console.log(send);
            $(".resultadoCompra").html(send);
        }
    });

}

