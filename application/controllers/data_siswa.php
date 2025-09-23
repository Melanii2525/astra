
<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

/**
 * @property m $m
 * @property CI_DB_query_builder $db 
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 */

class Data_siswa extends CI_Controller
{
    public function __construct()
{
    parent::__construct();

    // Cek apakah user sudah login
    if (!$this->session->userdata('logged_in')) {
        redirect('landingpage'); // redirect ke halaman login/landing jika belum login
    }

    // Load semua model & helper yang dibutuhkan
    $this->load->model('M_kehadiran');
    $this->load->model('M_revisi');
    $this->load->model('M_pelanggaran');
    $this->load->model('m_siswa', 'm');
    $this->load->helper(['form', 'url']);
}

    public function index()
    {
        $data['title'] = "Data Siswa";
        $data['siswa'] = $this->m->get_all_ordered();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('data_siswa', $data);
        $this->load->view('templates/footer');
    }

    public function ambildata()
    {
        $page = $this->input->get('page') ?? 1;
        $limit = 35;
        $offset = ($page - 1) * $limit;

        $this->load->model('M_siswa');
        $total = $this->db->count_all('data_siswa'); 
        $data = $this->m->get_siswa_paginated($limit, $offset);

        echo json_encode([
            'siswa' => $data,
            'total' => $total,
            'page' => (int)$page,
            'limit' => $limit,
            'total_page' => ceil($total / $limit)
        ]);
    }

    public function tambahdata()
    {
        $nisn   = $this->input->post('nisn');
        $nipd   = $this->input->post('nipd');
        $nama_siswa   = $this->input->post('nama_siswa');
        $kelas  = $this->input->post('kelas');
        $jenis_kelamin     = $this->input->post('jenis_kelamin');
        $wali_kelas = $this->input->post('wali_kelas');

        $result['pesan'] = '';

        if ($nisn == '' || $nipd == '' || $nama_siswa == '' || $kelas == '' || $jenis_kelamin == '') {
            $result['pesan'] = 'Semua field wajib diisi.';
        } else {
            $cek = $this->db->get_where('data_siswa', ['nisn' => $nisn])->row();
            if ($cek) {
                $result['pesan'] = 'Data dengan NISN tersebut sudah ada.';
            } else {
                $data = [
                    'nisn'  => $nisn,
                    'nipd'  => $nipd,
                    'nama_siswa'  => strtoupper($nama_siswa),
                    'kelas' => strtoupper($kelas),
                    'jenis_kelamin'    => strtoupper($jenis_kelamin),
                    'wali_kelas'  => strtoupper($wali_kelas)
                ];
                $this->m->tambahdata($data, 'data_siswa');
            }
        }

        echo json_encode($result);
    }

    public function ambilId()
    {
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $data = $this->m->ambilId('data_siswa', $where)->result();
        echo json_encode($data);
    }

    public function ubahdata()
    {
        $id = $this->input->post('id');

        $data = [
            'nisn'  => $this->input->post('nisn'),
            'nipd'  => $this->input->post('nipd'),
            'nama_siswa'  => $this->input->post('nama_siswa'),
            'kelas' => $this->input->post('kelas'),
            'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
            'wali_kelas' => $this->input->post('wali_kelas')
        ];

        $where = ['id' => $id];
        $this->m->ubahdata('data_siswa', $data, $where);

        echo json_encode(['pesan' => '']);
    }

    public function get_detail_siswa()
    {
        $nisn = $this->input->post('nisn');
        $data = $this->db->get_where('data_siswa', ['nisn' => $nisn])->row();
        echo json_encode($data);
    }

    public function simpan_wali()
    {
        $tingkat = $this->input->post('kelas');
        $wali = $this->input->post('wali');

        $this->db->like('kelas', $tingkat, 'after');
        $this->db->update('data_siswa', ['walikelas' => $wali]);

        echo json_encode(['status' => 'ok']);
    }

    public function filterByKelas()
    {
        $kelas = $this->input->post('kelas');

        if ($kelas === '') {
            $data = $this->db->get('data_siswa')->result();
        } else {
            $this->db->where('kelas', $kelas);
            $data = $this->db->get('data_siswa')->result();
        }

        echo json_encode($data);
    }

