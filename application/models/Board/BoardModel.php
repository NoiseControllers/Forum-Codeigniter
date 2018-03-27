<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 25/03/2018
 * Time: 19:53
 */

class BoardModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function Get_All_Board()
    {

        $this->db->select('categories.color, boards.name, boards.description');
        $this->db->from('boards');
        $this->db->join('categories','categories.id_cat=boards.id_cat', 'INNER');
        $this->db->order_by('categories.cat_order');

        return $this->db->get()->result_array();

    }
}