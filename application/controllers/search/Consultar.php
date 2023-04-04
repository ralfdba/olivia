<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultar extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'admin/buscador_model'
        ));
        $this->load->library(
            array(
                'notificaciones',
                'vistas',
            ));
    }

    private function __endpoint() {
      $opt = array (
        "controller" => "consultar",
        "path" => "search"
      );

      return $opt;
    }


    public function index() {
        if ( $this->ion_auth->logged_in() ) {

          $data['info_usuario'] = $this->permisos->get_user_data();
          //Paginación
          $limit_per_page = 10;//Limite para mostrar por página
          $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
          $total_records = $this->categorias_model->get_total();
          if ( $total_records > 0 ) {
              $data["results"] = $this->categorias_model->get_current_page_records($limit_per_page, $start_index);
              $config['base_url'] = site_url() . $this->__endpoint()["path"] ."/". $this->__endpoint()["controller"] ."/index";
              $config['total_rows'] = $total_records;
              $config['per_page'] = $limit_per_page;
              $config["uri_segment"] = 4;
              $this->pagination->initialize($config);
              $data["links"] = $this->pagination->create_links();
          }

          $this->vistas->__render_search( $data, 'search_index' );

        } else {
            redirect("login/index", 'refresh');
        }

    }

}
