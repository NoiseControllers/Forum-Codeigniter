<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/03/2018
 * Time: 19:53
 */

class BoardModel extends CI_Model
{
    /**
     * BoardModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @return mixed
     */
    public function Get_All_Board()
    {

        $this->db->select('boards.id, categories.color, boards.name, boards.description');
        $this->db->from('boards');
        $this->db->join('categories','categories.id_cat=boards.id_cat', 'INNER');
        $this->db->order_by('categories.cat_order');

        return $this->db->get()->result_array();

    }

    /**
     * @param $id_cat
     * @return mixed
     */
    public function get_all_topics_by_category($id_cat)
    {
        $this->db->select('messages.id_topic, messages.title, messages.poster_time, users.nick, topics.locked');
        $this->db->from('messages');
        $this->db->join('users','users.id = messages.id_user','INNER');
        $this->db->join('topics','topics.id_topic = messages.id_topic AND topics.id_first_msg = messages.id_msg','INNER');
        $this->db->where('messages.id_board = '.$id_cat.'');
        $this->db->order_by('messages.poster_time DESC');

        return $this->db->get()->result_array();
    }

    /**
     * @param $id_board
     * @return mixed
     */
    public function get_category_and_board_name($id_board)
    {
        $this->db->select('categories.name AS categoria, boards.name AS board, boards.id AS id_board ');
        $this->db->from('boards');
        $this->db->where('id = '.$id_board.'');
        $this->db->join('categories','categories.id_cat = boards.id_cat','INNER');

        return $this->db->get()->result_array();
    }
}