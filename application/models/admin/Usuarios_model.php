<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Usuarios_model
 *
 * @author ralf
 */
class Usuarios_model extends CI_Model{
    protected $table = array(
        'tabla'=>'users',
    );

    public function __construct(){
        parent::__construct();
    }

    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tabla']);
        return $qry;
    }

    public function get_current_page_records($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table['tabla']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function selectbyid($params){
        $conditions = array(
            'id'=>$params['usuarios_id']
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }

    public function select_all() {
        $qry = $this->db->get( $this->table['tabla'] );
        $result = $qry->result_array();
        return $result;
    }

}
