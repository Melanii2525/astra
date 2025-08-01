<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

/**
 * @property m $m
 * @property CI_DB_query_builder $db 
 * @property CI_Input $input
 */

class Data_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
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
        $data = $this->m->get_all_ordered();
        echo json_encode(['siswa' => $data]);
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
            // Semua data
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
        $hapus = $this->db->empty_table('data_siswa'); // Kosongkan seluruh isi tabel
    
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
                // Cek apakah NISN sudah ada di database
                $cek = $this->db->get_where('data_siswa', ['nisn' => $nisn])->row();
    
                if ($cek) {
                    $duplikat[] = $nisn; // Simpan NISN yang sudah ada
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
    
        // Set flashdata sesuai kondisi
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

}