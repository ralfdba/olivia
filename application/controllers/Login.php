<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Login
 *
 * @author ralf
 * @desc Login general para la aplicación, determina según el tipo de perfil de
 * usuario a que controlador debe ingresar
 */
class Login extends CI_Controller{
    private $remember = TRUE;

    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'ion_auth_model'
        ));
        $this->load->library(
            array(
                'ion_auth',
                'form_validation'
            ));
        $this->load->helper(array('url','language'));
        $this->form_validation->set_error_delimiters(
        $this->config->item('error_start_delimiter', 'ion_auth'),
        $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }


    public function index(){
        if( $this->ion_auth->logged_in() ) {
			redirect( 'admin/usuarios/index', 'refresh' );
        } else {
            $data['message'] = "";
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            //
            $this->form_validation->set_error_delimiters(
                    '<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules(
                    'correo', str_replace(':', '',
                            $this->lang->line('login_identity_label')),
                    'required');
            $this->form_validation->set_rules(
                    'password', str_replace(':', '',
                            $this->lang->line('login_password_label')),
                    'required');

            if ( $this->form_validation->run() ) {
				$remember = TRUE;
				if( $this->ion_auth->login( $this->input->post('correo'), $this->input->post('password'), $remember ) ) {
					redirect('admin/usuarios/index', 'refresh' );
				} else {
					if(validation_errors() == FALSE){
						$data['message'] = $this->ion_auth->errors();
					}
					$this->vistas->__render_login($data, 'index');
				}				
                            
			} else {
				$this->vistas->__render_login( NULL, 'index' );
            }
        }
    }

    public function logout(){
		$this->ion_auth->logout();
		redirect('login/index', 'refresh');
    }

}
