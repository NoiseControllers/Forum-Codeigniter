<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 01/04/2018
 * Time: 16:28
 */

class topicModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_topic_by_id($id_topic)
    {
        $this->db->select('topics.locked,users.nick AS author,messages.title, messages.body, messages.poster_time');
        $this->db->from('topics');
        $this->db->where('topics.id_topic='.$id_topic.'');
        $this->db->join('messages','messages.id_topic = topics.id_topic','INNER');
        $this->db->join('users','users.id=messages.id_user','INNER');

        return $this->db->get()->result_array();
    }

}