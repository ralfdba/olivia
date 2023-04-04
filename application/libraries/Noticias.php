<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Noticias{
    public function show_noticias(){
        $CI =& get_instance();
        $CI->load->model(array(
            'noticias_model'
        ));        
    }
}