<?php
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/CTApiClient.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Allacl extends REST_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/acl_model'
        ));        
        $this->load->library(
            array(
                'ion_auth'
            ));
    }

    public function index_get() {
        $responses = $this->acl_model->get_all();
        $msg = array(
            'err'=>0,
            'desc'=>'Listado OK.',
            'data'=>$responses
        );
        $this->response($msg);
    }

}

?>