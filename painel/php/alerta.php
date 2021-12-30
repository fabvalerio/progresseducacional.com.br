<?php

}

function alerta($texto, $link)
{


  $alertando .= '<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ALERTA</h4>
      </div>
      <div class="modal-body">
        '.utf8_decode($texto).'
      </div>
      <div class="modal-footer">
        <a href="'.$link.'" class="btn btn-danger">ok</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">$( document ).ready(function() { $(window).load(function(){ $(\'#myModal\').modal(\'show\'); }); });</script>

';

return $alertando;
}

?>




