<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property M_revisi $M_revisi
 * @property M_pelanggaran $M_pelanggaran
 * @property M_kehadiran $M_kehadiran
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

    // public function index() {
    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('dashboard');
    //     $this->load->view('templates/footer');
    // }

    public function index()
    {
        $data['total_pelanggaran_bulan_lalu'] = $this->M_revisi->get_total_pelanggaran_bulan_lalu();
        $data['total_alpha_bulan_lalu'] = $this->M_kehadiran->get_total_alpha_bulan_lalu();
        $data['total_terlambat_hari_ini'] = $this->M_pelanggaran->get_total_terlambat_hari_ini();
        $data['total_siswa_treatment_tahun_ini'] = $this->M_revisi->get_total_siswa_treatment_tahun_ini();

        $pelanggaran = $this->M_revisi->get_pelanggaran();
        $kehadiran = $this->M_revisi->get_kehadiran();

        $siswa = [];

        foreach ($pelanggaran as $p) {
            $nisn = $p['nisn'];
            if (!isset($siswa[$nisn])) {
                $siswa[$nisn] = [
                    'nisn' => $p['nisn'],
                    'nama_siswa' => $p['nama_siswa'],
                    'kelas' => $p['kelas'],
                    'wali_kelas' => $p['wali_kelas'],
                    'poin' => 0
                ];
            }
            $siswa[$nisn]['poin'] += (int)$p['poin'];
        }

        foreach ($kehadiran as $k) {
            $nisn = $k['nisn'];
            if (!isset($siswa[$nisn])) {
                $siswa[$nisn] = [
                    'nisn' => $k['nisn'],
                    'nama_siswa' => $k['nama_siswa'],
                    'kelas' => $k['kelas'],
                    'wali_kelas' => $k['wali_kelas'],
                    'poin' => 0
                ];
            }
            $siswa[$nisn]['poin'] += (int)$k['poin'];
        }

        $rankingData = array_values($siswa);
        usort($rankingData, function ($a, $b) {
            return $b['poin'] - $a['poin'];
        });

        $data['ranking'] = array_slice($rankingData, 0, 5);

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}