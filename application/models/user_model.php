<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

    public function get_user($username) {
        $this->db->where('email', $username);
        return $this->db->get('user')->row();
    }
}