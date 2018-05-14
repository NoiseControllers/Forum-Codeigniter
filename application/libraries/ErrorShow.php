<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13/05/2018
 * Time: 18:13
 */

class ErrorShow
{
    protected $CI;

    public function showError($type)
    {
        $data['msg'] = $this->type($type);
        $this->CI =& get_instance();
        $this->CI->load
            ->view('template/Head')
            ->view('template/error/error',$data)
            ->view('template/Footer');
    }

    public function type($type)
    {
        switch($type) {
            case 'userNotFound':
                return 'El usuario cuyo perfil estás intentando acceder no existe.';
                break;
            case 'topicNoExist':
            case 'boardNoExist':
                return 'El tema o foro que estás buscando parece que no existe, o fuera de tus límites.';
                break;
            case 'notPermissions':
                return 'No tienes los permisos suficientes para realizar dicha acción.';
                break;
            default:
                return 'Desconocemos el error, se ha informado a nuestros programadores.';
        }
    }
}