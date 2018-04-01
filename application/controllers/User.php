<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 26/03/2018
 * Time: 20:15
 */

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}