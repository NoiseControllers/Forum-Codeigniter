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

    /**
     * @param $id_topic
     * @return mixed
     */
    public function get_topic_by_id($id_topic)
    {
        $this->db->select('topics.id_topic,messages.id_msg,topics.id_board,topics.locked,users.nick AS author,messages.title, messages.body, messages.poster_time');
        $this->db->from('topics');
        $this->db->where('topics.id_topic='.$id_topic.'');
        $this->db->join('messages','messages.id_topic = topics.id_topic','INNER');
        $this->db->join('users','users.id=messages.id_user','INNER');

        return $this->db->get()->result_array();
    }

    public function get_data_topic_by_id($id_topic)
    {
        $this->db->select('topics.id_topic,topics.id_board,messages.title');
        $this->db->from('topics');
        $this->db->join('messages','messages.id_msg=topics.id_first_msg','INNER');
        $this->db->where('topics.id_topic='.$id_topic.'');
        return $this->db->get()->result_array();
    }


    /**
     * @param $messageData
     * @return int
     */
    public function add_post($messageData)
    {
        $this->db->insert('messages',$messageData);
        $message_id = $this->db->insert_id();

        $topicData = array(
            'id_board' => $messageData['id_board'] ,
            'id_first_msg' => $message_id,
            'id_last_msg' => $message_id,
            'locked' => '0'
        );

        $this->db->insert('topics',$topicData);
        $topic_id = $this->db->insert_id();

        $this->db->set('id_topic', $topic_id);
        $this->db->where('id_msg', $message_id);
        $execute =  $this->db->update('messages');

        if($execute){
            return $topic_id;
        }else{
            return -1;
        }

    }

    public function add_reply($replyData)
    {
        $query = $this->db->insert('messages',$replyData);
        if($query){
            $this->update_last_msg_in_topic($this->db->insert_id(),$replyData['id_topic']);
            return true;
        }else{
            return false;
        }
    }

    private function update_last_msg_in_topic($id_last_msg,$id_topic)
    {
        $this->db->set('id_last_msg',$id_last_msg);
        $this->db->where('id_topic',$id_topic);

        $this->db->update('topics');
    }

    public function get_message_by_id_msg($id_msg)
    {
        $this->db->select(',users.nick,messages.body, messages.poster_time');
        $this->db->from('messages');
        $this->db->where("id_msg=$id_msg");
        $this->db->join('users','users.id=messages.id_user','INNER');

        return $this->db->get()->result_array();
    }

}