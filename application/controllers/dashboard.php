<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property M_revisi $M_revisi
 * @property M_pelanggaran $M_pelanggaran
 * @property M_kehadiran $M_kehadiran
 * @property db $db
 */

class Dashboard extends CI_Controller
{
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

    public function index()
    {
        $data['total_pelanggaran_bulan_lalu']   = $this->M_revisi->get_total_pelanggaran_bulan_lalu();
        $data['total_alpha_bulan_lalu']         = $this->M_kehadiran->get_total_alpha_bulan_lalu();
        $data['total_terlambat_hari_ini']       = $this->M_pelanggaran->get_total_terlambat_hari_ini();
        $data['total_siswa_treatment_tahun_ini']= $this->M_revisi->get_total_siswa_treatment_tahun_ini();

        $data['ranking'] = $this->M_revisi->get_ranking_siswa();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function kembalikan($id)
    {
        $this->db->where('id', $id);
        $this->db->update('siswa', [
            'tanggal_kembalikan' => date('Y-m-d')
        ]);
    
        $this->session->set_flashdata('success', '✅ Siswa berhasil ditandai sudah dikembalikan ke orang tua.');
        redirect('dashboard');
    }    
}