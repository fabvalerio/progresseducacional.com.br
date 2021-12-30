<?php

include("conf-sendemail.php");

extract($_POST);


    $msg = '<br><hr><br>';
    $msg .= 'Assunto: Formulário site <br>';
    $msg .= 'Data e Hora: ' . date('Y-m-d H-i-s') . '<br/>';
    $msg .= '<br><hr>';
    $msg .= $reg_contato_mensagem;


	$assunto = "Formulário site";


    // Quem vai receber os contatos do site
    $destino = array(
        'contato@progresseducacional.com' => '',
    );

    /*
    $destino = array(            
        'andre@ra3n.com.br' => '',
    );*/

	sendThisMail($destino,$assunto, $msg);

    // Envia para o cliente o aviso
	// $destino2 = array(            
    //     ''.$email.'' => '',       
    // );

    // Aviso para o cliente
    /*
    $msg2 = '<br><hr><br>';
    $msg2 .= '<img src=\'http://hdtdigital.com.br/images/logo.png\'> <br><br>';

    $msg2 .= 'Recebemos sua mensagem em breve entraremos em contato <br><br>';
    $msg2 .= '<br><hr>';	*/

// $msg2 = '
// <table width="740"  bordercolor="f1f1f1" cellspacing="10" cellpadding="10" align="center"  style="border: 10px solid #f1f1f1;">
// <tbody>
// <tr style="border: 0px;">
// <td style="text-align: center;" colspan="5">
// <img src="https://www.hdtdigital.com.br/images/logo.png">
// </td>
// </tr>

// <tr style="border: 0px;">
// <td>
// <b>Olá, '.$_POST['nome'].' </b><br><br>
// Estamos muito felizes em receber sua mensagem. <br><br>
// Em breve entraremos em contato e você terá mais informações sobre nossos serviços. <br><br>
// Obrigado por nos contatar e até breve! <br><br>
// Equipe HDT Digital <br><br>
// </td>
// </tr>

// <tr style="border: 0px;">
// <td align="center">
// <a href="https://www.hdtdigital.com.br"> www.hdtdigital.com.br </a>
// </td>
// </tr>
// </tbody>
// </table>';

// sendThisMail($destino2,$assunto, $msg2);

?>
