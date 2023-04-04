<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vistas{
    /**
     * @desc $params argumentos para mostrar dinamicamente
     * @desc $body archivo de la vista
     * @desc $rol vista asociada
     * **/
    public function __render($params = NULL, $body = NULL, $rol = NULL){
        $CI =& get_instance();
        $CI->load->view($rol.'/header', $params);
        $CI->load->view($rol.'/'.$body, $params);
        $CI->load->view($rol.'/footer', $params);
    }
    /**
     * Solo para panel de administración
     * @desc $params argumentos para mostrar dinamicamente
     * @desc $body archivo de la vista
     * **/
    public function __render_admin($params = NULL, $body = NULL){
        $CI =& get_instance();
        $CI->load->view('admin/header', $params);
        $CI->load->view('admin/'.$body, $params);
        $CI->load->view('admin/footer', $params);
    }
    /**
     * Solo para login
     * @desc $params argumentos para mostrar dinamicamente
     * @desc $body archivo de la vista
     * **/
    public function __render_login($params = NULL, $body = NULL){
        $CI =& get_instance();
        $CI->load->view('login/header', $params);
        $CI->load->view('login/'.$body, $params);
        $CI->load->view('login/footer', $params);
    }
    /**
    * Buscador
    * @desc $params argumentos para mostrar dinamicamente
    * @desc $body archivo de la vista
    * **/
    public function __render_search($params = NULL, $body = NULL){
        $CI =& get_instance();
        $CI->load->view('search/header', $params);
        $CI->load->view('search/'.$body, $params);
        $CI->load->view('search/footer', $params);
    }
}
