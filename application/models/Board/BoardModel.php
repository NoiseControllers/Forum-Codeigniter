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

        $this->db->select('categories.color, boards.name, boards.description, boards.id');
        $this->db->from('categories');
        $this->db->join('boards','boards.id_cat=categories.id_cat', 'INNER');

        return $this->db->get()->result_array();

    }

    /**
     * @param $id_cat
     * @return mixed
     */
    public function get_all_topics_by_category($id_cat)
    {
        $this->db->select('topics.id_topic, topics.locked, messages.title, users.nick AS author, messages.poster_time AS time_topic, user_last.nick AS last_user_msg, last_msg.poster_time AS last_poster_msg');
        $this->db->from('topics');
        $this->db->join('messages','messages.id_msg = topics.id_first_msg','INNER');
        $this->db->join('users','users.id=messages.id_user','INNER');
        $this->db->join('messages AS last_msg','last_msg.id_msg = topics.id_last_msg','INNER');
        $this->db->join('users AS user_last','user_last.id = last_msg.id_user','INNER');
        $this->db->where("topics.id_board = $id_cat");
        $this->db->order_by('last_msg.poster_time DESC');

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