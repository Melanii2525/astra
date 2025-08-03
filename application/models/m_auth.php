<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function register($data)
    {
        return $this->db->insert('users', $data);
    }

    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $user = $this->db->get('users')->row();

        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }

        return false;
    }
}
