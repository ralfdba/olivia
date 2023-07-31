<?php
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Allempresas extends REST_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/empresas_model'
        ));        
        $this->load->library(
            array(
                'ion_auth'
            ));
    }

    public function index_get() {
        $responses = $this->empresas_model->get_all_empresas_api();
        $msg = array(
            'err'=>0,
            'desc'=>'Listado OK.',
            'data'=>$responses
        );
        $this->response($msg);
    }

}

?>