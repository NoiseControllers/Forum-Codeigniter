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
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('topic/topicModel');
    }

    public function processTopic()
    {
        $errors = array();

        $this->form_validation->set_rules('title_post', 'title', 'required|xss_clean|max_length[140]');
        $this->form_validation->set_rules('body_post','message','required|xss_clean');

        $id_user = $this->session->id;
        $id_board = $this->input->post('id_board');
        $title = $this->input->post('title_post');
        $body = $this->input->post('body_post');

        $dataMessages = array(
            'id_topic' => 0,
            'id_board' => $id_board,
            'id_user' => $id_user,
            'title' => $title,
            'body' => $body,
            'poster_time' => time()
        );

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
        }elseif($this->topicModel->add_post($dataMessages) != '-1'){
            $errors['error'] = false;
            $errors['url'] = base_url('Forum/board/'.$id_board.'');
        }else{
            $errors['error'] = true;
        }

        echo json_encode($errors);

    }

    public function reply($id_topic)
    {
        $errors = array();
        $topic = $this->topicModel->get_data_topic_by_id($id_topic);

        $id_user = $this->session->id;
        $title = "RE: ".$topic[0]['title'];
        $body = $this->input->post('topic_body');

        $this->form_validation->set_rules('topic_body','message','required|xss_clean');

        $dataReply = array(
            'id_topic' => $topic[0]['id_topic'],
            'id_board' => $topic[0]['id_board'],
            'id_user' => $id_user,
            'title' => $title,
            'body' => $body,
            'poster_time' => time()
        );

        if($this->form_validation->run() == FALSE){
            $errors = $this->form_validation->error_array();
        }elseif($this->topicModel->add_reply($dataReply)){
            $errors['error'] = false;
        }else{
            $errors['error'] = true;
        }

        echo json_encode($errors);
    }



}