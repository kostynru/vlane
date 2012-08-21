<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        parent::__construct();
    }

    public function get_user($id)
    {
        $user = $this->db->get_where('users', array('id' => $id));
        return $user->row_array();
    }




    public function get_by_group($group_id)
    {
        $this->db->select('name, id');
        $this->db->from('members');
        $this->db->join('users', 'users.id = members.user_id');
        $users = $this->db->get_where('users', array('group_id' => $group_id));
        return $users->result_array();
    }


    public function get_by_school($name_school)
    {
        $user = $this->db->get_where('users', array('school' => $name_school));
        return $user->result_array();
    }

    public function get_by_city($city)
    {
        $user = $this->get_where('users', array('city' => $city));
        return $user->result_array();

    }
}

