<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 26/03/2018
 * Time: 20:17
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User/UserModel');
    }

    public function index()
    {
        $this->execute();
    }

    private function execute()
    {
        if($this->session->logged){
            redirect(base_url());
        }
        $this->load->view('user/login/index');
    }

    public function process()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $errors = new stdClass();

        $user = $this->input->post('nick');
        $passwd = $this->input->post('passwd');

        $this->form_validation->set_message('required','El campo %s es obligatorio.');
        $this->form_validation->set_rules('nick','nick','trim|required|xss_clean');
        $this->form_validation->set_rules('passwd','password','required');

        if ($this->form_validation->run() == FALSE){
            $errors->success = false;
            $errors->value = $this->form_validation->error_string();
        }elseif($this->UserModel->check_user_login($user,$passwd)){
            $data_user = $this->UserModel->get_data_user_by_nick($user);
            $dataUser = array(
                'id'  => $data_user[0]['id'],
                'nick'     => $data_user[0]['nick'],
                'email' => $data_user[0]['email'],
                'avatar' => $data_user[0]['avatar'],
                'rol' => $data_user[0]['rol'],
                'logged' => TRUE
            );

            $this->session->set_userdata($dataUser);

            $errors->success = true;
            $errors->value = 'Inicio de session, correctamente :)';

        }else{
            $errors->success = false;
            $errors->value = 'Oops... Usuario o contraseña incorrectos.';
        }

        echo json_encode($errors);

    }
}