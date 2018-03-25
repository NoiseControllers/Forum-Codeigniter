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
        $this->load->model('Board/Board');
    }

    public function index()
    {
        $this->execute();
    }

    private function execute()
    {
        $date['board'] = $this->Get_All_Board();
        $this->load->view('board/index',$date);
    }
}