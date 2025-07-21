<?php
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
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/sign_in');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->M_auth->login($email, $password);

            if ($user) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'user_name' => $user->nama,
                    'user_email' => $user->email
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Email atau password salah!');
                redirect('auth/login');
            }
        }
    }

    public function sign_up()
    {
        $this->load->view('auth/sign_up');
    }

    public function register()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];

        $this->M_auth->register($data);
        redirect('auth/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
