<?php
/**
*@author ralf
*@desc Noticias es el controlador para servicios Rest de las noticias del sistema por categoria.
**/
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Noticias extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'noticias_model'
        ));
        $this->load->library(
            array(
                'ion_auth'
            ));
    }
    public function index_get(){
        if($this->get('categoria')){
            $response = $this->noticias_model->get($this->get('categoria'));
            $msg = array(
                'err'=>0,
                'desc'=>'Listado OK.',
                'news'=>$response
            );
        }else{
            $msg = array(
                'err'=>1,
                'desc'=>'No existen noticias para la categoria.'
            );
        }
        $this->response($msg);
    }    
}

?>