<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php'; 

function sendThisMail($receber_emails,$assunto,$conteudo){

	//GLOBAL $receber_emails;

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
	//Server settings
    $mail->CharSet   = 'UTF-8';
    $mail->SMTPDebug = false;                                 // Enable verbose debug output
    $mail->isSMTP();  
    $mail->Host     = "smtps.uhserver.com";                   // Specify main and backup SMTP servers   
    $mail->Username = "contato@progresseducacional.com";                 // SMTP username
    $mail->Password = "Contato2021**";                        // SMTP password                        
	// TCP port to connect to
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls';                                // Enable TLS encryption, `ssl` also accepted
    $mail->SMTPAutoTLS = false;
    $mail->Port = 587;                                        // TCP port to connect to

		//Recipients
		$mail->setFrom("contato@progresseducacional.com");
		//$mail->addAddress("contato@progresseducacional.com");     // Add a recipient

		foreach($receber_emails as $email => $name){
			$mail->addAddress($email, $name); 
		}

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $assunto;
		$mail->Body    = $conteudo;
		// $mail->AltBody = $msg;

		$mail->send();
		// echo 'Message has been sent';
	} catch (Exception $e) {
		// echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}

}



?>