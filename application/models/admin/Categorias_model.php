<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Categorias_model
 *
 * @author ralf
 */
class Categorias_model extends CI_Model{
    protected $table = array(
        'tabla'=>'macategorias',
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
            'id'=>$params['categoria_id']
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }

    public function insert($params){
        $opc = array(
            'nombre'=>$params['nombre'],
            'tipo_muestra'=>$params['tipo']
        );
        $this->db->insert($this->table['tabla'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function update($params){
        $data = array(
            'nombre'=>$params['nombre'],
            'tipo_muestra'=>$params['tipo']
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tabla'], $data);
        $resp = $this->db->affected_rows();
        return $resp;
    }

    public function delete($id){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tabla'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;
    }

    public function select_all(){
        $qry = $this->db->get($this->table['tabla']);
        $result = $qry->result_array();
        return $result;
    }

    public function get_all_categories_api(){
        $this->db->select("macategorias.id,macategorias.nombre as 'categoria',maestros.nombre");
        $this->db->join('maestros', 'maestros.id = macategorias.tipo_muestra', 'left');
        $opt = array("estado" => 0);
        $query = $this->db->get_where($this->table['tabla'], $opt);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;        
    }    

}
