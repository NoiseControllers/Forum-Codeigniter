<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 28/03/2018
 * Time: 16:12
 */

class UserModel extends CI_Model
{
    /**
     * UserModel constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    /**
     * @param $user
     * @param $passwd
     * @return bool
     */
    public function check_user_login($user, $passwd)
    {
        $this->db->select('passwd');
        $this->db->where('nick',$user);

        $hash = $this->db->get('users')->row('passwd');

        return $this->check_user_hash_password($user,$passwd,$hash);

    }

    /**
     * @param $user
     * @param $passwd
     * @param $hash
     * @return bool
     */
    private function check_user_hash_password($user,$passwd,$hash)
    {
         $isLoggin = password_verify($passwd,$hash);

         if($isLoggin){
             $this->update_user_last_login($user);
             return true;
         }else{
             return false;
         }
    }

    /**
     * @param $user
     */
    private function update_user_last_login($user)
    {
        $this->db->set('last_login', time());
        $this->db->where('nick', $user);
        $execute = $this->db->update('users');
    }

    /**
     * @param $user
     */
    public function get_data_user_by_nick($user)
    {
        $this->db->select('users.*, users_groups.name AS group_name');
        $this->db->from('users');
        $this->db->where('nick',$user);
        $this->db->join('users_groups','users_groups.id_group=users.rol','INNER');

        return $this->db->get()->result_array();
    }

    public function get_data_user_by_id($id_user)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("id=$id_user");

        return $this->db->get()->row();
    }

    /**
     * @param $userData
     * @return bool
     */
    public function add_user($userData){
        $execute = $this->db->insert('users', $userData);
        return $execute;
    }

    /**
     * @param $id_user
     * @return mixed
     */
    public function get_last_activity_by_id_user($id_user)
    {
        $this->db->select('messages.id_topic,messages.title,messages.poster_time');
        $this->db->from('messages');
        $this->db->where("id_user=$id_user");
        $this->db->order_by('messages.poster_time DESC');
        $this->db->limit(5);

        return $this->db->get()->result_array();
    }

    /**
     * @param $id_user
     * @return mixed
     */
    public function get_the_total_of_topics_by_user($id_user)
    {

        $this->db->select('count(topics.id_topic) AS totalTopics');
        $this->db->from('messages');
        $this->db->join('topics','topics.id_first_msg=messages.id_msg','INNER');
        $this->db->where("messages.id_user=$id_user");

        return $this->db->get()->result_array();
    }

    /**
     * @param $id_user
     * @return mixed
     */
    public function get_the_total_of_messages_by_user($id_user)
    {

        $this->db->select('count(messages.id_msg) as totalMessages');
        $this->db->from('messages');
        $this->db->where("messages.id_user=$id_user");

        return $this->db->get()->result_array();
    }

    public function aUserExists($id_user)
    {
        return $this->db->get_where('users',"id=$id_user")->num_rows();
    }

    public function userExist($nick)
    {
        return $this->db->get_where('users',"nick='$nick'")->num_rows();
    }

    public function updateProfile($id_user,$userdata)
    {
        $this->db->where('id', $id_user);
        return $this->db->update('users', $userdata);
    }

    public function passwordChange($id_user, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $this->db->set('passwd',$hash);
        $this->db->where('id', $id_user);
        return $this->db->update('users');
    }
}
