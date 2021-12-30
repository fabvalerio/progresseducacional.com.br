<link rel="stylesheet" href="<?php echo $url; ?>assets/editor-less/codemirror.css">
<link rel="stylesheet" href="<?php echo $url; ?>assets/editor-less/themes/icecoder.css">

<script src="<?php echo $url; ?>assets/editor-less/codemirror.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/javascript.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/active-line.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/matchbrackets.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/css.js"></script>
<style>.CodeMirror {border: 1px solid #ddd; line-height: 1.2;}</style>


<?php

if( $link[4] == 'envio' ){

  $cad = new db();
  $cad->query( "UPDATE css SET css_codigo = :css_codigo, css_titulo = :css_titulo WHERE css_id = :css_id" );
  $cad->bind(':css_codigo', $_POST['css_codigo']);
  $cad->bind(':css_titulo', $_POST['css_titulo']);
  $cad->bind(':css_id', $_POST['css_id']);

  if( $cad->execute() ){
   echo '<div class="p-3 text-white mb-3 badge-success">Salvo com sucesso!</div>';
 }else{
   echo '<div class="p-3 text-white mb-3 badge-dange">Ops, ocorreu um erro!</div>';
 }

}

$vis = new db();
$vis->query( "SELECT * FROM css WHERE css_id = '".$link[3]."'" );
$vis->execute();
$edi = $vis->object();

?>

<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>
<hr>
<h2 class="mb-3">CSS/LESS &bull; Editar</h2>

<form enctype="multipart/form-data" action="<?php echo $url.'!/'.$link[1].'/'.$link[2].'/'.$link[3]?>/envio" method="post">
  <table class="table table-bordered">
    <tr>
      <th width="150" valign="middle">T&iacute;tulo</th>
      <td valign="middle" colspan="8">
        <input class="form-control" name="css_titulo" type="text" autofocus id="css_titulo" autocomplete="off" value="<?php echo $edi->css_titulo?>" size="60" maxlength="200" /> 
      </td>
    </tr>


    <tr>
      <td colspan="8">
        <textarea id="code" name="css_codigo" class="cm-s-icecoder"><?php echo $edi->css_codigo?></textarea>
      </td>
    </tr>

    <tr>
      <td  colspan="8">
        <input type="submit" name="Enviar" id="Enviar" value="Enviar" class="btn btn-success w-100"/>
        <input type="hidden" name="css_id" id="css_id" value="<?php echo $link[3]?>">
      </td>
    </tr>
  </table>
</form>


<script>
  $(document).ready(function(){
  var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    lineNumbers: true,
    styleActiveLine: true,
    matchBrackets: true,
    mode: "text/x-less"
  });
  });
</script>