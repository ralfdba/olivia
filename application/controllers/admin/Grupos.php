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
            'admin/grupos_model',
            'admin/acl_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'ion_auth',
                'acl'
            ));
    }

    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['role'] = 0;
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
                $data['role'] = 0;
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
                $data['role'] = 0;
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
                $data['role'] = 0;
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
            } else {
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
    /**
     * 
     * associate, asocia roles/grupos con controladores
     * almacena en la tabla acl(acl_model)
     * 
     */

    public function associate() {
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['role'] = 0;
                $data['info_usuario'] = $this->ion_auth->user()->row();
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->acl_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->acl_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url('admin/grupos/associate');
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'grupos_associate_lista');
            } else {
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }

    public function associate_create() {
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['role'] = 0;
                $data['info_usuario'] = $this->ion_auth->user()->row();
                $data['controladores'] = $this->acl->__get_all_file_controllers();
                $data['roles'] = $this->ion_auth->groups()->result();
                //
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('role[]', 'Nombre categor&iacute;a', 'trim');
                $this->form_validation->set_rules('controlador[]', 'Descripci&oacute;n', 'trim');
                //
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'grupos_associate_create');
                }else{
                    $params['roles'] = $this->input->post('role[]');
                    $params['controllers'] = $this->input->post('controlador[]');
                    $params['actions'] = $this->input->post('actions[]');
                    $resp = $this->acl_model->insert( $params );
                    //
                    if( is_null( $resp ) ){
                        $data['message'] = "Error al asociar";
                    }else{
                        $data['message'] = "Exito al asociar";
                    }
                    //
                    $data['message'] .=  "&nbsp; <a href=\"".site_url('admin/grupos/associate')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');

                }
            } else {
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }        
    }

}
