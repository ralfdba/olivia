<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maestros extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/maestros_model',
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'ion_auth'
            ));
    }

    private function __endpoint() {
      $opt = array (
        "controller" => "maestros",
        "path" => "admin"
      );

      return $opt;
    }

    public function index(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                //Paginación
                $limit_per_page = 10;//Limite para mostrar por página
                $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $total_records = $this->maestros_model->get_total();
                if ($total_records > 0){
                    $data["results"] = $this->maestros_model->get_current_page_records($limit_per_page, $start_index);
                    $config['base_url'] = site_url() . $this->__endpoint()["path"] ."/". $this->__endpoint()["controller"] ."/index";
                    $config['total_rows'] = $total_records;
                    $config['per_page'] = $limit_per_page;
                    $config["uri_segment"] = 4;
                    //
                    $this->pagination->initialize($config);
                    $data["links"] = $this->pagination->create_links();
                }
                $this->vistas->__render_admin($data,'maestros_lista');
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }

    public function create(){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('nombre', 'Nombre maestro', 'required|trim|min_length[2]|max_length[120]');
                $this->form_validation->set_rules('estado', 'Estado maestro', 'trim');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'maestros_create');
                }else{
                    $params['nombre'] = $this->input->post('nombre');
                    $params['estado'] = $this->input->post('estado');
                    $resp = $this->maestros_model->insert($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al crear nueva tipo de maestro. ";
                    }else{
                        $data['message'] = "Exito al crear nueva tipo de maestro. ";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".$this->config->item('url_sistema').$this->__endpoint()["path"]."/".$this->__endpoint()["controller"]."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');

                }
            }else{
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
                    $params['categoria_id'] = $id;
                    $data['categoria_select'] = $this->maestros_model->selectbyid($params);
                }
                $data['info_usuario'] = $this->permisos->get_user_data();
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('id', 'ID', 'trim');
                $this->form_validation->set_rules('nombre', 'Nombre maestro', 'required|trim|min_length[2]|max_length[120]');
                $this->form_validation->set_rules('estado', 'Estado maestro', 'trim');
                if ($this->form_validation->run() == FALSE){
                    $this->vistas->__render_admin($data, 'maestros_edit');
                }else{
                    $params['id'] = $this->input->post('id');
                    $params['nombre'] = $this->input->post('nombre');
                    $params['estado'] = $this->input->post('estado');
                    $resp = $this->maestros_model->update($params);
                    if(is_null($resp)){
                        $data['message'] = "Error al editar maestro. ";
                    }else{
                        $data['message'] = "Exito al editar maestro. ";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".$this->config->item('url_sistema').$this->__endpoint()["path"]."/".$this->__endpoint()["controller"]."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data, 'error');

                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
    public function delete($id = NULL){
        if($this->ion_auth->logged_in()){
            if($this->ion_auth->is_admin()){
                $data['info_usuario'] = $this->permisos->get_user_data();
                if($id){
                    $resp = $this->maestros_model->delete($id);
                    if($resp > 0){
                            $data['message'] = "Exito al eliminar maestro. ";
                    }else{
                        $data['message'] = "Error al eliminar maestro.";
                    }
                    $data['message'] .=  "&nbsp; <a href=\"".$this->config->item('url_sistema').$this->__endpoint()["path"]."/".$this->__endpoint()["controller"]."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                    $this->vistas->__render_admin($data,'error');
                }
            }else{
                redirect("login/index", 'refresh');
            }
        }else{
            redirect("login/index", 'refresh');
        }
    }
}
