<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 26/03/2018
 * Time: 20:19
 */

class Topic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $this->load->model('topic/topicModel');
    }

    public function add_post($id_board=0)
    {
        //$title = $this->input->post('topic_title');
        //$body = $this->input->post('topic_body');

       //$this->form_validation->set_rules('topic_title', 'title', 'trim|required|xss_clean|max_length[140]');
        //$this->form_validation->set_rules('topic_body','message','trim|required|xss_clean');

        $dataMessages = array(
            'id_topic' => 0,
            'id_board' => $id_board,
            'id_user' => '1',
            'title' => 'prueba',
            'body' => 'prueba x2',
            'poster_time' => time()
        );

        $this->topicModel->add_topic($dataMessages);
    }
}