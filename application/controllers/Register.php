<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 26/03/2018
 * Time: 20:18
 */

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User/UserModel');
        $this->load->database();
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

        $this->load->view('user/register/index');
    }

    public function process()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $errors = array();

        $nick = $this->input->post('nick');
        $passwd = $this->input->post('passwd');
        $conf_passwd = $this->input->post('conf_passwd');
        $email = $this->input->post('email');

        $this->form_validation->set_message('required','El campo %s es obligatorio.');
        $this->form_validation->set_message('is_unique','%s ya ha sido registrado.');
        $this->form_validation->set_message('matches','La confirmación de %s no coincide.');
        $this->form_validation->set_message('valid_email','La dirección de correo electronico no es valida.');

        $this->form_validation->set_rules('nick', 'nick', 'trim|required|xss_clean|max_length[25]|is_unique[users.nick]');
        $this->form_validation->set_rules('email','correo electrónico','trim|required|xss_clean|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('passwd', 'Password ', 'required|matches[conf_passwd]');
        $this->form_validation->set_rules('conf_passwd','password','required');

        $userData = array(
            'nick'              => $nick,
            'passwd'            => password_hash($passwd,PASSWORD_DEFAULT),
            'email'             => $email,
            'date_registered'   => time(),
            'rol'               =>  '0'
        );
        if ($this->form_validation->run() == FALSE){
            $errors = $this->form_validation->error_array();
        }elseif($this->UserModel->add_user($userData)){
            $errors['register'] = true;
        }else{
            $errors['register'] = false;
        }

        echo json_encode($errors);

    }
}