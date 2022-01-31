<?php
/** 
 * Get hearder Authorization
 * */


function getAuthorizationHeader($val = null){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        
        $headers = trim(str_replace('Bearer', '', $headers));
        
        // echo "\n";
        // echo $val;
        // echo "\n";


         if( $headers == $val ){
            $res = 1;
         }else{
            $res = 0;
         }

         return $res;
    
    }

/*
** resultado
** echo getAuthorizationHeader($token);
*/