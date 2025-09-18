<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property M_auth $M_auth
 */

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/sign_in');
        } else {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->M_auth->login($email, $password);

            if (!$user) {
                $this->session->set_flashdata('error', 'Email atau Password salah!');
                redirect('auth/login');
            } else {
                $this->session->set_userdata([
                    'user_id'    => $user->id,
                    'user_name'  => $user->name,
                    'user_email' => $user->email,
                    'logged_in'  => TRUE
                ]);
                redirect('dashboard');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('landingpage');
    }
}
