<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 14/04/2018
 * Time: 15:59
 */

class Likes extends CI_Controller
{
    private $to_user_id;
    private $from_user_id;

    public function __construct()
    {
        parent::__construct();

        $this->to_user_id = 0;
        $this->from_user_id = $this->session->id;

        $this->load->model('User/UserModel');
        $this->load->model('User/likesModel');
    }

    public function Set($to_user_id)
    {
        $this->to_user_id = $to_user_id;
        $res = new stdClass();

        if (0 === $this->isValidUser() ||
            NULL === $this->session->id) {
            $res->success = false;
            $res->values = 'No tienes permisos para realizar esta accion.';
            die(json_encode($res));
        }

        switch(true) {
            case 0 == $this->isLiked():
                $res->success = $this->liked();
                $res->values = 'liked';
                $res->totalLikes = $this->totalLikes();
                break;
            case 1 == $this->isLiked():
                $res->success = $this->disliked();
                $res->values = 'disliked';
                $res->totalLikes = $this->totalLikes();
                break;
            default :
                $res->success = false;
                $res->values = 'Hubo un error interno.';
        }

        echo json_encode($res);
    }

    private function isValidUser()
    {
        return $this
            ->UserModel
            ->aUserExists($this->to_user_id);
    }

    private function isLiked()
    {
        return $this
            ->likesModel
            ->isLiked($this->to_user_id,$this->from_user_id);
    }

    private function liked()
    {
        return $this
            ->likesModel
            ->addLike($this->to_user_id,$this->from_user_id);
    }

    private function disliked()
    {
        return $this
            ->likesModel
            ->removeLike($this->to_user_id,$this->from_user_id);
    }

    private function totalLikes()
    {
        return $this
            ->likesModel
            ->getTotalLikes($this->to_user_id);
    }
}
