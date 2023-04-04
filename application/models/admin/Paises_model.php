<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paises_model extends CI_Model{
    protected $table = array(
        'tabla'=>'geo_countries',
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function select_all(){
        $qry = $this->db->get( $this->table['tabla'] );
        $result = $qry->result_array();
        return $result;
    }
    
}
