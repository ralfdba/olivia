<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Blog_model
 *
 * @author ralf
 */
class Blog_model extends CI_Model{
    protected $table = array(
        'tabla'=>'copublicacion',
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
            'id'=>$params['blog_id']
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }

    public function insert($params){

        if(isset($params['imagen_url'])){
            $imagen = $params['imagen_url'];
        }else{
            $imagen = "";
        }

        $opc = array(
            'titulo'=>$params['titulo'],
            'categoria_id'=>$params['categoria'],
            'extracto'=>$params['extracto'],
            'cuerpo'=>$params['cuerpo'],
            'imagen_url'=>$imagen
        );
        $this->db->insert($this->table['tabla'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function update($params){
        if(isset($params['imagen_url'])){
            $data = array(
                'titulo'=>$params['titulo'],
                'categoria_id'=>$params['categoria'],
                'extracto'=>$params['extracto'],
                'cuerpo'=>$params['cuerpo'],
                'imagen_url'=>$params['imagen_url'],
                'estado'=>$params['estado']
            );
        }else{
            $data = array(
                'titulo'=>$params['titulo'],
                'categoria_id'=>$params['categoria'],
                'extracto'=>$params['extracto'],
                'cuerpo'=>$params['cuerpo'],
                'estado'=>$params['estado']
            );
        }
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

}
