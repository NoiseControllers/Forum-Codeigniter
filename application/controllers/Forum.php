<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/03/2018
 * Time: 19:48
 */

class Forum extends CI_Controller
{
    /**
     * Forum constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Board/BoardModel');
        $this->load->model('topic/topicModel');
        $this->load->helper('date');
    }

    /**
     *
     */
    public function index()
    {
        $this->execute();
    }

    /**
     * @param $id_cat
     */
    public function board($id_cat)
    {
        $data['topics'] = $this->BoardModel->get_all_topics_by_category($id_cat);
        $data['breadcrumb'] = $this->BoardModel->get_category_and_board_name($id_cat);
        
        $this->load->view('template/Head');
        $this->load->view('Board/topics/index',$data);
        $this->load->view('template/Footer');

    }

    public function topic($id,$slug)
    {
        $data['replies'] = $this->topicModel->get_topic_by_id($id);
        $data['breadcrumb'] = $this->BoardModel->get_category_and_board_name($id);
        //var_dump($data['replies']);

        $this->load->view('template/Head');
        $this->load->view('topic/index', $data);
        $this->load->view('template/Footer');
    }

    /**
     *
     */
    private function execute()
    {
        $data['boards'] = $this->BoardModel->Get_All_Board();

        $this->load->view('template/Head');
        $this->load->view('Board/index', $data);
        $this->load->view('template/Footer');

    }

}