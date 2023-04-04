<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author ralf
 * @desc Clase Permisos, obtiene el perfilamiento del usuario y escribe en variable de sesión
 *
 */
class Permisos{
    /**
     * 
     * @return array $response['login'] Si esta logueado en el sistema
     * @return array $response['user_info'] Datos de usuario logueado
     * @return array $response['group_info'] Grupos a los que pertenece
     * @return array $response['menu'] Items de menú que el usuario tiene asignado
     */
    public function check_login(){
        $CI =& get_instance();
        $CI->load->model(array(
            'menu_model'
        ));
        $CI->load->library(
            array(
                'ion_auth',
                'session'
            ));
        /**
         * @desc chequeamos si usuario esta logueado en sistema
         * **/
        if (!$CI->ion_auth->logged_in()){
            redirect('login/index');
        }else{
            /**
             * @desc Verifica si es admin o no
             * **/
            if (!$CI->ion_auth->is_admin()){
                redirect($CI->config->item('template_custom').'/dashboard', 'refresh');
            }else{
                redirect('admin/dashboard', 'refresh');
            }
        }
    }
    /**
     * @return string controlador al cerrar sesión
     * 
     */
    public function logout(){
        $CI =& get_instance();
        $CI->load->library(
            array(
                'ion_auth'
            ));
        $CI->ion_auth->logout();
        redirect('login/index', 'refresh');
    }
    
    /**
     * @desc obtiene los datos del usuario y sus grupos
     * @return array $response array asociativo con toda la info del usuario
     * **/    
    public function get_user_data(){
        $CI =& get_instance();
        $CI->load->model(array(
            'menu_model'
        ));
        $CI->load->library(
            array(
                'ion_auth'
            ));        
        $response['login'] = "OK";
        $response['user_info'] = $CI->ion_auth->user()->row();
        $response['group_info'] = $CI->ion_auth->get_users_groups($response['user_info']->id)->result();
        $response['menu'] = $CI->menu_model->get_menu($response['group_info'],0);
        return $response;       
    }
    
}

