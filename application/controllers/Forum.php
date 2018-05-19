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
        $this->load->model('User/Permissions');
        $this->load->helper('date');
        $this->load->helper('text');
        $this->load->library('pagination');
        $this->load->library('ErrorShow');

        if (TRUE !== $this->session->logged) {
            $this->session->set_userdata('logged', FALSE);
        }
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
     * @param int $offset
     * @return bool if not exist board
     */
    public function board($id_cat=0, $offset=0)
    {

       if (0 === $this->BoardModel->boardExist($id_cat)) {
            $this->errorshow->showError('boardNoExist');
            return false;
        }

        $per_page = 10;
        $config['base_url'] = base_url("Forum/board/$id_cat/");

        $config['per_page'] = $per_page;
        $config['display_pages'] = FALSE;
        $config['total_rows'] = $this->BoardModel->getAllRowsByCategory($id_cat);
        $config['next_link'] = '<i class="fa fa-arrow-right" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-arrow-left" aria-hidden="true"></i>';
        $config['first_link'] = '<i class="fa fa-step-backward" aria-hidden="true"></i>';
        $config['last_link'] = '<i class="fa fa-step-forward" aria-hidden="true"></i>';
        $config['attributes'] = array('class' => 'btn grey', 'style' => 'padding: 9px 12px;');
        $this->pagination->initialize($config);

        $data['topics'] = $this->BoardModel->get_all_topics_by_category($id_cat,$per_page,$offset);
        $data['breadcrumb'] = $this->BoardModel->get_category_and_board_name($id_cat);
        $data['permissions'] = $this->Permissions->permissions($this->session->rol);

        $this->load->view('template/Head');
        $this->load->view('Board/topics/index',$data);
        $this->load->view('template/Footer');

    }

    /**
     * @param int $id
     * @param null $slug
     * @param int $offset
     * @return bool if topic not exist
     */
    public function topic($id=0, $slug=null, $offset=0)
    {
        if (0 === $this->topicModel->topicExist($id)) {
            $this->errorshow->showError('topicNoExist');
            return false;
        }
        $this->load->library('bbcode');
        $bbcode = new bbcode();

        $data['bbcode'] = $bbcode;
        /*Config Pagination*/
        $per_page = 10;
        $config['base_url'] = base_url("Forum/topic/$id/$slug/");
        $config['per_page'] = $per_page;
        $config['display_pages'] = FALSE;
        $config['total_rows'] = $this->topicModel->getAllRowsByTopicId($id);
        $config['next_link'] = '<i class="fa fa-arrow-right" aria-hidden="true"></i>';
        $config['prev_link'] = '<i class="fa fa-arrow-left" aria-hidden="true"></i>';
        $config['first_link'] = '<i class="fa fa-step-backward" aria-hidden="true"></i>';
        $config['last_link'] = '<i class="fa fa-step-forward" aria-hidden="true"></i>';
        $config['attributes'] = array('class' => 'btn grey', 'style' => 'padding: 9px 12px;');
        $this->pagination->initialize($config);
        /* End Config Pagination*/

        $data['replies'] = $this->topicModel->get_topic_by_id($id,$per_page,$offset);
        $data['breadcrumb'] = $this->BoardModel->get_category_and_board_name($data['replies'][0]['id_board']);
        $data['permissions'] = $this->Permissions->permissions($this->session->rol);

        $this->load->view('template/Head');
        $this->load->view('topic/index', $data);
        $this->load->view('template/Footer');
    }

    /**
     * @param $id_board
     * @return bool if not logged
     */
    public function post($id_board)
    {
        if (false === $this->session->logged) {
            $this->errorshow->showError('notLogin');
            return false;
        }

        $data['breadcrumb'] = $this->BoardModel->get_category_and_board_name($id_board);

        $this->load->view('template/Head');
        $this->load->view('topic/form/post',$data);
        $this->load->view('template/Footer');
    }


    public function reply($id_topic, $id_msg=0)
    {
        if (false === $this->session->logged) {
            $this->errorshow->showError('notLogin');
            return false;
        }

        $data['topic'] = $this->topicModel->get_data_topic_by_id($id_topic);
        $permissions = $this->Permissions->permissions($this->session->rol);

        if (1 == $data['topic'][0]['locked'] && 0 == $permissions->reply_any) {
            $this->errorshow->showError('closedTopic');
            return false;
        }

        $quote = $this->topicModel->get_message_by_id_msg($id_msg);

        if(count($quote) != 0){
            $bbcode_quote = '[quote="'.$quote[0]['nick'].'"]'.$quote[0]['body'].'[/quote]';
            $data['topic']['quote'] = $bbcode_quote;
        }

        $this->load->view('template/Head');
        $this->load->view('topic/form/reply',$data);
        $this->load->view('template/Footer');
    }

    public function edit($id_msg)
    {
        if (false === $this->session->logged) {
            $this->errorshow->showError('notLogin');
            return false;
        }
        $id_user = $this->session->id;
        $permissions = $this->Permissions->permissions($this->session->rol);
        $data['message'] = $this->topicModel->get_message_by_id_msg($id_msg);
        $data['isTopic'] = $this->topicModel->isTopicAndOwned($id_msg,$id_user);

        if ($data['message'][0]['id_user'] === $this->session->id && $permissions->modify_own || $permissions->modify_any) {
            $this
                ->load
                ->view('template/Head')
                ->view('topic/form/edit', $data)
                ->view('template/Footer');
            return false;
        }

        $this->errorshow->showError('notPermissions');
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