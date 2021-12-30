
<?php

/* Função de Seleção Ativa/Inati */
function SelectON( $key, $value = NULL ){
  if( $value === '1' ){ $selected[$value] = 'selected'; }
  elseif( $value === '0' ){ $selected[$value] = 'selected'; }

  $select = '<select name="'.$key.'" class="custom-select">
  <option value="1" '.$selected[1].'>Ativo</option>
  <option value="0" '.$selected[0].'>Inativo</option>
  </select> ';
  $selected[$value] = ''; 
  return $select;
}


/* Função de Seleção */
function Select( $tabela, $coluna, $valor, $where, $selectValue = NULL, $id ){

  $_where = '';
  $valorSelec = '';
  $resultado = '';
  $where = empty($where) ? '' : $where;

  if( !empty( $where ) ) $_where = " WHERE ".$where;
  
  $visSQL = "SELECT * FROM ".$tabela.$_where." ORDER BY ".$coluna." ASC";
  $vis = new db();
  $vis->query( $visSQL );

  if( !empty($vis->row()) ){

    $resultado .= '<select name="'.$id.'" id="'.$id.'" class="custom-select" requered>';
    $resultado .= '<option selected disabled value="">Selecione</option>'."\n";

    foreach( $vis->row() AS $row ){

     if( $row[$valor] == $selectValue AND !empty($selectValue) ){ 
      $valorSelec = 'selected="selected"';
    }

    $resultado .= '<option '. $valorSelec .' value="'.($row[$valor]).'">'.($row[$coluna]).'</option>'."\n";
    $valorSelec = '';

  }
  $resultado .= '</select>';
}

return $resultado;

}



/*armazenar valor Post-GE*/
function input($string, $valorOrig = NULL)
{
 if( !empty($_POST[$string]) ):
   $valor = $_POST[$string];
 elseif( !empty($_GET[$string]) ):
   $valor = $_GET[$string];
 else:
   $valor = $valorOrig;
 endif;

 return $valor;

}

function inputs( $string, $valor )
{
  if( $_POST[$string] == $valor ) return  'checked="CHECKED"';
  if( $_GET[$string] == $valor )  return  'checked="CHECKED"';
  if( $string == $valor )         return  'checked="CHECKED"';
}


/*validar envio--------------------------------------------------------------------------------------*/
function validarInput($campos)
{
  if( !empty( $campos ) ):
    foreach( $campos as $valores )
    {
      if( empty($_POST[$valores]) ):
        $Result .= "#".$valores.'{border:1px solid red !important;box-shadow: 0px 0px 10px 1px red;}'."\n";
      endif;
    }
  endif;

  /*montar*/
  if( !empty($Result) ):
   $montar .= '<style>'.$Result.'</style>';
   return  $montar;
 endif;
}

/*fim validar envio--------------------------------------------------------------------------------------*/

function moeda( $valor )
{
  return number_format( $valor, 2, ',', '.' );
}
function _float( $valor )
{
  $valor = str_replace('.', '', $valor);
  $valor = str_replace(',', '.', $valor);
  return $valor;
}
function _int( $valor )
{
  $valor = explode('.', $valor);
  return $valor[0];
}

/*NOME DE ARQUIVO--------------------------------------------------------------------------------------*/
function nome_arquivo($nome)
{
  return md5(nome).date('YmdHisu').".".@end(@explode('.', $nome));
}

/*Status Post*/
function StatusPost( $var ){
  if( $var == 'on' ):
    $res = '1';
  else:
    $res = '0';
  endif;

  return $res;
}

/*Status Post Retorno*/
function status( $var ){
  if( $var == '1' ):
    $res = 'Ativo';
  else:
    $res = 'Inativo';
  endif;

  return $res;
}

?>