    public function search()
    {
        $query = $this->input->post('query');
        $hasil = $this->m->cari_siswa($query);

        foreach ($hasil as $siswa) {
            echo '<div class="suggestion-item list-group-item"
            data-nama_siswa="' . strtoupper($siswa->nama_siswa) . '" 
            data-kelas="' . $siswa->kelas . '" 
            data-walikelas="' . $siswa->walikelas . '">' .
                ($siswa->nama_siswa) . ' - ' . $siswa->kelas .
                '</div>';
        }
    }

    public function hapus_semua()
    {
        $hapus = $this->db->empty_table('data_siswa');

        if ($hapus) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'failed']);
        }
    }

    public function import_excel()
    {
        $file = $_FILES['excel_siswa']['tmp_name'];

        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();

        $kelas = $sheet->getCell('B1')->getValue();
        $wali_kelas = $sheet->getCell('B2')->getValue();

        $data = [];
        $duplikat = [];

        for ($row = 5; $row <= $sheet->getHighestRow(); $row++) {
            $nisn = $sheet->getCell('B' . $row)->getValue();
            $nipd = $sheet->getCell('C' . $row)->getValue();
            $nama = $sheet->getCell('D' . $row)->getValue();
            $jk   = $sheet->getCell('E' . $row)->getValue();

            if ($nisn && $nipd && $nama && $jk) {
                $cek = $this->db->get_where('data_siswa', ['nisn' => $nisn])->row();

                if ($cek) {
                    $duplikat[] = $nisn;
                } else {
                    $data[] = [
                        'nisn' => $nisn,
                        'nipd' => $nipd,
                        'nama_siswa' => strtoupper($nama),
                        'kelas' => strtoupper($kelas),
                        'jenis_kelamin' => strtoupper($jk),
                        'wali_kelas' => strtoupper($wali_kelas),
                    ];
                }
            }
        }

        if (!empty($data)) {
            $this->db->insert_batch('data_siswa', $data);
        }

        if (!empty($data) && empty($duplikat)) {
            $this->session->set_flashdata('sukses', 'Semua data berhasil diimport.');
        } elseif (!empty($data) && !empty($duplikat)) {
            $this->session->set_flashdata('sukses', 'Beberapa data berhasil diimport, tetapi ada ' . count($duplikat) . ' NISN duplikat yang dilewati.');
        } elseif (empty($data) && !empty($duplikat)) {
            $this->session->set_flashdata('error', 'Semua data gagal diimport karena NISN sudah ada.');
        } else {
            $this->session->set_flashdata('error', 'Tidak ada data valid yang bisa diimport.');
        }

        redirect('data_siswa');
    }

    public function cari_data()
    {
        $keyword = $this->input->get('keyword');
        $page = $this->input->get('page') ?? 1;
        $limit = 35;
        $offset = ($page - 1) * $limit;

        $data = $this->m->search_siswa($keyword, $limit, $offset);

        $this->db->from('data_siswa');
        $this->db->group_start();
        $this->db->like('nisn', $keyword);
        $this->db->or_like('nipd', $keyword);
        $this->db->or_like('nama_siswa', $keyword);
        $this->db->or_like('kelas', $keyword);
        $this->db->or_like('wali_kelas', $keyword);
        $this->db->or_like('jenis_kelamin', $keyword);
        $this->db->group_end();
        $total = $this->db->count_all_results();

        echo json_encode([
            'siswa' => $data,
            'total' => $total,
            'page' => (int)$page,
            'limit' => $limit,
            'total_page' => ceil($total / $limit)
        ]);
    }

    public function upload_foto()
    {
        $id = $this->input->post('id_siswa');
        if (!empty($_FILES['foto_siswa']['name'])) {
            $config['upload_path']   = './uploads/foto_siswa/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name']     = 'siswa_' . $id . '_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_siswa')) {
                $fileData = $this->upload->data();
                $this->db->where('id', $id)->update('data_siswa', [
                    'foto' => $fileData['file_name']
                ]);
                echo json_encode(['status' => 'sukses']);
            } else {
                echo json_encode(['status' => 'gagal', 'error' => $this->upload->display_errors()]);
            }
        }
    }

    public function hapus_foto()
    {
        $id = $this->input->post('id');
        $siswa = $this->db->get_where('data_siswa', ['id' => $id])->row();

        if ($siswa && !empty($siswa->foto)) {
            $filePath = FCPATH . 'uploads/foto_siswa/' . $siswa->foto;

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $this->db->where('id', $id)->update('data_siswa', ['foto' => NULL]);

            echo json_encode(['status' => 'sukses']);
        } else {
            echo json_encode(['status' => 'gagal', 'error' => 'Foto tidak ditemukan']);
        }
    }
}