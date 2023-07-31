<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Acl_model
 * tabla acl (id(int),roles(json),controllers(json),actions(json))
 * roles {'roles':['admin','user',etc...]}
 * controllers {'controllers':['admin/users','admin/blog',etc...]}
 * actions {'actions':['view','update','delete','create']}
 *
 * @author ralf
 */
class Acl_model extends CI_Model{
    protected $table = array(
        'tabla'=>'acl',
    );

    public function __construct(){
        parent::__construct();
    }

    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tabla']);
        return $qry;
    }

    public function get_all(){
        $qry = $this->db->get( $this->table['tabla'] );
        $result = $qry->result_array();
        return $result;
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

    public function get_all_controllers_by_role( $params ){
        $this->db->select("id,roles,controllers,actions");
        $this->db->where("json_extract(roles,'$.roles') like '%".trim( $params )."%'");
        $query = $this->db->get($this->table['tabla']);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_by_id( $params ){
        $conditions = array(
            'id'=>$params
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }

    public function insert( $params ){
        $opc = array(
            'roles'=> json_encode( array("roles" => $params['roles'] ) ),
            'controllers'=> json_encode( array("controllers" => $params['controllers'] ) ),
            'actions'=> json_encode( array("actions" => $params['actions'] ) )
        );
        $this->db->insert($this->table['tabla'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function update( $params ){
        $opc = array(
            'roles'=> json_encode( array("roles" => $params['roles'] ) ),
            'controllers'=> json_encode( array("controllers" => $params['controllers'] ) ),
            'actions'=> json_encode( array("actions" => $params['actions'] ) )
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tabla'], $data);
        $resp = $this->db->affected_rows();
        return $resp;
    }

    public function delete( $id ){
        $opc = array(
            'id'=>$id
        );
        $this->db->delete($this->table['tabla'],$opc);
        $resp = $this->db->affected_rows();
        return $resp;
    }

}
