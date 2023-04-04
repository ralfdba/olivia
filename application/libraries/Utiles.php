<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
Varios
*/
class Utiles {
    public function get_rol_by_usuario($objeto,$rol_id){
        /*
        $objeto -> $data['info_usuario']['group_info']
        $rol_id -> númerico
        return 0 = No existe el rol
        return 1 = Existe el rol
        */
        for($n = 0; $n < count($objeto); $n++){
            if($objeto[$n]->id == $rol_id){
                $response = 1;
                break;
            }else{
                $response = 0;
                break;
            }
        }
        return $response;
    }

    public function __custom_debug($objeto){
        echo "<pre>";
        print_r($objeto);
        echo "<pre>";
        die();
    }

    public function __elimina_espacios($cadena){
        $response = trim($cadena);
        return $response;
    }

    public function __genera_codigo_varchar120($prefijo,$largo){
        $estampa = time();
        $result = '';
        for($i = 0; $i < $largo; $i++) {
            $result .= mt_rand(0, 9);
        }
        return strtoupper($prefijo).$estampa.$result;
    }

    public function getLatitudLongitud($address) {
        $address = urlencode($address);
        $url = "https://nominatim.openstreetmap.org/search.php?q=".$address."&format=json&addressdetails=1";
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_USERAGENT, $userAgent );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        
        curl_close($ch);
        
        $ubicacion = json_decode($res, true);
        
        $resp = array(
            'latitud'=>$ubicacion[0]['boundingbox'][1],
            'longitud'=>$ubicacion[0]['boundingbox'][2],
        );
        
        return $resp;
    }

    public function clean_code_csv( $string ){
        return preg_replace( '/˛ˇ/i' , "", $string );
    }

}