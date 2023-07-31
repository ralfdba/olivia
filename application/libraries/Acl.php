<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * ACL, Access Control List
 * Maneja acceso a controladores por roles
 * tabla acl (roles(json),controllers(json),actions(json))
 */
class Acl{
    /**
     * 
     * return @object con todos los controladores y acciones registrados en la tabla
     * 
     */
    public function __get_all_acl( $id = NULL ){
        $CI =& get_instance();
        $CI->load->model(
            array(
            'admin/acl_model'
            )
        );
        $CI->load->library(
            array(
                'ion_auth',
                'session'
            ));
        if ( !is_null( $id ) ) {
            $response = $CI->acl_model->get_by_id( $id );//Filtro por el ID de la fila de la tabla ACL
        } else {
            $response = $CI->acl_model->get_all();//Obtengo todos los datos de la tabla ACL
        }
    }

    /**
     * 
     * Obtengo el ID del usuario que inicia la sesión
     * Reviso el role del usuario que inicio la sesión
     * Obtengo el controlador asociado al role
     * si es admin, se va a usuarios, si no, al role y controlador registrado en la base de datos
     */

     public function __get_all_controllers_by_role() {
        $CI =& get_instance();
        $CI->load->library(
            array(
                'ion_auth',
                'session',
                'vistas'
            ));        
        $CI->load->model(
            array(
            'admin/acl_model'
            )
        );
        if ( $CI->ion_auth->is_admin() ) {
            redirect( 'admin/usuarios/index', 'refresh' );
        } else {
            //identifico al usuario
            $user = $CI->ion_auth->user()->row();
            //obtengo todos los grupos/roles del usuario que inicio sesion
            $user_groups = $CI->ion_auth->get_users_groups( $user->id )->result();
            $roles = $CI->acl_model->get_all_controllers_by_role( $user_groups[0]->name );
            if ( empty( $roles ) ) {
                $data['message'] = "Rol no esta asociado a un controlador. Contacte al Administrador.";
                $data['message'] .= " <a href=\"".site_url('login')."\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i>Volver</a>";
                $CI->ion_auth->logout();
                $CI->vistas->__render_login($data, 'error');
            } else {
                $role_decode = json_decode($roles[0]->roles);
                $controller_decode = json_decode($roles[0]->controllers);
                $actions_decode = json_decode($roles[0]->actions);
    
                if ( $CI->ion_auth->in_group( $role_decode->roles[0] ) ) {
                    redirect( $controller_decode->controllers[0].'/index', 'refresh' );
                }
            }
            
        }
    }    
    /**
     * 
     * return @object con todos los controladores creados para poblar objeto select en la eleccion de que rol va a que controlador
     */
    public function __get_all_file_controllers(){
        $controllers = array();
        $CI =& get_instance();
        $CI->load->helper('file');        
        $files = get_dir_file_info(APPPATH.'controllers', FALSE);
        foreach ( array_keys( $files ) as $file ) {
            if ( $file != 'index.html' )
                $controllers[] = str_replace('.php', '', $file);
        }
        return $controllers;        
    }

}