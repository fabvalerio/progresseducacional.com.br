<?php

//class de conexão ao CURL

class onepay {

    //RETORNO
    public function api($url, $token, $method){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_SSL_VERIFYPEER => 2,
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_HTTPHEADER => array(
            'header: ContentType application/json',
            'Authorization: Bearer ' . $token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;       
    }

    //ENVIAR
    public function send($url, $token, $data){

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
      'Authorization: Bearer ' . $token));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $response  = curl_exec($ch);

      curl_close($ch);
        return $response;  
        
    }




}


?>