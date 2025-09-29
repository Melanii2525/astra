<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property M_revisi $M_revisi
 * @property M_pelanggaran $M_pelanggaran
 * @property M_kehadiran $M_kehadiran
 * @property input $input
 * @property upload $upload
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
        $this->load->database();
    }

    public function index()
    {
        $data['total_pelanggaran_bulan_lalu']   = $this->M_revisi->get_total_pelanggaran_bulan_lalu();
        $data['total_alpha_bulan_lalu']         = $this->M_kehadiran->get_total_alpha_bulan_lalu();
        $data['total_terlambat_hari_ini']       = $this->M_pelanggaran->get_total_terlambat_hari_ini();
        $data['total_siswa_treatment_tahun_ini'] = $this->M_revisi->get_total_siswa_treatment_tahun_ini();

        $data['ranking'] = $this->M_revisi->get_ranking_siswa();
        $data['log_keluar'] = $this->M_revisi->get_siswa_dikeluarkan();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function kembalikan($id)
    {
        $this->db->where('id', $id);
        $this->db->update('data_siswa', [
            'tanggal_kembalikan' => date('Y-m-d')
        ]);

        $this->session->set_flashdata('success', '✅ Siswa berhasil ditandai sudah dikembalikan ke orang tua.');
        redirect('dashboard');
    }

    // Fungsi keluarkan siswa
// public function keluarkan($nisn)
// {
//     $this->db->where('nisn', $nisn);
//     $this->db->update('data_siswa', [
//         'status' => 'dikeluarkan',
//         'tanggal_keluar' => date('Y-m-d H:i:s')
//     ]);

//     $this->session->set_flashdata('success', '✅ Siswa berhasil dikeluarkan.');
//     redirect('dashboard');
// }

    public function upload_bukti()
    {
        if ($this->input->method() === 'post') {
            $nisn = $this->input->post('nisn');

            $config['upload_path']   = './uploads/bukti_keluar/';
            $config['allowed_types'] = 'jpg|png|pdf';
            $config['max_size']      = 2048;
            $config['file_name']     = 'bukti_' . $nisn . '_' . time();

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('bukti')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('dashboard');
            } else {
                $uploadData = $this->upload->data();

                $dataUpdate = [
                    'status'         => 'dikeluarkan',
                    'tanggal_keluar' => date('Y-m-d H:i:s'),
                    'bukti_file'     => $uploadData['file_name']
                ];
                $this->db->where('nisn', $nisn)->update('data_siswa', $dataUpdate);

                $this->session->set_flashdata('success', 'Siswa resmi dikeluarkan');
                redirect('dashboard');
            }
        }
    }

}