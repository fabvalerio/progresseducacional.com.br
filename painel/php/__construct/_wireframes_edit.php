<?php

    class WireFrames
    {

        private $area;
        private $pasta;
        private $url;
        private $val;


        public function wire($area, $val, $pasta, $url){

            $diretorio = dir($pasta);
      
            while($arquivo = $diretorio -> read()){
              $dirNumer = $pasta.$arquivo.'/';
      
              $arquivos = glob("$dirNumer{*.jpg,*.png,*.gif}", GLOB_BRACE);
      
              foreach($arquivos as $img){
      
                $modelo_wiri = @end( @explode('/', $img) );
                $modelo_wiri = @current( @explode('.', $modelo_wiri) );
                $modelo_wiri = @end( @explode('-', $modelo_wiri) );
      
                if( $val == $modelo_wiri ) $checked = 'checked="checked"';
                
                $motar .= '<div class="col-lg-3 col-md-6 col-sm-6 text-sm-center p-3">';
                $motar .= '<div class="btn btn-secondary">';
                $motar .= '<label>';
                $motar .= '<input '.$checked.' type="radio" name="'.$area.'" value="'.$modelo_wiri.'">';
                $motar .= 'Modelo <span class="badge badge-warning">#'.$modelo_wiri.'</span>';
                $motar .= '<hr>';
                $motar .= '<img  class="img-fluid" data-toggle="tooltip" data-placement="bottom" title="MODELO '.$modelo_wiri.'" src="'.str_replace('../', '', $url.$img).'" >';
                $motar .= '</label>';
                $motar .= '</div>';
                $motar .= '</div>';
               
                $checked = '';
             }
           }
           $diretorio -> close();     
           
           echo $motar;

        }
        
    }
    

?>