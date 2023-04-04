<?php

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
defined('BASEPATH') OR exit('No direct script access allowed');
class Regiones extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/regiones_model'
        ));
        $this->load->library(
            array(
                'ion_auth'
            ));
    }
    public function index_get(){
        $response = $this->regiones_model->select_all_regiones();
        $msg = array(
            'err'=>0,
            'desc'=>'Listado OK.',
            'data'=>$response
        );
        $this->response($msg);
    }
}

?>