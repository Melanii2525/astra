<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 */

class Pasal extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('landingpage');
        }

        $this->load->model('M_kehadiran');
        $this->load->model('M_revisi');
        $this->load->model('M_pelanggaran');
    }

    public function pasal_16() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_16');
        $this->load->view('templates/footer');
    }

    public function pasal_17() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_17');
        $this->load->view('templates/footer');
    }

    public function pasal_18() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_18');
        $this->load->view('templates/footer');
    }

    public function pasal_19() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_19');
        $this->load->view('templates/footer');
    }

    public function pasal_20() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_20');
        $this->load->view('templates/footer');
    }

    public function pasal_21() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_21');
        $this->load->view('templates/footer');
    }

    public function pasal_22() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_22');
        $this->load->view('templates/footer');
    }

    public function pasal_23() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pasal/pasal_23');
        $this->load->view('templates/footer');
    }
}