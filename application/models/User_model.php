<?php
class User_model extends CI_Model {
    public function get_user($username, $password) {
        return $this->db->get_where('users', ['username'=> $username, 'password'=> $password])->row();
    }
}
?>