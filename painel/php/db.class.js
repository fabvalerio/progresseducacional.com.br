  /* REGISTRO */
  function cadastro(linkUrl, tinymce){

    jQuery(document).ready(function() {
      jQuery('#salvar').click(function() {

        if( tinymce == 'tinyMCE' ){ 
          tinyMCE.triggerSave();
        } 

        var dados = jQuery('#cadastro').serialize();
        var registro = linkUrl+'php/registro.php';

        /*Efeito subir e aprecer*/
        jQuery("#salvar").fadeToggle("slow");
        setTimeout(function() { jQuery('#salvar').fadeIn('show');}, 5000);

        jQuery.ajax({
          url : registro,
          type : 'post',
          data : dados,
          beforeSend : function(){
           jQuery("#result").html("ENVIANDO...");
         }
       })
        .done(function(msg){
          jQuery("#result").html(msg);
        })
        .fail(function(jqXHR, textStatus, msg){
          jQuery("#result").html(msg);
        }); 

      });
    });
  }  

  /* EDITAR */
  function editar(linkUrl, coluna, id, tinymce){

    jQuery(document).ready(function() {
      jQuery('#salvar').click(function() {
      
        if( tinymce == 'tinyMCE' ){ 
          tinyMCE.triggerSave();
        } 

        /*Efeito subir e aprecer*/
        jQuery("#salvar").fadeToggle("slow");
        setTimeout(function() { jQuery('#salvar').fadeIn('show');}, 5000);

        var dados = jQuery('#form').serialize();
        var registro = linkUrl+'php/editar.php';
        jQuery.ajax({
          url : registro,
          type : 'post',
          data : dados+'&coluna='+coluna+'&id='+id,
          beforeSend : function(){
           jQuery("#result").html("ENVIANDO...");
         }
       })
        .done(function(msg){
          jQuery("#result").html(msg);
        })
        .fail(function(jqXHR, textStatus, msg){
          jQuery("#result").html(msg);
        }); 

      });
    });
  }



  /* DELETAR */
  function deletar(linkUrl){

    jQuery(document).ready(function() {
      jQuery('#deletar').click(function() {

        /*Efeito subir e aprecer*/
        jQuery("#deletar").fadeToggle("slow");
        setTimeout(function() { jQuery('#deletar').fadeIn('show');}, 5000);

        var dados = jQuery('#form').serialize();
        console.log(dados);
        var registro = linkUrl+'php/deletar.php';

        jQuery.ajax({
          url : registro,
          type : 'post',
          data : dados,
          beforeSend : function(){
           jQuery("#result").html("ENVIANDO...");
           console.log(dados);
         }
       })
        .done(function(msg){
          jQuery("#result").html(msg);
          console.log(dados);
        })
        .fail(function(jqXHR, textStatus, msg){
          jQuery("#result").html(msg);
          console.log(dados);
        }); 

      });
    });
  }
