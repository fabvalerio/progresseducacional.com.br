<link rel="stylesheet" href="<?php echo $url; ?>assets/editor-less/codemirror.css">
<link rel="stylesheet" href="<?php echo $url; ?>assets/editor-less/themes/icecoder.css">
<script src="<?php echo $url; ?>assets/editor-less/codemirror.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/javascript.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/active-line.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/matchbrackets.js"></script>
<script src="<?php echo $url; ?>assets/editor-less/css.js"></script>
<style>.CodeMirror {border: 1px solid #ddd; line-height: 1.2;}</style>


<a class="btn btn-outline-warning" href="<?php echo $url?>!/<?php echo $link[1]?>/visualizar">Voltar</a>

<hr>
<h2 class="mb-3">CSS/LESS &bull; Cadastro</h2>

<?php

if( $link[3] == 'envio' ){

  $cad = new db();
  $cad->query( "INSERT INTO css (css_codigo, css_titulo) VALUES (:css_codigo, :css_titulo)" );
  $cad->bind(':css_codigo', $_POST['css_codigo']);
  $cad->bind(':css_titulo', $_POST['css_titulo']);

  if( $cad->execute() ){
   echo '<div class="p-3 text-white mb-3 badge-success">Salvo com sucesso!</div>';
   echo '<meta http-equiv="refresh" content="0;URL='.$url.'!/'.$link[1].'/editar/'.$cad->lastInsertId().'" />';
 }else{
   echo '<div class="p-3 text-white mb-3 badge-dange">Ops, ocorreu um erro!</div>';
 }

}

?>

<form enctype="multipart/form-data" action="<?php echo $url.'!/'.$link[1].'/'.$link[2]?>/envio" method="post">
  <table class="table table-bordered">
    <tr>
      <th width="150">T&iacute;tulo do CSS</th>
      <td valign="middle" colspan="8"><input class="form-control" name="css_titulo" type="text" autofocus id="css_titulo" maxlength="200" /></td>
    </tr>

    <tr>
      <td colspan="8">
        <textarea id="css_codigo" name="css_codigo">/* CSS / LESS */</textarea>
      </td>
    </tr>


    <tr>
      <td colspan="8">
        <input type="submit" name="Enviar" id="salvar" value="Enviar" class="btn btn-success w-100" />
      </td>
    </tr>
  </table>



</form>
<script>
  var editor = CodeMirror.fromTextArea(document.getElementById("css_codigo"), {
    lineNumbers: true,
    styleActiveLine: true,
    matchBrackets: true,
    mode: "text/x-less"
  });
</script>