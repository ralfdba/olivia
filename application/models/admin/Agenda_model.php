<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_Model{
    protected $table = array(
        'tabla'=>'agenda',
    );

    private function clean_code_csv( $string ){
        echo preg_replace( '/˛ˇ/i' , "", $string );
    }

    public function __construct(){
        parent::__construct();
    }

    public function get_total(){
        $qry = $this->db->count_all_results($this->table['tabla']);
        return $qry;
    }

    public function get_current_page_records($limit, $start){
        $this->db->order_by('fecha_agenda', 'DESC');
        $this->db->select("(case when agenda.asiste = 0 then 'asiste' when agenda.asiste = 1 then 'no asiste' end) as 'asistencia', agenda.id,agenda.lugar_examen,agenda.rut_solicita,agenda.nombre,agenda.apellidos,agenda.tipo,agenda.fecha_solicitud,agenda.fecha_agenda,agenda.resultado,laboratorio.nombre as 'laboratorio',empresas.empresa");
        $this->db->join('laboratorio', 'laboratorio.rut = agenda.rut_laboratorio', 'left');
        $this->db->join('empresas', 'empresas.rut = agenda.rut_empresa', 'left');
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
            'id'=>$params['id']
        );
        $qry = $this->db->get_where($this->table['tabla'], $conditions);
        $result = $qry->result_array();
        return $result;
    }

    public function insert($params){
        $fecha_upload_agenda = date_create( $params['fecha'] );
        $fecha_upload_format = date_format( $fecha_upload_agenda, "Y-m-d");
        $fecha = date_create( $params['fecha_nacimiento'] );
        $fecha_format = date_format( $fecha, "Y-m-d");
        
        if ( $params['estado'] == 0 ) { //Viene de carga masiva
            $opc = array(
                'rut_empresa'=>$params['empresa'],
                'rut_solicita'=>$params['rut'],
                'direccion'=>$params['direccion'],
                'nombre'=>$params['nombre'],
                'apellidos'=>$params['apellido'],
                'correo'=>$params['correo'],
                'fecha_agenda'=>$fecha_upload_format,
                'tipo'=>strtoupper ( $params['tipo'] ),
                'region'=>$params['region'],
                'provincia'=>$params['provincia'],
                'comuna'=>$params['comuna'],
                'tipo_documento' => strtoupper( $params['tipo_documento'] ),
                'sexo' => strtoupper( $params['sexo'] ),
                'rut_enfermera' => $params['rut_enfermera'],
                'motivo_examen' => strtoupper( $params['motivo_examen'] ),
                'seleccion_examenes_prioridad' => $params['seleccion_examenes_prioridad'],
                'observaciones' => $params['observaciones'],
                'pais' => strtoupper( $params['pais'] ),
                'fecha_nacimiento' => $fecha_format,
                'lugar_examen' => strtoupper( $params['lugar_examen'] ),
                'fono' => $params['fono'],
                'estado' => $params['estado'],
                'rut_laboratorio' => $params['rut_laboratorio'],
                'resultado' => $params['resultado'],
                'asiste'=>$params['asiste']
            );
        } else {
            $opc = array(
                'rut_empresa'=>$params['empresa'],
                'rut_solicita'=>$params['rut'],
                'direccion'=>$params['direccion'],
                'nombre'=>$params['nombre'],
                'apellidos'=>$params['apellido'],
                'correo'=>$params['correo'],
                'fecha_agenda'=>$params['fecha'],
                'tipo'=>strtoupper ( $params['tipo'] ),
                'region'=>$params['region'],
                'provincia'=>$params['provincia'],
                'comuna'=>$params['comuna'],
                'tipo_documento' => strtoupper( $params['tipo_documento'] ),
                'sexo' => strtoupper( $params['sexo'] ),
                'rut_enfermera' => $params['rut_enfermera'],
                'motivo_examen' => strtoupper( $params['motivo_examen'] ),
                'seleccion_examenes_prioridad' => $params['seleccion_examenes_prioridad'],
                'observaciones' => $params['observaciones'],
                'pais' => strtoupper( $params['pais'] ),
                'fecha_nacimiento' => $fecha_format,
                'lugar_examen' => strtoupper( $params['lugar_examen'] ),
                'fono' => $params['fono'],
                'estado' => $params['estado'],
                'rut_laboratorio' => $params['rut_laboratorio']
            );
        }
        $this->db->insert($this->table['tabla'],$opc);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    public function update($params){
        $fecha = date_create( $params['fecha_nacimiento'] );
        $fecha_format = date_format( $fecha, "Y-m-d");
        $today = date("Y-m-d");
        if ( isset( $params['fecha_agenda'] ) ) {
            $opc = array(
                'rut_empresa'=>$params['empresa'],
                'rut_solicita'=>$params['rut'],
                'direccion'=>$params['direccion'],
                'nombre'=>$params['nombre'],
                'apellidos'=>$params['apellido'],
                'correo'=>$params['correo'],
                'tipo'=>strtoupper ( $params['tipo'] ),
                'region'=>$params['region'],
                'provincia'=>$params['provincia'],
                'comuna'=>$params['comuna'],
                'tipo_documento' => strtoupper( $params['tipo_documento'] ),
                'sexo' => strtoupper( $params['sexo'] ),
                'rut_enfermera' => $params['rut_enfermera'],
                'motivo_examen' => strtoupper( $params['motivo_examen'] ),
                'seleccion_examenes_prioridad' => $params['seleccion_examenes_prioridad'],
                'observaciones' => $params['observaciones'],
                'pais' => strtoupper( $params['pais'] ),
                'fecha_nacimiento' => $fecha_format,
                'lugar_examen' => strtoupper( $params['lugar_examen'] ),
                'fono' => $params['fono'],
                'resultado' => strtoupper( $params['resultado'] ),
                'fecha_resultado' => $today,
                'rut_edita' => $params['rut_edita'],
                'rut_laboratorio' => $params['rut_laboratorio'],
                'asiste'=>$params['asiste'][0],
                'fecha_agenda'=>$params['fecha_agenda']
            );
        } else {
            $opc = array(
                'rut_empresa'=>$params['empresa'],
                'rut_solicita'=>$params['rut'],
                'direccion'=>$params['direccion'],
                'nombre'=>$params['nombre'],
                'apellidos'=>$params['apellido'],
                'correo'=>$params['correo'],
                'tipo'=>strtoupper ( $params['tipo'] ),
                'region'=>$params['region'],
                'provincia'=>$params['provincia'],
                'comuna'=>$params['comuna'],
                'tipo_documento' => strtoupper( $params['tipo_documento'] ),
                'sexo' => strtoupper( $params['sexo'] ),
                'rut_enfermera' => $params['rut_enfermera'],
                'motivo_examen' => strtoupper( $params['motivo_examen'] ),
                'seleccion_examenes_prioridad' => $params['seleccion_examenes_prioridad'],
                'observaciones' => $params['observaciones'],
                'pais' => strtoupper( $params['pais'] ),
                'fecha_nacimiento' => $fecha_format,
                'lugar_examen' => strtoupper( $params['lugar_examen'] ),
                'fono' => $params['fono'],
                'resultado' => strtoupper( $params['resultado'] ),
                'fecha_resultado' => $today,
                'rut_edita' => $params['rut_edita'],
                'rut_laboratorio' => $params['rut_laboratorio'],
                'asiste'=>$params['asiste'][0]
            );            
        }

        $this->db->where('id', $params['id']);
        $this->db->update($this->table['tabla'], $opc);
        $resp = $this->db->affected_rows();
        return $resp;
    }

    public function updateresultados( $params ){
        $fecha = date("Y-m-d");
        $opt = array(
            'fecha_resultado' => $fecha,
            'resultado' => $params['resultado']
        );
        $where_opt = array(
            'id' => (int)$params['id'],
            'rut_solicita' => $params['rut']
        );
        $this->db->where( $where_opt );
        $this->db->update($this->table['tabla'], $opt);
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
        $this->db->order_by('fecha_solicitud', 'DESC');
        $qry = $this->db->get($this->table['tabla']);
        $result = $qry->result_array();
        return $result;
    }
     public function select_excel(){
         $query = $this->db->query("select (case when a.asiste = 0 then 'asiste' when a.asiste = 1 then 'no asiste' end) as 'asistencia',l.nombre as 'laboratorio', a.id, g.name as 'pais_origen',a.fecha_nacimiento, a.sexo, a.tipo_documento, a.rut_solicita as 'rut_paciente', a.nombre, a.apellidos,a.correo,a.fono,a.rut_empresa, e.empresa,a.tipo,a.resultado,a.fecha_resultado,r.region_nombre, p.provincia_nombre, c.comuna_nombre, a.direccion, a.fecha_solicitud, a.fecha_agenda, a.rut_enfermera as 'enfermera', a.lugar_examen, a.motivo_examen, (case when a.seleccion_examenes_prioridad = 1 then 'pcr sars cov2' when a.seleccion_examenes_prioridad = 2 then 'pcr sars cov2influeza a y b' when a.seleccion_examenes_prioridad = 3 then 'pcr sars cov2 test rapido' end) as 'examenes_prioridad' from agenda as a 
left join empresas as e on a.rut_empresa = e.rut
left join regiones as r on a.region = r.region_id
left join provincias as p on a.provincia = p.provincia_id
left join comunas as c on a.comuna = c.comuna_id
left join laboratorio as l on a.rut_laboratorio = l.rut
left join geo_countries as g on a.pais = g.abv");
         $fields = $query->field_data($this->table['tabla']);
         $result = $this->db->query("select (case when a.asiste = 0 then 'asiste' when a.asiste = 1 then 'no asiste' end) as 'asistencia',l.nombre as 'laboratorio', a.id, g.name as 'pais_origen',a.fecha_nacimiento, a.sexo, a.tipo_documento, a.rut_solicita as 'rut_paciente', a.nombre, a.apellidos,a.correo,a.fono,a.rut_empresa, e.empresa,a.tipo,a.resultado,a.fecha_resultado,r.region_nombre, p.provincia_nombre, c.comuna_nombre, a.direccion, a.fecha_solicitud, a.fecha_agenda, a.rut_enfermera as 'enfermera', a.lugar_examen, a.motivo_examen, (case when a.seleccion_examenes_prioridad = 1 then 'pcr sars cov2' when a.seleccion_examenes_prioridad = 2 then 'pcr sars cov2influeza a y b' when a.seleccion_examenes_prioridad = 3 then 'pcr sars cov2 test rapido' end) as 'examenes_prioridad' from agenda as a 
left join empresas as e on a.rut_empresa = e.rut
left join regiones as r on a.region = r.region_id
left join provincias as p on a.provincia = p.provincia_id
left join comunas as c on a.comuna = c.comuna_id
left join laboratorio as l on a.rut_laboratorio = l.rut
left join geo_countries as g on a.pais = g.abv");
         return array("fields" => $fields, "query" => $result);
     }

     public function select_excel_filter( $search ){
        $fecha1 = date( "Y-m-d", strtotime( $search['fecha_uno'] ) );
        $fecha2 = date( "Y-m-d", strtotime( $search['fecha_dos']) );        
         $query = $this->db->query("select (case when a.asiste = 0 then 'asiste' when a.asiste = 1 then 'no asiste' end) as 'asistencia',l.nombre as 'laboratorio', a.id, g.name as 'pais_origen',a.fecha_nacimiento, a.sexo, a.tipo_documento, a.rut_solicita as 'rut_paciente', a.nombre, a.apellidos,a.correo,a.fono,a.rut_empresa, e.empresa,a.tipo,a.resultado,a.fecha_resultado,r.region_nombre, p.provincia_nombre, c.comuna_nombre, a.direccion, a.fecha_solicitud, a.fecha_agenda, a.rut_enfermera as 'enfermera', a.lugar_examen, a.motivo_examen, (case when a.seleccion_examenes_prioridad = 1 then 'pcr sars cov2' when a.seleccion_examenes_prioridad = 2 then 'pcr sars cov2influeza a y b' when a.seleccion_examenes_prioridad = 3 then 'pcr sars cov2 test rapido' end) as 'examenes_prioridad' from agenda as a 
left join empresas as e on a.rut_empresa = e.rut
left join regiones as r on a.region = r.region_id
left join provincias as p on a.provincia = p.provincia_id
left join comunas as c on a.comuna = c.comuna_id
left join laboratorio as l on a.rut_laboratorio = l.rut
left join geo_countries as g on a.pais = g.abv where fecha_agenda BETWEEN '". $fecha1." 00:00:00" ."' AND '". $fecha2." 23:59:59'");
        $fields = $query->field_data($this->table['tabla']);
         $result = $this->db->query("select (case when a.asiste = 0 then 'asiste' when a.asiste = 1 then 'no asiste' end) as 'asistencia',l.nombre as 'laboratorio', a.id, g.name as 'pais_origen',a.fecha_nacimiento, a.sexo, a.tipo_documento, a.rut_solicita as 'rut_paciente', a.nombre, a.apellidos,a.correo,a.fono,a.rut_empresa, e.empresa,a.tipo,a.resultado,a.fecha_resultado,r.region_nombre, p.provincia_nombre, c.comuna_nombre, a.direccion, a.fecha_solicitud, a.fecha_agenda, a.rut_enfermera as 'enfermera', a.lugar_examen, a.motivo_examen, (case when a.seleccion_examenes_prioridad = 1 then 'pcr sars cov2' when a.seleccion_examenes_prioridad = 2 then 'pcr sars cov2influeza a y b' when a.seleccion_examenes_prioridad = 3 then 'pcr sars cov2 test rapido' end) as 'examenes_prioridad' from agenda as a 
left join empresas as e on a.rut_empresa = e.rut
left join regiones as r on a.region = r.region_id
left join provincias as p on a.provincia = p.provincia_id
left join comunas as c on a.comuna = c.comuna_id
left join laboratorio as l on a.rut_laboratorio = l.rut
left join geo_countries as g on a.pais = g.abv where fecha_agenda BETWEEN '". $fecha1." 00:00:00" ."' AND '". $fecha2." 23:59:59'");
        return array("fields" => $fields, "query" => $result);
    }     

     public function get_all_agenda_today(){
        $query = "select distinct count(DATE(fecha_agenda)) as hoy from agenda where DATE(fecha_agenda) = DATE(NOW())";
        $result = $this->db->query($query);
        return $result->result_array();
         }
     public function get_all_agenda(){
        $query = "select distinct count(*) as hoy from agenda";
        $result = $this->db->query($query);
        return $result->result_array();
         }

    public function search($params){
        $fecha1 = date( "Y-m-d", strtotime( $params['fecha_uno'] ) );
        $fecha2 = date( "Y-m-d", strtotime( $params['fecha_dos']) );
        $this->db->where("fecha_agenda BETWEEN '". $fecha1." 00:00:00" ."' AND '". $fecha2." 23:59:59'");
        $this->db->or_where('rut_solicita', $params['rut_paciente']);
        $consulta = $this->db->get($this->table['tabla']);
        return $consulta->num_rows();

    }

    public function search_match($buscador, $limit, $start, $rut_paciente){
        $this->db->order_by('fecha_agenda', 'asc');
        $this->db->limit($limit, $start);
        $fecha1 = date( "Y-m-d", strtotime( $buscador['fecha_uno'] ) );
        $fecha2 = date( "Y-m-d", strtotime( $buscador['fecha_dos'] ) );
        $this->db->where("fecha_agenda BETWEEN '". $fecha1." 00:00:00" ."' AND '". $fecha2." 23:59:59'");
        $this->db->or_where('rut_solicita', $rut_paciente);
        $consulta = $this->db->get($this->table['tabla']);
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {
                $data[] = $fila;
            }
            return $data;
        }
    }  
         

}
