<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * Consume servicios rest en PHP
 * @author: ralf
 * 
*/
class ConsumeRest {
    /**
     * $method = GET, POST, PUT, DELETE
     * $url = ENDPOINT SERVICIO
     * $data = parametros a enviar
     * $apik = llave api key si es necesario
    */
    function llamaAPI($method, $url, $data, $apik = NULL){
        $curl = curl_init();     
        switch ($method){
           case "POST":
              curl_setopt($curl, CURLOPT_POST, 1);
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              break;
           case "PUT":
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
              if ($data)
                 curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
              break;
           default:
              if ($data)
                 $url = sprintf("%s?%s", $url, http_build_query($data));
        }     
        // Opcional apikey
        if($apik != NULL){
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
               'APIKEY: '.$apik,
               'Content-Type: application/json',
            ));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // Ejecutar
        $result = curl_exec($curl);
        if(!$result){die("Error en la matrix");}
        curl_close($curl);
        return $result;
     }   
}
