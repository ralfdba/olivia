<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author ralf
 */
class Agenda extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model',
            'admin/agenda_model',
            'admin/empresas_model',
            'admin/categorias_model',
            'admin/regiones_model',
            'admin/usuarios_model',
            'admin/paises_model'
        ));
        $this->load->library(
            array(
                'ion_auth',
                'rut',
                'upload',
                'utiles'
            ));
        $this->load->helper(array('url','language','mysql_to_excel_helper'));
    }

    protected function set_upload_option(){
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['upload_path'] = './uploads/masivo/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = 5000;
        return $config;
    }  

    private function __clean_string( $str ) {
        $clean = str_replace('<U+FEFF>', '', $str);
        return $clean;
    }
    private function __dict_examenes_prioridad( $opt ) {
        switch ( $opt ) {
            case 1:
                return 1;  
            break;
            case 2:
                return 2;
            break;
            case 3:
                return 3;
            break;
        }
    }

    private function __dict_resultados( $opt ) {
        switch( $opt ){
            case 1:
                return "POSITIVO";
            break;
            case 2:
                return "NEGATIVO";
            break;
            case 3:
                return "INDEFINIDO";
            break;
        }
    }

    private function _date_format_upload( $fecha ) {
        $time_input = strtotime( $fecha ); 
        $date_return = date("Y-m-d", $time_input);
        return $date_return;
    }



    public function index(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){                
                $data['total_hoy'] = $this->agenda_model->get_all_agenda_today();
                $data['total_general'] = $this->agenda_model->get_all_agenda();
                $data['endpoint_form'] = site_url('admin/agenda');
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->agenda_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->agenda_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url('admin/agenda/index');
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('f1', 'B&uacute;squeda', 'trim|min_length[1]|max_length[150]');
                $this->form_validation->set_rules('f2', 'B&uacute;squeda', 'trim|min_length[1]|max_length[150]');
                
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data,'agenda_lista');
                }else{
                  $fecha1 = $this->input->post('f1');
                  $fecha2 = $this->input->post('f2');
                  $rut = $this->input->post('rut');
                  $this->session->set_userdata('fechauno', $fecha1);
                  $this->session->set_userdata('fechados', $fecha2);
                  $this->session->set_userdata('rutpaciente', $rut);
                  redirect('/admin/agenda/resultados', 'refresh');
                  
                }                  
                
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }


    public function create(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){
                $data['empresas'] = $this->empresas_model->select_all();
                $data['paises'] = $this->paises_model->select_all();
                $data['usuarios'] = $this->usuarios_model->select_all();
                $data['categorias'] = $this->categorias_model->select_all();
                $data['regiones'] = $this->regiones_model->select_all_regiones();
                $data['endpoint_form'] = site_url('admin/agenda');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('apellido', 'Apellido', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('rut', 'RUN', 'required|trim|max_length[12]');
                $this->form_validation->set_rules('empresa', 'Empresa', 'trim');
                $this->form_validation->set_rules('tipo', 'tipo', 'trim');
                $this->form_validation->set_rules('fecha', 'fecha', 'trim');
                $this->form_validation->set_rules('region', 'region', 'trim');
                $this->form_validation->set_rules('provincia', 'provincia', 'trim');
                $this->form_validation->set_rules('ciudad', 'ciudad', 'trim');
                $this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('observaciones', 'observaciones', 'trim');
                $this->form_validation->set_rules('seleccion_examenes_prioridad', 'seleccion_examenes_prioridad', 'trim');
                $this->form_validation->set_rules('correo', 'E-Mail', 'required|trim|valid_email');
                $this->form_validation->set_rules('tipo_documento','tipo_documento','trim');
                $this->form_validation->set_rules('sexo','sexo','trim');
                $this->form_validation->set_rules('fec_nacimiento','fec_nacimiento','trim');
                $this->form_validation->set_rules('pais','pais','trim');
                $this->form_validation->set_rules('enfermera','enfermera','trim');
                $this->form_validation->set_rules('motivo_examen','motivo_examen','trim');
                $this->form_validation->set_rules('lugar_examen','lugar_examen','trim');
                $this->form_validation->set_rules('fono','fono','trim|min_length[1]|max_length[12]');
                $this->form_validation->set_rules('laboratorio','laboratorio','trim');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'agenda_create');
                }else{
                    $params['nombre'] = $this->input->post('nombre');
                    $params['apellido'] = $this->input->post('apellido');
                    $params['rut'] = $this->input->post('rut');
                    $params['empresa'] = $this->input->post('empresa');
                    $params['direccion'] = $this->input->post('direccion');
                    $params['region'] = $this->input->post('region');
                    $params['provincia'] = $this->input->post('provincias');
                    $params['comuna'] = $this->input->post('comunas');
                    $params['fecha'] = $this->input->post('fecha');
                    $params['correo'] = $this->input->post('correo');
                    $params['tipo'] = $this->input->post('tipo');
                    $params['tipo_documento'] = $this->input->post('tipo_documento');
                    $params['sexo'] = $this->input->post('sexo');
                    $params['pais'] = $this->input->post('pais');
                    $params['motivo_examen'] = $this->input->post('motivo_examen');
                    $params['lugar_examen'] = $this->input->post('lugar_examen');
                    $params['fecha_nacimiento'] = $this->input->post('fec_nacimiento');
                    $params['rut_enfermera'] = $this->input->post('enfermera');
                    $params['seleccion_examenes_prioridad'] = $this->__dict_examenes_prioridad( $this->input->post('seleccion_examenes_prioridad'));
                    $params['observaciones'] = $this->input->post('observaciones');
                    $params['fono'] = $this->input->post('fono');
                    $params['estado'] = 1;
                    $params['rut_laboratorio'] = $this->input->post('laboratorio');                    

                    if($this->rut->valida_rut($params['rut']) == true){
                        $resp = $this->agenda_model->insert($params);
                    }else{
                        $data['message'] = "RUN No va&aacute;lido.";
                    }


                    if(is_null($resp)){
                        $data['message'] = "Error al crear nueva solicitud";
                    }else{
                        $data['message'] = "Exito al crear nueva solicitud";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/agenda')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');

                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
    public function edit($id = NULL){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){
                if($id){
                    $params['id'] = $id;
                    $data['agenda_select'] = $this->agenda_model->selectbyid($params);
                }
                $data['empresas'] = $this->empresas_model->select_all();
                $data['paises'] = $this->paises_model->select_all();
                $data['usuarios'] = $this->usuarios_model->select_all();
                $data['categorias'] = $this->categorias_model->select_all();
                $data['regiones'] = $this->regiones_model->select_all_regiones();
                $data['endpoint_form'] = site_url('admin/agenda');
                $data['provincias'] = $this->regiones_model->select_provincia_by_region_id($data['agenda_select'][0]['region']);                
                $data['comunas'] = $this->regiones_model->select_comuna_by_provincia_id($data['agenda_select'][0]['provincia']);
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('apellido', 'Apellido', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('rut', 'RUN', 'required|trim|max_length[12]');
                $this->form_validation->set_rules('empresa', 'Empresa', 'trim');
                $this->form_validation->set_rules('tipo', 'tipo', 'trim');
                $this->form_validation->set_rules('region', 'region', 'trim');
                $this->form_validation->set_rules('provincia', 'provincia', 'trim');
                $this->form_validation->set_rules('ciudad', 'ciudad', 'trim');
                $this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'required|trim|min_length[3]|max_length[120]');
                $this->form_validation->set_rules('observaciones', 'observaciones', 'trim');
                $this->form_validation->set_rules('seleccion_examenes_prioridad', 'seleccion_examenes_prioridad', 'trim');
                $this->form_validation->set_rules('correo', 'E-Mail', 'required|trim|valid_email');
                $this->form_validation->set_rules('tipo_documento','tipo_documento','trim');
                $this->form_validation->set_rules('sexo','sexo','trim');
                $this->form_validation->set_rules('fec_nacimiento','fec_nacimiento','trim');
                $this->form_validation->set_rules('pais','pais','trim');
                $this->form_validation->set_rules('enfermera','enfermera','trim');
                $this->form_validation->set_rules('motivo_examen','motivo_examen','trim');
                $this->form_validation->set_rules('lugar_examen','lugar_examen','trim');
                $this->form_validation->set_rules('fono','fono','trim|min_length[1]|max_length[12]');
                $this->form_validation->set_rules('laboratorio','laboratorio','trim');
                $this->form_validation->set_rules('asiste[]','asiste','trim');
                $this->form_validation->set_rules('fecha','fecha muestra','min_length[1]');

                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'agenda_edit');
                }else{
                    $params['id'] = $this->input->post('id');
                    $params['nombre'] = $this->input->post('nombre');
                    $params['apellido'] = $this->input->post('apellido');
                    $params['rut'] = $this->input->post('rut');
                    $params['empresa'] = $this->input->post('empresa');
                    $params['direccion'] = $this->input->post('direccion');
                    $params['region'] = $this->input->post('region');
                    $params['provincia'] = $this->input->post('provincias');
                    $params['comuna'] = $this->input->post('comunas');
                    $params['correo'] = $this->input->post('correo');
                    $params['tipo'] = $this->input->post('tipo');
                    $params['tipo_documento'] = $this->input->post('tipo_documento');
                    $params['sexo'] = $this->input->post('sexo');
                    $params['pais'] = $this->input->post('pais');
                    $params['motivo_examen'] = $this->input->post('motivo_examen');
                    $params['lugar_examen'] = $this->input->post('lugar_examen');
                    $params['fecha_nacimiento'] = $this->input->post('fec_nacimiento');
                    $params['rut_enfermera'] = $this->input->post('enfermera');
                    $params['seleccion_examenes_prioridad'] = $this->__dict_examenes_prioridad( $this->input->post('seleccion_examenes_prioridad'));
                    $params['observaciones'] = $this->input->post('observaciones');
                    $params['fono'] = $this->input->post('fono');
                    $params['resultado'] = $this->input->post('resultado');
                    $params['rut_edita'] = $data['info_usuario']['user_info']->rut;
                    $params['rut_laboratorio'] = $this->input->post('laboratorio');
                    $params['asiste'] = $this->input->post('asiste[]');

                    if ( !empty( $this->input->post('fecha') ) ) {
                        $params['fecha_agenda'] = $this->input->post('fecha');
                    }
                    
                    if($this->rut->valida_rut($params['rut']) == true){
                        $resp = $this->agenda_model->update($params);
                    }else{
                        $data['message'] = "RUN No va&aacute;lido.";
                    }

                    if(is_null($resp)){
                        $data['message'] = "Error al editar solicitud";
                    }else{
                        $data['message'] = "Exito al editar solicitud";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/agenda')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');

                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
    public function delete($id = NULL){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){
                if($id){
                    $resp = $this->agenda_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar solicitud";
                    }else{
                        $data['message'] = "Error al eliminar solicitud";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/agenda')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data,'error');
                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
      public function download(){
          if($this->ion_auth->logged_in()){
              if($this->ion_auth->is_admin()){
                  $fecha = date("Y-m-d");
                  to_excel($this->agenda_model->select_excel(), $fecha."_gomed_agenda_lista");
              }else{
                  redirect("login/index", 'refresh');
              }
          }else{
              redirect("login/index", 'refresh');
          }
      }

      public function downloadfilter(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $fecha = date("Y-m-d");
                $search = array( 
                    'fecha_uno' => $this->session->userdata('fechauno'),
                    'fecha_dos' => $this->session->userdata('fechados')
                );                
                to_excel($this->agenda_model->select_excel_filter( $search ), $fecha."_gomed_agenda_lista");
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }      

    public function upload(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){
                $data['endpoint_form'] = site_url('admin/agenda');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('userfile', 'Archivo', 'trim');

                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data,'agenda_upload');
                }else{
                    $this->upload->initialize($this->set_upload_option());
                    if($this->upload->do_upload('userfile')){
                        $csv_upload = $this->upload->data();
                        $handle = fopen($csv_upload["full_path"],"r");
                        while (($row = fgetcsv($handle, 10000, ";")) != FALSE) //get row vales
                        {   
                            $params['empresa'] = trim( $this->__clean_string( $row[0]) ) ;
                            $params['rut'] = trim( $this->__clean_string( $row[1] ));
                            $params['nombre'] = trim( $this->__clean_string( $row[2] ));
                            $params['apellido'] = trim( $this->__clean_string( $row[3] ));                                                        
                            $params['region'] = trim( $this->__clean_string( $row[4] ));
                            $params['provincia'] = trim( $this->__clean_string( $row[5] ));
                            $params['comuna'] = trim( $this->__clean_string( $row[6] ));
                            $params['direccion'] = trim( $this->__clean_string( $row[7] ));
                            $params['fecha'] = trim( $this->_date_format_upload( $this->__clean_string( $row[8] ) ) );
                            $params['correo'] = trim( $this->__clean_string( $row[9] ));
                            $params['tipo'] = trim( $this->__clean_string( $row[10] ));
                            $params['tipo_documento'] = trim( $this->__clean_string( $row[11] ));
                            $params['sexo'] = trim( $this->__clean_string( $row[12] ));
                            $params['pais'] = trim( $this->__clean_string( $row[13] ));
                            $params['motivo_examen'] = trim( $this->__clean_string( $row[14] ));
                            $params['lugar_examen'] = trim( $this->__clean_string( $row[15] ));
                            $params['fecha_nacimiento'] = trim( $this->_date_format_upload( $this->__clean_string( $row[16] ) ) );
                            $params['rut_enfermera'] = trim(  $this->__clean_string( $row[17] ));
                            $params['seleccion_examenes_prioridad'] = $this->__clean_string( trim( $row[18] ) );
                            $params['observaciones'] = trim( $this->__clean_string( $row[19] ));
                            $params['fono'] = trim( $this->__clean_string( $row[20] ));
                            $params['rut_laboratorio'] = trim( $this->__clean_string( $row[21] ));
                            $params['resultado'] = trim( $this->__clean_string( $row[22] ) );
                            $params['asiste'] = trim( $this->__clean_string( $row[23] ));
                            $params['estado'] = 0;
                            $resp = $this->agenda_model->insert($params);
                        }
                    }

                    if(is_null($resp)){
                        $data['message'] .=  "Error al subir masivamente.&nbsp; <a href=\"".site_url('admin/agenda')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    }else{
                        $data['message'] .=  "Exito al subir masivamente.&nbsp; <a href=\"".site_url('admin/agenda')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    }           
                    $this->vistas->__render_admin($data, 'error');
                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }
    public function uploadresultados(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                $data['endpoint_form'] = site_url('admin/agenda');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('userfile', 'Archivo', 'trim');

                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data,'agenda_uploadresultados');
                }else{

                    $this->upload->initialize($this->set_upload_option());
                    if($this->upload->do_upload('userfile')){
                        $csv_upload = $this->upload->data();
                        $handle = fopen($csv_upload["full_path"],"r");
                        while (($row = fgetcsv($handle, 10000, ";")) != FALSE) //get row vales
                        {   
                            $params['id'] = trim( $this->__clean_string($row[0] ) );
                            $params['rut'] = trim( $this->__clean_string( $row[1] ) );
                            $params['resultado'] = $this->__dict_resultados( trim( $this->__clean_string( $row[2] ) ) );
                            //$resp = $this->agenda_model->updateresultados($params);
                            $this->agenda_model->updateresultados($params);
                        }
                    }
                    $data['message'] .=  "Exito al subir masivamente.&nbsp; <a href=\"".$this->config->item('url_sistema').$this->__endpoint()["path"]."/".$this->__endpoint()["controller"]."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');
                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }

    public function resultados(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()) {
                $data['endpoint_form'] = site_url('admin/agenda');
                $search = array( 
                    'fecha_uno' => $this->session->userdata('fechauno'),
                    'fecha_dos' => $this->session->userdata('fechados'),
                    'rut_paciente' => $this->session->userdata('rutpaciente')
                );            
                $total = $this->agenda_model->search( $search );
                $limit_per_page = 10;
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $config['base_url'] = site_url('admin/agenda/resultados');
                $config['total_rows'] = $total;
                $config['per_page'] = $limit_per_page;
                $config["uri_segment"] = 4;
                $this->pagination->initialize($config);
                $data["links"] = $this->pagination->create_links();
                $data["results"] = $this->agenda_model->search_match($search, $limit_per_page, $start_index, $this->session->userdata('rutpaciente'));
                if($data["results"] > 0){
                    $this->vistas->__render_admin($data,'agenda_resultados_lista');
                }else{
                    $data["message"] = "No hubo resultados.";
                    $this->vistas->__render_admin($data,'error');
                }

            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            } else {
                redirect('login/index', 'refresh');
            }
        }else{
            redirect('login/index', 'refresh');
        }

    }    
    

}
