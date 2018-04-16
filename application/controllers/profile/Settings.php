<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 16/04/2018
 * Time: 19:27
 */

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->execute();
    }

    public function execute()
    {
        $data['user'] =
            [
                'email' => $this->session->email,
                'nick' => $this->session->nick,
                'location' => $this->session->location,
                'gender' => $this->session->gender,
            ];
        $this
            ->load
            ->view('template/Head')
            ->view('user/setting/setting',$data)
            ->view('template/Footer');
    }

    public function processDataChange()
    {
        $res = new stdClass();
        $user_id = $this->session->id;

        
    }
}