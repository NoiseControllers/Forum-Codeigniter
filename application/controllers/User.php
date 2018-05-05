<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 26/03/2018
 * Time: 20:15
 */

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User/UserModel');
        $this->load->model('User/likesModel');
        $this->load->helper('date');
        $this->load->helper('text');
    }

    /**
     * @param $user
     */
    public function Profile($user)
    {
        $data['user'] = $this->UserModel->get_data_user_by_nick($user);
        $data['last_activity'] = $this->UserModel->get_last_activity_by_id_user($data['user'][0]['id']);
        $data['totalTopics'] = $this->UserModel->get_the_total_of_topics_by_user($data['user'][0]['id']);
        $data['totalMessages'] = $this->UserModel->get_the_total_of_messages_by_user($data['user'][0]['id']);
        $data['totalLikes'][0] = $this->likesModel->getTotalLikes($data['user'][0]['id']);

        $this->load->view('template/Head');
        $this->load->view('user/profile/profile',$data);
        $this->load->view('template/Footer');
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}