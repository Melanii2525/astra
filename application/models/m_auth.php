<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    // cari user berdasarkan email ATAU username
    public function get_user($username_or_email)
    {
        $this->db->where('email', $username_or_email);
        $this->db->or_where('username', $username_or_email);
        return $this->db->get('users')->row();
    }

    // fungsi login
    public function login($email, $password)
{
    $this->db->where('email', $email);
    $this->db->where('password', $password); // langsung cek tanpa hash
    return $this->db->get('users')->row();
}   

}