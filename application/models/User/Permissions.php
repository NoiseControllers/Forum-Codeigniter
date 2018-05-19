<?php
/**
 * Created by PhpStorm.
 * User: aroa
 * Date: 19/05/2018
 * Time: 11:43
 */

class Permissions extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @param $group_id
     * @return mixed
     */
    public function permissions($group_id)
    {
        $this->db->select('*');
        $this->db->from('groups_permissions');
        $this->db->where('id_group',$group_id);

        return $this->db->get()->row();
    }
}