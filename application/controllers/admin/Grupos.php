<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Grupos
 * Crear los grupos del sistema
 * @author ralf
 */
class Grupos extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model',
            'admin/grupos_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'ion_auth'
            ));
    }

    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->ion_auth->user()->row();
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->grupos_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->grupos_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url('admin/grupos/index');
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'grupos_lista');
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
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->ion_auth->user()->row();
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('nombre', 'Nombre categor&iacute;a', 'required|trim|min_length[3]|max_length[40]');
                $this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'required|trim|min_length[3]|max_length[40]');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'grupos_create');
                }else{
                    if($this->ion_auth->create_group($this->input->post('nombre'), $this->input->post('descripcion'))){
                        $data['message'] = "Exito al crear nuevo grupo";
                    }else{
                        $data['message'] = "Error al crear nuevo grupo";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/grupos/index')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
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
            if($this->ion_auth->is_admin()){
                if($id){
                    $params['grupo_id'] = $id;
                    $data['grupo_select'] = $this->grupos_model->selectbyid($params);
                }
                $data['info_usuario'] = $this->ion_auth->user()->row();
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('nombre', 'Nombre categor&iacute;a', 'required|trim|min_length[3]|max_length[40]');
                $this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'required|trim|min_length[3]|max_length[40]');

                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'grupos_edit');
                }else{
                    if($this->ion_auth->update_group($this->input->post('id'), $this->input->post('nombre'), $this->input->post('descripcion'))){
                        $data['message'] = "Exito al editar grupo.";
                    }else{
                        $data['message'] = "Error al editar grupo";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/grupos/index')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
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
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->ion_auth->user()->row();
                if($id){
                    if($this->ion_auth->delete_group($id)){
                            $data['message'] = "Exito al eliminar grupo.";
                    }else{
                        $data['message'] = "Error al eliminar grupo";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/grupos/index')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
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
}
