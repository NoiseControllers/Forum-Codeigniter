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
        $this->load->helper('text');

        //$this->output->enable_profiler(TRUE);
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

    /**
     * @param $id
     * @param $slug
     */
    public function topic($id, $slug)
    {
        $data['replies'] = $this->topicModel->get_topic_by_id($id);
        $data['breadcrumb'] = $this->BoardModel->get_category_and_board_name($data['replies'][0]['id_board']);

        $this->load->view('template/Head');
        $this->load->view('topic/index', $data);
        $this->load->view('template/Footer');
    }

    /**
     * @param $id_board
     */
    public function post($id_board)
    {
        $data['breadcrumb'] = $this->BoardModel->get_category_and_board_name($id_board);

        $this->load->view('template/Head');
        $this->load->view('topic/form/post',$data);
        $this->load->view('template/Footer');
    }

    /**
     * @param $id_topic
     * @param int $id_msg
     */
    public function reply($id_topic, $id_msg=0)
    {
        $data['topic'] = $this->topicModel->get_data_topic_by_id($id_topic);
        $quote = $this->topicModel->get_message_by_id_msg($id_msg);

        if(count($quote) != 0){
            $bbcode_quote = '[quote author='.$quote[0]['nick'].']'.$quote[0]['body'].'[/quote]';
            $data['topic']['quote'] = $bbcode_quote;
        }

        $this->load->view('template/Head');
        $this->load->view('topic/form/reply',$data);
        $this->load->view('template/Footer');
    }

    public function edit($id_msg)
    {
        $id_user = $this->session->id;

        $data['message'] = $this->topicModel->get_message_by_id_msg($id_msg);
        $data['isTopic'] = $this->topicModel->isTopicAndOwned($id_msg,$id_user);

        $this
            ->load
            ->view('template/Head')
            ->view('topic/form/edit', $data)
            ->view('template/Footer');
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