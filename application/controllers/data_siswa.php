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
        $data['siswa'] = $this->m->get_all_ordered(); // ambil data siswa dari model

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('data_siswa', $data); // sekarang $siswa tersedia di view
        $this->load->view('templates/footer');
    }

    public function ambildata()
    {
        $all = $this->m->get_all_ordered();

        $data = [
            'kelas_x' => [],
            'kelas_xi' => [],
            'kelas_xii' => []
        ];

        foreach ($all as $siswa) {
            if (strpos($siswa->kelas, 'XII') === 0) {
                $data['kelas_xii'][] = $siswa;
            } elseif (strpos($siswa->kelas, 'XI') === 0) {
                $data['kelas_xi'][] = $siswa;
            } elseif (strpos($siswa->kelas, 'X') === 0) {
                $data['kelas_x'][] = $siswa;
            }
        }

        echo json_encode($data);
    }


    public function tambahdata()
    {
        $nisn   = $this->input->post('nisn');
        $nipd   = $this->input->post('nipd');
        $nama_siswa   = $this->input->post('nama_siswa');
        $kelas  = $this->input->post('kelas');
        $jenis_kelamin     = $this->input->post('jenis_kelamin');
        $wali_kelas = $this->input->post('wali_kelas');

        if ($nisn == '' || $nipd == '' || $nama_siswa == '' || $kelas == '' || $jenis_kelamin == '') {
            $result['pesan'] = 'Semua field wajib diisi.';
        } else {
            $result['pesan'] = '';
            $data = [
                'nisn'  => $nisn,
                'nipd'  => $nipd,
                'nama_siswa'  => $nama_siswa,
                'kelas' => $kelas,
                'jenis_kelamin'    => $jenis_kelamin,
                'wali_kelas'  => $wali_kelas
            ];

            $this->m->tambahdata($data, 'data_siswa');
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
        $tingkat = $this->input->post('kelas'); // X / XI / XII
        $wali = $this->input->post('wali');

        $this->db->like('kelas', $tingkat, 'after'); // contoh: kelas LIKE 'X%'
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

    public function hapusdata()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $hapus = $this->db->delete('data_siswa'); // sesuaikan dengan nama tabel

        if ($hapus) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'failed']);
        }
    }

    public function import_excel()
{
    $file_excel = $_FILES['excel_siswa']['tmp_name'];

    if ($file_excel) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($file_excel);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Asumsi: baris pertama (index 0) berisi info kelas dan wali
        $kelas = isset($sheetData[0][0]) ? $sheetData[0][0] : '';
        $wali_kelas = isset($sheetData[0][1]) ? $sheetData[0][1] : '';

        foreach ($sheetData as $i => $row) {
            if ($i <= 1) continue; // Skip baris 0 dan 1 (judul + header kolom)

            // Cek apakah kolom cukup
            if (!isset($row[0], $row[1], $row[2], $row[3])) continue;

            $data = [
                'nisn' => $row[0],
                'nipd' => $row[1],
                'nama_siswa' => $row[2],
                'jenis_kelamin'   => $row[3],
                'kelas' => $kelas,
                'wali_kelas' => $wali_kelas,
            ];
            $this->db->insert('data_siswa', $data);
        }

        $this->session->set_flashdata('success', 'Data siswa berhasil diimport!');
    } else {
        $this->session->set_flashdata('error', 'File tidak ditemukan.');
    }

    redirect('data_siswa');
}

}