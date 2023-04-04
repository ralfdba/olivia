<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Navegacion
 * Se utiliza para la navegación de lado front del sistema
 * @author ralf1
 */
class Navegacion {
    /**
     * @desc obtiene el menu de navegacion para mostrar en el front
     * @return array $response array asociativo con toda la info del usuario
     * **/    
    public function get_navegacion_front(){
        $CI =& get_instance();
        $CI->load->model(array(
            'menu_model'
        ));
        $grupo = array('id'=>3);
        $response['menu'] = $CI->menu_model->get_menu($grupo);
        return $response;       
    }
}
