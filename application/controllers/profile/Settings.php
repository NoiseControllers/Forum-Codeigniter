<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 16/04/2018
 * Time: 19:27
 */

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User/UserModel');
    }

    public function index()
    {
        $this->execute();
    }

    public function execute()
    {
        $user = $this->UserModel->get_data_user_by_id($this->session->id);

        $data['user'] =
            [
                'email' => $user->email,
                'nick' => $user->nick,
                'location' => $user->location,
                'gender' => $user->gender
            ];

        $this
            ->load
            ->view('template/Head')
            ->view('user/setting/setting',$data)
            ->view('template/Footer');
    }

    public function processDataChange()
    {
        $res = new stdClass();
        $id_user = $this->session->id;

        $email = $this->input->post('email');

        $gender = $this->input->post('gender');

        $location = $this->input->post('location');

        $this->form_validation->set_rules('email','Correo electronico','trim|xss_clean|valid_email');
        $this->form_validation->set_rules('gender','Genero','trim|xss_clean|in_list[NULL,0,1]');
        $this->form_validation->set_rules('location','Ubicacion','xss_clean|max_length[35]');

        $userdata = [
            'email' => $email,
            'gender' => $gender,
            'location' => $location
        ];

        if ($this->form_validation->run() == FALSE) {
            $res->success = false;
            $res->value = $this->form_validation->error_Array();
        } elseif ($this->UserModel->updateProfile($id_user,$userdata)) {
            $res->success = true;
            $res->value = "Datos guardados correctamente";

            $newdata = [
                'email' => $email,
                'location ' => $location,
                'gender' => $gender
            ];

            $this->session->set_userdata($newdata);

        } else {
            $res->success = false;
            $res->value = 'Hubo un error interno, vuelva a intentarlo.';
        }

        echo json_encode($res);
    }

    public function processPasswdChange()
    {
        $res = new stdClass();
        $id_user = $this->session->id;
        $myUser = $this->UserModel->get_data_user_by_id($id_user);

        $current_passwd = $this->input->post('current_passwd');
        $new_passwd = $this->input->post('new_passwd');
        $new_conf_passwd = $this->input->post('conf_passwd');

        switch (true) {
            case $new_passwd != $new_conf_passwd:
                $res->success = false;
                $res->value = 'La confirmacion de contraseñas es incorrecta.';
                break;
            case !password_verify($current_passwd,$myUser->passwd):
                $res->success = false;
                $res->value = 'Contraseña incorrecta!';
                break;
                case $this->UserModel->passwordChange($id_user,$new_conf_passwd);
                    $res->success = true;
                    $res->value = 'Contraseña cambiada correctamente!';
                break;
            default:
                $res->success = false;
                $res->value = 'No se puede completar tu solicitud en este momento. Vuelva a intentarlo más tarde2.';
        }

        echo json_encode($res);
    }

}