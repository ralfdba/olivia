<?php
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Allusers extends REST_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/usuarios_model'
        ));        
        $this->load->library(
            array(
                'ion_auth'
            ));
    }

    public function index_get() {
        $responses = $this->usuarios_model->get_all_users_for_api();
        $msg = array(
            'err'=>0,
            'desc'=>'Listado OK.',
            'data'=>$responses
        );
        $this->response($msg);
    }

}

?>