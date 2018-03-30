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
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('nick',$user);

        return $this->db->get()->result_array();
    }

    /**
     * @param $userData
     * @return bool
     */
    public function add_user($userData){
        $execute = $this->db->insert('users', $userData);
        return $execute;
    }


}