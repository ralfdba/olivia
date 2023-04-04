<?php
class Laboratorios_model extends CI_Model {
    protected $table = array(
        'tabla'=>'laboratorio',
    );
    public function select_all(){
        $qry = $this->db->get($this->table['tabla']);
        $result = $qry->result_array();
        return $result;
    }       
}
?>