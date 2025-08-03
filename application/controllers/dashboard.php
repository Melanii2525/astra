<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
*/

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }
}
