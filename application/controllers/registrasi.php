<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property M_auth $M_auth
*/

class Registrasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);        
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/sign_up');
        } else {
            $data = [
                'name'     => htmlspecialchars($this->input->post('name')),
                'email'    => htmlspecialchars($this->input->post('email')),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            $this->M_auth->register($data);
            $this->session->set_flashdata('success', 'Akun berhasil dibuat, silakan login!');
            redirect('auth/login');
        }
    }
}
