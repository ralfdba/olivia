<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Empresas_model
 *
 * @author ralf
 */
class Empresas_model extends CI_Model{
    protected $table = array(
        'tabla'=>'empresas',
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
            'id'=>$params['empresa_id']
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }

    public function insert($params){
        $opc = array(
            'empresa'=>strtoupper($params['nombre']),
            'rut'=>$params['rut'],
            'direccion'=>$params['direccion'],
            'email_notificacion'=>$params['correo'],
            'is_lab'=>$params['islab']
        );
        $this->db->insert($this->table['tabla'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function update($params){
        $data = array(
            'empresa'=>strtoupper($params['nombre']),
            'rut'=>$params['rut'],
            'direccion'=>$params['direccion'],
            'email_notificacion'=>$params['correo'],
            'is_lab'=>$params['islab']
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

    public function download_excel_empresas() {
        $query = $this->db->query("select rut,empresa as 'nombre_empresa', if(is_lab = 0,'empresa','laboratorio') as tipo from empresas");
        $fields = $query->field_data($this->table['tabla']);
        $result = $this->db->query("select rut,empresa as 'nombre_empresa', if(is_lab = 0,'empresa','laboratorio') as tipo from empresas");
        return array("fields" => $fields, "query" => $result);

    }
    public function download_excel_regiones() {
        $query = $this->db->query("select r.region_id as 'codigo_region', r.region_nombre, p.provincia_id as 'codigo_provincia', p.provincia_nombre, c.comuna_id as 'codigo_comuna' , c.comuna_nombre from regiones as r left join provincias as p on r.region_id = p.region_id left join comunas as c on p.provincia_id = c.provincia_id");
        $fields = $query->field_data($this->table['tabla']);
        $result = $this->db->query("select r.region_id as 'codigo_region', r.region_nombre, p.provincia_id as 'codigo_provincia', p.provincia_nombre, c.comuna_id as 'codigo_comuna' , c.comuna_nombre from regiones as r left join provincias as p on r.region_id = p.region_id left join comunas as c on p.provincia_id = c.provincia_id");
        return array("fields" => $fields, "query" => $result);

    }

}
