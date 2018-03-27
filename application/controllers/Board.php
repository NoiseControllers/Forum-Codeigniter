<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/03/2018
 * Time: 19:48
 */

class Board extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Board/BoardModel');

    }

    public function index()
    {
        $this->execute();
    }

    private function execute()
    {
        $this->load->view('template/Head');
        $this->load->view('template/Footer');
        var_dump($this->BoardModel->Get_All_Board());
    }
}