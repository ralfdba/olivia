<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author ralf
 */
class Empresas extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model',
            'admin/empresas_model'
        ));
        $this->load->library(
            array(
                'ion_auth',
                'rut'
            ));
        $this->load->helper(array('url','language','mysql_to_excel_helper'));
    }

    public function index(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){                
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->empresas_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->empresas_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url('admin/empresas/index');
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'empresas_lista');
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
                
            } else {
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }

    public function create(){
        if($this->ion_auth->logged_in()){
            $data['info_usuario'] = $this->ion_auth->user()->row();
            if($this->ion_auth->is_admin()){
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[3]|max_length[200]');
                $this->form_validation->set_rules('rut', 'RUT', 'required|trim|max_length[12]');
                $this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'required|trim|min_length[3]|max_length[200]');
                $this->form_validation->set_rules('correo', 'E-Mail', 'required|trim|valid_email');
                $this->form_validation->set_rules('islab', 'Is Lab', 'trim');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'empresas_create');
                }else{
                    $params['nombre'] = $this->input->post('nombre');
                    $params['rut'] = $this->input->post('rut');
                    $params['direccion'] = $this->input->post('direccion');
                    $params['correo'] = $this->input->post('correo');//valida_rut
                    $params['islab'] = $this->input->post('islab');

                    if($this->rut->valida_rut($params['rut']) == true){
                        $resp = $this->empresas_model->insert($params);
                    }else{
                        $data['message'] = "RUT No va&aacute;lido.";
                    }


                    if(is_null($resp)){
                        $data['message'] = "Error al crear nueva empresa";
                    }else{
                        $data['message'] = "Exito al crear nueva empresa";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/empresas')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');

                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
                
            } else {
                redirect("login/index", 'refresh');
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
                    $params['empresa_id'] = $id;
                    $data['categoria_select'] = $this->empresas_model->selectbyid($params);
                }
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|min_length[3]|max_length[40]');
                $this->form_validation->set_rules('rut', 'RUT', 'required|trim|max_length[12]');
                $this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'required|trim|min_length[3]|max_length[200]');
                $this->form_validation->set_rules('correo', 'E-Mail', 'required|trim|valid_email');
                $this->form_validation->set_rules('islab', 'Is lab', 'trim');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'empresas_edit');
                }else{
                    $params['id'] = $this->input->post('id');
                    $params['nombre'] = $this->input->post('nombre');
                    $params['rut'] = $this->input->post('rut');
                    $params['direccion'] = $this->input->post('direccion');
                    $params['correo'] = $this->input->post('correo');
                    $params['islab'] = $this->input->post('islab');

                    if($this->rut->valida_rut($params['rut']) == true){
                        $resp = $this->empresas_model->update($params);
                    }else{
                        $data['message'] = "RUT No va&aacute;lido.";
                    }

                    if(is_null($resp)){
                        $data['message'] = "Error al editar empresa";
                    }else{
                        $data['message'] = "Exito al editar empresa";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/empresas')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');

                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
                
            } else {
                redirect("login/index", 'refresh');
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
                    $resp = $this->empresas_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar empresa";
                    }else{
                        $data['message'] = "Error al eliminar empresa";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/empresas')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data,'error');
                }
            } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
                
            } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
                
            } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
                $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
                
            } else {
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }

    public function excel_empresas() {
          if($this->ion_auth->logged_in()){
               if($this->ion_auth->is_admin()){
                   $fecha = date("Y-m-d");
                   to_excel($this->empresas_model->download_excel_empresas(), $fecha."_gomed_empresas_lista");
               }else{
                   redirect("login/index", 'refresh');
               }
          } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
            $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
            
        } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
            $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
            
        } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
            $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            
        } else {
            redirect("login/index", 'refresh');
        }
    }
    public function excel_regiones() {
          if($this->ion_auth->logged_in()){
               if($this->ion_auth->is_admin()){
                   $fecha = date("Y-m-d");
                   to_excel($this->empresas_model->download_excel_regiones(), $fecha."_gomed_regiones_lista");
               }else{
                   redirect("login/index", 'refresh');
               }
          } elseif( $this->ion_auth->in_group( "Usuarios/pacientes" ) ) {
            $this->vistas->__render( $data, 'usuarios_dashboard', 'pacientes');
            
        } elseif( $this->ion_auth->in_group( "Staff Clinico" ) ) {
            $this->vistas->__render( $data, 'usuarios_dashboard', 'staffclinico');
            
        } elseif( $this->ion_auth->in_group( "Admin Empresa" ) ) {
            $this->vistas->__render( $data, 'usuarios_dashboard', 'adminempresa');
            
        } else {
            redirect("login/index", 'refresh');
        }
    }
}
