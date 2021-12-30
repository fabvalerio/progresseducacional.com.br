<div class="result">
<?php


    ob_start();
    @session_start();

    include('../painel/php/db.class.php');
    
    $_email = addslashes( trim( $_POST['email_aluno'] ) );



    try {

        $LoginSql = "SELECT aluno_id, aluno_nome, aluno_email, aluno_senha
                     FROM aluno 
                     WHERE aluno_email = '{$_email}' AND aluno_status = '1' ";
    
    
        $Login = new db();	   
        $Login->query($LoginSql);
        $Login->execute();
        $resultLogin = $Login->object();	
        
    } catch (PDOException $e) {
        throw new PDOException($e);
    }
    
            if(!empty($resultLogin->aluno_id)){





                $reg_contato_mensagem = '
                <table cellpadding="0" cellspacing="0" border="0" style="width:600px;margin:0 auto"><tbody><tr><td style="padding:15px"></td></tr><tr><td>
                <h2 style="font-family:Arial;font-size:25px;color:#333366;margin-bottom:0;margin:0">'.$resultLogin->aluno_nome.',</h2>
                <p style="font-family:Arial;font-size:17px;color:#666666;margin:0;padding:5px 0 10px 0">Seguem abaixo seus dados de login:</p>
                </td></tr><tr><td style="padding:5px"></td></tr>
                <tr><td><p style="text-align:center;font-family:Arial;font-weight:bold;color:#ff0033;font-size:24px;margin:0;padding:15px 0">Dados de Login</p></td></tr>
                <tr><td><table style="border:1px solid #cccccc;border-radius:20px;padding:10px;margin-bottom:15px;width:100%"><tbody><tr style="font-family:Arial;color:#666666;font-size:15px">
                <td><p><b>E-mail de Login:</b> <a href="mailto:'.$resultLogin->aluno_email.'" target="_blank">'.$resultLogin->aluno_email.'</a></p></td></tr>
                <tr><td><div style="width:100%;margin:0 auto;border-bottom:1px solid #cccccc"></div></td></tr>
                <tr style="font-family:Arial;color:#666666;font-size:15px"><td><p><b><span class="il">Senha</span> de acesso:</b> '.$resultLogin->aluno_senha.'</p></td></tr></tbody></table></td></tr>
                <tr><td style="font-family:Arial;font-size:17px;color:#666666">
                <p style="margin:0;padding:10px 0"><b>Você esqueceu a <span class="il">senha</span>?</b> Recomendamos a troca!</p>
                <p style="margin:0;padding:10px 0">Mude o seu futuro por meio dos cursos de educação financeira da Progress Educacional, com conteúdos  dinâmicos, atividades interativas, colaborativas e cooperativas em uma aprendizagem que desperta o interesse pelo mundo financeiro não somente das crianças e dos jovens, mas também dos adultos.</p>
                <p style="margin:0;padding:10px 0">Utilize letras maiúsculas e minúsculas com adição de números, isso tornará sua <span class="il">senha</span> mais segura. Evite colocar <span class="il">senhas</span> do tipo: 1234, 102030, data de aniversário, apelido ou a mesma <span class="il">senha</span> do Banco.</p>
                <p style="margin:0;padding:10px 0">Veja um exemplo de <span class="il">senha</span> com o nome José Silva: JoS3s1Lv4</p>
                <p style="margin:0;padding:10px 0">Em caso de dúvida, entre em contato com a nossa Central de Atendimento.</p>
                <p style="text-align:center;margin:0;padding:10px 0"><a href="https://www.progresseducacional.com/registro/aluno/login.html" target="_blank">WWW.PROGRESSEDUCACIONAL.COM</a></p>
                <p style="margin:0;padding:10px 0">Este e-mail é uma mensagem automática - por favor, não responda! Entre em contato conosco através da nossa Central de Atendimento.</p></td></tr>
                <tr><td style="padding:10px"></td></tr><tr><td><p style="text-align:center;font-family:Arial;font-size:17px;color:#666666;font-weight:600">Siga-nos nas redes sociais.</p></td></tr>
                <tr><td style="text-align:center;padding-bottom:30px"> 
                <a style="padding-right:10px" href="https://www.facebook.com/progresseducacional" target="_blank"><img style="border:0" src="https://www.progresseducacional.com/registro/images/facebook.png" alt="Facebook"></a> 
                <a style="padding-right:10px" href="https://www.instagram.com/progress_educacional/" target="_blank"><img style="border:0" src="https://www.progresseducacional.com/registro/images/instagram.png" alt="Instagram"></a> 
                <a href="https://www.linkedin.com/company/progresseducacional/"target="_blank"><img style="border:0" src="https://www.progresseducacional.com/registro/images/linkdin.png" alt="Linkedin" ></a> 
                </td></tr></tbody></table>
                ';


    
                // Enviar Email
                echo "<b>Sua senha foi enviado com sucesso para seu email</b>, por favor verifique a caixa de entrada ou spam.";

                
                // Configurar disparo
                include("../conf-sendemail.php");


                $msg .= 'Assunto: Minha Senha <br>';
                $msg .= 'Data e Hora: ' . date('Y-m-d H-i-s') . '<br/>';
                $msg .= '<br><hr>';
                $msg .= $reg_contato_mensagem;


                $assunto = "Minha Senha - ProgressEducacional";


                // Quem vai receber os contatos do site
                $destino = array(
                    $resultLogin->aluno_email => $resultLogin->aluno_nome,
                );

                /*
                $destino = array(            
                    'andre@ra3n.com.br' => '',
                );*/

                sendThisMail($destino,$assunto, $msg);

            }else{
                //echo 'erro';
                echo "<b>Ops!</b> Parece que tem algo errado. <br> Por favor, verificar o seu e-mail.";
            }
    


?>
</div>