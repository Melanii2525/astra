<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 * @property CI_Session $session
 * @property M_revisi $M_revisi
*/

class Revisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('M_revisi');
    }

    public function index()
    {
        $pelanggaran = $this->M_revisi->get_pelanggaran();
        $kehadiran = $this->M_revisi->get_kehadiran();

        $siswa = [];

        // Proses pelanggaran
        foreach ($pelanggaran as $p) {
            $nisn = $p['nisn'];
            if (!isset($siswa[$nisn])) {
                $siswa[$nisn] = [
                    'nisn' => $p['nisn'],
                    'nama_siswa' => $p['nama_siswa'],
                    'kelas' => $p['kelas'],
                    'wali_kelas' => $p['wali_kelas'],
                    'poin' => 0,
                    'keterangan' => [],
                    'tanggal' => [],
                    'jenis_data' => [],
                    'pelanggaran' => [],
                    'kehadiran' => []
                ];
            }

            $siswa[$nisn]['poin'] += (int)$p['poin'];
            $siswa[$nisn]['keterangan'][] = $p['keterangan'];
            $siswa[$nisn]['tanggal'][] = $p['tanggal'];
            $siswa[$nisn]['jenis_data'][] = 'pelanggaran';

            $siswa[$nisn]['pelanggaran'][] = [
                'jenis' => $p['keterangan'],
                'poin' => (int)$p['poin']
            ];
        }

        // Proses kehadiran
        foreach ($kehadiran as $k) {
            $nisn = $k['nisn'];
            if (!isset($siswa[$nisn])) {
                $siswa[$nisn] = [
                    'nisn' => $k['nisn'],
                    'nama_siswa' => $k['nama_siswa'],
                    'kelas' => $k['kelas'],
                    'wali_kelas' => $k['wali_kelas'],
                    'poin' => 0,
                    'keterangan' => [],
                    'tanggal' => [],
                    'jenis_data' => [],
                    'pelanggaran' => [],
                    'kehadiran' => []
                ];
            }

            $siswa[$nisn]['poin'] += (int)$k['poin'];
            $siswa[$nisn]['keterangan'][] = $k['keterangan'];
            $siswa[$nisn]['tanggal'][] = $k['tanggal'];
            $siswa[$nisn]['jenis_data'][] = 'kehadiran';

            $siswa[$nisn]['kehadiran'][] = [
                'jenis' => $k['keterangan'] ?? 'Alpha',
                'poin' => 7
            ];
        }

        $data['revisi'] = [];
        foreach ($siswa as $item) {
            if ($item['poin'] >= 10) {
                $data['revisi'][] = [
                    'nisn' => $item['nisn'],
                    'nama_siswa' => $item['nama_siswa'],
                    'kelas' => $item['kelas'],
                    'wali_kelas' => $item['wali_kelas'],
                    'tanggal' => end($item['tanggal']),
                    'keterangan' => implode('; ', $item['keterangan']),
                    'jenis_data' => implode(', ', array_unique($item['jenis_data'])),
                    'poin' => $item['poin'],
                    'pelanggaran' => $item['pelanggaran'],
                    'kehadiran' => $item['kehadiran']
                ];
            }
        }

        // echo '<pre>';
        // print_r($data['revisi']);  // pastikan poin pelanggaran dan kehadiran sudah terisi
        // exit;

        $nisns = array_column($data['revisi'], 'nisn');
        $ketMap = [];

        if (!empty($nisns)) {
            $ketMap = $this->M_revisi->get_keterangan_revisi_batch($nisns);
        }

        foreach ($data['revisi'] as &$row) {
            if (isset($ketMap[$row['nisn']])) {
                if (isset($ketMap[$row['nisn']]['keterangan'])) {
                    $row['keterangan'] = $ketMap[$row['nisn']]['keterangan'];
                }
                if (isset($ketMap[$row['nisn']]['poin'])) {
                    $row['poin'] = $ketMap[$row['nisn']]['poin'];
                }
            }
        }
        unset($row);   

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('revisi', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $revisi = $this->input->post('revisi');

        if ($revisi) {
            foreach ($revisi as $r) {
                log_message('debug', 'REVISI POSTED: ' . json_encode($r));
                $this->M_revisi->simpan_revisi([
                    'nisn'       => $r['nisn'],
                    'nama_siswa' => $r['nama_siswa'],
                    'kelas'      => $r['kelas'],
                    'wali_kelas' => $r['wali_kelas'],
                    'tanggal'    => $r['tanggal'],
                    'jenis'      => $r['jenis_data'],
                    'keterangan' => $r['keterangan'],
                    'poin'       => $r['poin'], 
                ]);
            }
            $this->session->set_flashdata('success', 'Rekap berhasil disimpan ke revisi.');
        }

        redirect('revisi');
    }

    public function update()
    {
        $nisn       = $this->input->post('nisn');
        $keterangan = $this->input->post('keterangan');
        $poin       = $this->input->post('poin');

        $cek = $this->db->get_where('revisi', ['nisn' => $nisn])->row();

        $data = [
            'keterangan' => $keterangan,
            'poin'       => $poin,
            'nama_siswa'       => $this->input->post('nama_siswa'),
            'kelas'      => $this->input->post('kelas'),
            'wali_kelas' => $this->input->post('wali_kelas'),
            'tanggal'    => date('Y-m-d'),
            'jenis'      => 'manual'
        ];

        if ($cek) {
            $this->db->where('nisn', $nisn)->update('revisi', $data);
            $msg = 'Data berhasil diperbarui.';
        } else {
            $this->db->insert('revisi', $data);
            $msg = 'Data baru berhasil disimpan.';
        }

        $this->session->set_flashdata('success', $msg);
        redirect('revisi');
    }
}