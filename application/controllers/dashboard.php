<?php

class Dashboard extends CI_Controller {
    // public function __construct()
    // {
    //     parent::__construct();

    //     if ($this->session->userdata('users') != '2') {
    //         $this->session->set_flashdata(
    //         'pesan',
    //                 '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //                     Anda Belum Login!
    //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                         <span aria-hidden="true">&times;</span>
    //                     </button>
    //                 </div>
    //         '); 
    //         redirect('auth/login');
    //     }
    // }

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }
}
