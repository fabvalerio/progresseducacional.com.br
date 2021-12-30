<div class="result">
<?php

    
    ob_start();
    @session_start();

    include('../painel/php/db.class.php');
    
    $_email = addslashes( trim( $_POST['email_aluno'] ) );
    $_senha = addslashes( trim( $_POST['pass_aluno'] ) );



    try {

        $LoginSql = "SELECT aluno_id, aluno_tipo, aluno_id_onepay
                     FROM aluno 
                     WHERE aluno_email = '{$_email}' AND aluno_senha = '{$_senha}' AND aluno_status = '1' ";
    
    
        $Login = new db();	   
        $Login->query($LoginSql);
        $Login->execute();
        $resultLogin = $Login->object();	
        
    } catch (PDOException $e) {
        throw new PDOException($e);
    }
    
            if(!empty($resultLogin->aluno_id)){
    
                //3600 dias * 24 horas
			$_SESSION["user_id"] = $resultLogin->aluno_id;
			$_SESSION["user_nivel"] = "aluno";
			$_SESSION["user_tipo"] = $resultLogin->aluno_tipo;
			$_SESSION["idApi"] = $resultLogin->aluno_id_onepay;
                
                //echo 'logado';
                // header('location: ../painel');
                echo "<script>location.href=\"../painel\"</script>";
            }else{
                //echo 'erro';
                echo "Ops! Parece que tem algo errado. <br> Por favor, verificar o e-mail ou senha.";
            }
    


?>
</div>