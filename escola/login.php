<div class="result">
<?php

    
    ob_start();
    @session_start();

    include('../painel/php/db.class.php');
    
    $_email = addslashes( trim( $_POST['email_escola'] ) );
    $_senha = addslashes( trim( $_POST['pass_escola'] ) );



    try {

        $LoginSql = "SELECT esc_id
                     FROM escola 
                     WHERE esc_email = '{$_email}' AND esc_senha = '{$_senha}' AND esc_status = '1' ";
    
    
        $Login = new db();	   
        $Login->query($LoginSql);
        $Login->execute();
        $resultLogin = $Login->object();	
        
    } catch (PDOException $e) {
        throw new PDOException($e);
    }
    
            if(!empty($resultLogin->esc_id)){
    
                //3600 dias * 24 horas
			$_SESSION["user_id"] = $resultLogin->esc_id;
			$_SESSION["user_nivel"] = "escola";
                
                //echo 'logado';
                // header('location: ../painel');
                echo "<script>location.href=\"../painel\"</script>";
            }else{
                //echo 'erro';
                echo "Ops! Parece que tem algo errado. <br> Por favor, verificar o e-mail ou senha.";
            }
    


?>
</div>