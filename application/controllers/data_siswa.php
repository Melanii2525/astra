<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('data_siswa', $data);
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
        $nama   = $this->input->post('nama');
        $kelas  = $this->input->post('kelas');
        $jk     = $this->input->post('jk');
        $wali_kelas = $this->input->post('wali_kelas');

        if ($nisn == '' || $nipd == '' || $nama == '' || $kelas == '' || $jk == '') {
            $result['pesan'] = 'Semua field wajib diisi.';
        } else {
            $result['pesan'] = '';
            $data = [
                'nisn'  => $nisn,
                'nipd'  => $nipd,
                'nama'  => $nama,
                'kelas' => $kelas,
                'jk'    => $jk,
                'wali_kelas'  => $wali_kelas
            ];

            $this->m->tambahdata($data, 'tb_siswa');
        }

        echo json_encode($result);
    }

    public function ambilId()
    {
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $data = $this->m->ambilId('tb_siswa', $where)->result();
        echo json_encode($data);
    }

    public function ubahdata()
    {
        $id = $this->input->post('id');

        $data = [
            'nisn'  => $this->input->post('nisn'),
            'nipd'  => $this->input->post('nipd'),
            'nama'  => $this->input->post('nama'),
            'kelas' => $this->input->post('kelas'),
            'jk'    => $this->input->post('jk'),
            'wali_kelas' => $this->input->post('wali_kelas')
        ];

        $where = ['id' => $id];
        $this->m->ubahdata('tb_siswa', $data, $where);

        echo json_encode(['pesan' => '']); 
    }

    public function get_detail_siswa()
    {
        $nisn = $this->input->post('nisn');
        $data = $this->db->get_where('tb_siswa', ['nisn' => $nisn])->row();
        echo json_encode($data);
    }

    public function simpan_wali()
    {
        $tingkat = $this->input->post('kelas'); // X / XI / XII
        $wali = $this->input->post('wali');

        $this->db->like('kelas', $tingkat, 'after'); // contoh: kelas LIKE 'X%'
        $this->db->update('tb_siswa', ['walikelas' => $wali]);

        echo json_encode(['status' => 'ok']);
    }

    public function filterByKelas()
    {
        $kelas = $this->input->post('kelas');

        if ($kelas === '') {
            // Semua data
            $data = $this->db->get('tb_siswa')->result();
        } else {
            $this->db->where('kelas', $kelas);
            $data = $this->db->get('tb_siswa')->result();
        }

        echo json_encode($data);
    }

    public function search()
    {
        $query = $this->input->post('query');
        $hasil = $this->m->cari_siswa($query); 

        foreach ($hasil as $siswa) {
            echo '<div class="suggestion-item list-group-item"
            data-nama="' . strtoupper($siswa->nama) . '" 
            data-kelas="' . $siswa->kelas . '" 
            data-walikelas="' . $siswa->walikelas . '">' .
                ($siswa->nama) . ' - ' . $siswa->kelas .
                '</div>';
        }
    }

    public function hapusdata()
{
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    $hapus = $this->db->delete('tb_siswa'); // sesuaikan dengan nama tabel

    if ($hapus) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'failed']);
    }
}

}