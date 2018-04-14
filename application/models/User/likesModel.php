<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 14/04/2018
 * Time: 16:56
 */

class likesModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function isLiked($to_user_id, $from_user_id)
    {
        return $this
            ->db
            ->get_where('users_likes',"to_user_id=$to_user_id AND from_user_id=$from_user_id")
            ->num_rows();
    }

    public function addLike($to_user_id,$from_user_id)
    {
        $data = array
        (
            'to_user_id' => $to_user_id,
            'from_user_id' => $from_user_id
        );
       return $this
            ->db
            ->insert('users_likes',$data);
    }

    public function removeLike($to_user_id,$from_user_id)
    {
        return $this
            ->db
            ->delete('users_likes',"to_user_id=$to_user_id AND from_user_id=$from_user_id");
    }

    public function getTotalLikes($to_user_id)
    {
        return $this
            ->db
            ->get_where('users_likes',"to_user_id=$to_user_id")
            ->num_rows();
    }
}