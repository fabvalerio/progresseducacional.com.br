
<?php


session_start();	


ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../php/db.class.php');



if( !empty( $_GET['codigo'] ) ){

    $codigo = "#".$_GET['codigo'];

    $dtHone =date('Y-m-d');

    $sql = "SELECT cup_valor, cup_id
    FROM cupom
    WHERE cup_data <= '{$dtHone}' 
        AND cup_validade >= '{$dtHone}'
        AND cup_nome = '{$codigo}'
        AND cup_status = 1";
    $ver = new db();
    $ver->query($sql);
    $ver->execute();

    $verRow = $ver->object();

    if( !empty($verRow->cup_valor) ){
        echo '<div class="alert bg-warning">Cupom de '.$verRow->cup_valor.'% aplicado com sucesso 😍!</div>';

        ?>
        <script>
            var vlCurso = $('#total').html();
            var vlPorc = '<?php echo $verRow->cup_valor?>';
            var calculo =  ( vlCurso * ( vlPorc / 100) );
            var total =  vlCurso - ( vlCurso * ( vlPorc / 100) );

            console.log(calculo);

            $("#desconto").html(calculo.toFixed(2));
            $("#subtotal").html(total.toFixed(2));
            $("#valDesc").val(calculo.toFixed(2));
            $("#cupId").val('<?php echo $verRow->cup_id?>');

        </script>
        <?php
    }else{
        echo '<div class="alert bg-danger text-white">Cupom inserido é inválido ou está expirado 😪!</div>';
        ?>
        <script>
            $("#desconto").html('0.00');
            $("#subtotal").html($('#total').html());
            $("#cupom").val('');
            $("#valDesc").val('');
            $("#cupId").val('');
        </script>
        <?php
    }

}

?>