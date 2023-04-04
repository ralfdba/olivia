<?php
class Precios_model extends CI_Model {
    protected $table = array(
        'tabla'=>'precios',
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
        $this->db->order_by('macategorias.nombre', 'desc');
        $this->db->select("precios.id as 'idprecio',precios.precio_compra,empresas.empresa,macategorias.nombre as 'examen',precios.precio,laboratorio.nombre as 'laboratorio'");
        $this->db->join('empresas', 'empresas.rut = precios.rut_empresa', 'left');
        $this->db->join('macategorias', 'macategorias.id = precios.examen_id', 'left');
        $this->db->join('laboratorio', 'laboratorio.rut = precios.rut_laboratorio', 'left');        
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
            'id'=>$params['id']
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }

    public function insert($params){

        $opc = array(
            'rut_empresa'=>$params['rut_empresa'],
            'rut_laboratorio'=>$params['rut_laboratorio'],
            'examen_id'=>$params['examen_id'],
            'precio'=>$params['precio'],
            'precio_compra'=>$params['precio_compra']
        );
        $this->db->insert($this->table['tabla'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function update($params){
        $opc = array(
            'rut_empresa'=>$params['rut_empresa'],
            'rut_laboratorio'=>$params['rut_laboratorio'],
            'examen_id'=>$params['examen_id'],
            'precio'=>$params['precio'],
            'precio_compra'=>$params['precio_compra']
        );
        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tabla'], $opc);
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

    public function select_excel(){
        $query = $this->db->query("select p.precio as 'precio_venta',p.precio_compra,e.rut,e.empresa,l.rut as 'rut_laboratorio',l.nombre as 'laboratorio',c.nombre as 'examen' from precios as p left join empresas as e on p.rut_empresa = e.rut left join macategorias as c on p.examen_id = c.id left join laboratorio as l on p.rut_laboratorio = l.rut");
        $fields = $query->field_data($this->table['tabla']);
        $result = $this->db->query("select p.precio as 'precio_venta',p.precio_compra,e.rut,e.empresa,l.rut as 'rut_laboratorio',l.nombre as 'laboratorio',c.nombre as 'examen' from precios as p left join empresas as e on p.rut_empresa = e.rut left join macategorias as c on p.examen_id = c.id left join laboratorio as l on p.rut_laboratorio = l.rut");
        return array("fields" => $fields, "query" => $result);
    }    
    
    
}
?>