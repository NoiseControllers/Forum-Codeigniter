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
        /**
         *
         * SELECT categories.color, boards.name, boards.description
         * FROM categories
         * RIGHT JOIN boards
         * ON categories.id_cat=boards.id_cat
         * GROUP BY categories.color, boards.id_cat
         * ORDER BY categories.cat_order
         *
         */
        $this->db->select('categories.color, boards.name, boards.description');
        $this->db->from('categories');
        $this->db->join('boards','boards.id_cat=categories.id_cat', 'INNER');
        $this->db->group_by('boards.name');
        $this->db->order_by('categories.cat_order');

        return $this->db->get()->result_array();

    }
}