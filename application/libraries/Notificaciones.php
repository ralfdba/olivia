<?php
/**
 * Description of Notificaciones
 * Plantillas de todas las notificaciones del sistema
 * @author ralf
 */
class Notificaciones {
    /**
     * @param array $info información del usuario recién registrado
     * **/
    public function sent_notificacion_registro_confirmacion($info = NULL){
        $CI =& get_instance();
        $asunto = "Confirmación de registro";
        $de = strip_tags($CI->config->item('email'));
        $para = $info['identity'];
        $codigo = urlencode(base64_encode($info['id'].'|'.$info['activation']));
        $mensaje = '<h1 style="text-align: center;">'
                . $asunto
                . '</h1>'
                . '<img src="'.$CI->config->item('logo_sistema').'" width="150">'
                . '<p style="text-align: justify;">'
                . 'Para confirmar su registro y activar su cuenta, copie y pegue la siguiente url en su navegador:<br />'
                . $CI->config->item('url_sistema').'/registro/activate/'.$codigo
                . '</p>';
        $headers = "From: " . strip_tags($de) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($de) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($para, $asunto, $mensaje, $headers);        
             
        
    }
    /*
    Envio de correos para formularios de contacto        
    */
    public function sent_correo_contacto($params = NULL){
        $CI =& get_instance();
        $asunto = $params['asunto'];
        $de = strip_tags($CI->config->item('email'));
        $para = strip_tags($CI->config->item('email_para'));
        $mensaje = $params['mensaje']
        .'<br />'
        .'Sistema de notificaciones '.$CI->config->item('sistema').' '.$CI->config->item('version_ns');
        $headers = "From: " . strip_tags($de) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($de) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail($para, $asunto, $mensaje, $headers);
        
        return 0;//OK
    }
}
