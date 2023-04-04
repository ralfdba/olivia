<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regiones_model extends CI_Model{
    protected $table = array(
        'tb_region'=>'regiones',
        'tb_provincias'=>'provincias',
        'tb_comunas'=>'comunas'
    );
    
    public function __construct(){
        parent::__construct();
    }
    
    public function select_all_regiones(){
        $qry = $this->db->get($this->table['tb_region']);
        $result = $qry->result_array();
        return $result;
    }

    public function select_provincia_by_region_id($id){
        $opc = array(
            'region_id'=>$id
        );
        $qry = $this->db->get_where($this->table['tb_provincias'], $opc);
        $result = $qry->result_array();
        return $result;
    }

    public function select_comuna_by_provincia_id($id){
        $opc = array(
            'provincia_id'=>$id
        );
        $qry = $this->db->get_where($this->table['tb_comunas'], $opc);
        $result = $qry->result_array();
        return $result;
    }    

    
}
