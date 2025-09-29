<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 * @property CI_Session $session
 * @property M_revisi $M_revisi
 * @property M_siswa $m_siswa
 */

use Dompdf\Dompdf;
use Dompdf\Options;

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
        $data['revisi'] = $this->M_revisi->get_revisi();

        $siswa = [];

        // Pelanggaran
        foreach ($pelanggaran as $p) {
            $nisn = trim((string)$p['nisn']);
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

        // Kehadiran
        foreach ($kehadiran as $k) {
            $nisn = trim((string)$k['nisn']);
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
                'poin'  => (int)$k['poin']
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

        $nisns = array_column($data['revisi'], 'nisn');
        $ketMap = [];

        if (!empty($nisns)) {
            $ketMap = $this->M_revisi->get_keterangan_revisi_batch($nisns);
        }

        foreach ($data['revisi'] as &$row) {
            if (isset($ketMap[$row['nisn']])) {
                $row['treatment_count'] = $ketMap[$row['nisn']]['treatment_count'];
                $row['poin'] = $ketMap[$row['nisn']]['poin']; 
            } else {
                $row['treatment_count'] = 0;
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
    $treatment_checked = $this->input->post('treatment_checked'); 

    if ($revisi) {
        foreach ($revisi as $r) {
            $treatment_count = 0;

            $cek = $this->db->get_where('revisi', ['nisn' => $r['nisn']])->row();
            
            // Hitung total poin asli (sebelum dikurangi treatment)
            $total_poin_asli = $this->M_revisi->get_total_poin($r['nisn']);

            // Cek apakah sudah >= 250
            if (!empty($treatment_checked) && in_array($r['nisn'], $treatment_checked)) {
                if ($total_poin_asli < 250) {
                    // Boleh ditreatment
                    $treatment_count = ($cek && isset($cek->treatment_count)) ? $cek->treatment_count + 1 : 1;

                    $this->db->insert('treatment', [
                        'nisn'    => $r['nisn'],
                        'tanggal' => date('Y-m-d'), 
                        'poin'    => 30
                    ]);
                } else {
                    // Sudah 250 ke atas → tidak boleh treatment
                    $this->session->set_flashdata('error', 'Siswa ' . $r['nama_siswa'] . ' sudah mencapai 250 poin. Tidak bisa melakukan treatment.');
                    $treatment_count = ($cek && isset($cek->treatment_count)) ? $cek->treatment_count : 0;
                }
            } else {
                if ($cek && isset($cek->treatment_count)) {
                    $treatment_count = $cek->treatment_count;
                }
            }

            // Hitung ulang total poin setelah treatment (jika ada)
            $total_poin = $this->M_revisi->get_total_poin($r['nisn']);
            if ($total_poin < 0) $total_poin = 0;

            // Tentukan tindak lanjut
            $tindak_lanjut = '';
            if ($total_poin >= 0 && $total_poin <= 10) $tindak_lanjut = 'Pengarahan Tim Tatib';
            elseif ($total_poin >= 11 && $total_poin <= 35) $tindak_lanjut = 'Peringatan ke I (Petugas Ketertiban)';
            elseif ($total_poin >= 36 && $total_poin <= 55) $tindak_lanjut = 'Peringatan ke II (Koordinator Ketertiban)';
            elseif ($total_poin >= 56 && $total_poin <= 75) $tindak_lanjut = 'Panggilan Orang Tua ke I + Form Treatment';
            elseif ($total_poin >= 76 && $total_poin <= 100) $tindak_lanjut = 'Panggilan Orang Tua ke II + Surat Peringatan I';
            elseif ($total_poin >= 101 && $total_poin <= 150) $tindak_lanjut = 'Panggilan Orang Tua ke III + Surat Peringatan II';
            elseif ($total_poin >= 151 && $total_poin <= 200) $tindak_lanjut = 'Panggilan Orang Tua ke IV + Surat Peringatan III';
            elseif ($total_poin >= 201 && $total_poin <= 249) $tindak_lanjut = 'Skorsing (Waka Kesiswaan)';
            else $tindak_lanjut = 'Dikembalikan ke Orang Tua (Kepala Sekolah)';

            // Simpan revisi
            $this->M_revisi->simpan_revisi([
                'nisn'            => $r['nisn'],
                'nama_siswa'      => $r['nama_siswa'],
                'kelas'           => $r['kelas'],
                'wali_kelas'      => $r['wali_kelas'],
                'tanggal'         => $r['tanggal'],
                'jenis'           => $r['jenis_data'],
                'keterangan'      => $r['keterangan'],
                'poin'            => $total_poin, 
                'treatment_count' => $treatment_count,
                'tindak_lanjut'   => $tindak_lanjut 
            ]);
        }

        $this->session->set_flashdata('success', 'Rekap berhasil disimpan ke revisi.');
    }

    redirect('revisi');
}

    public function export_pdf()
    {
        $tindak = $this->input->get('tindak');
        $filter = ($tindak && $tindak != 'semua') ? $tindak : null;

        $data['revisi'] = $this->M_revisi->getLaporanRevisi(['tindak_lanjut' => $filter]);
        $data['filter_tindak_lanjut'] = $filter;

        $this->load->view('laporan_revisi/laporan_revisi_filter', $data);

        $dompdf = new Dompdf();
        $html = $this->load->view('laporan_revisi/laporan_revisi_filter', $data, true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_revisi.pdf', ["Attachment" => false]);
    }

    public function laporan_revisi_filter()
    {
        $filter = $this->input->get('tindak_lanjut');
        $data['revisi'] = $this->M_revisi->getLaporanRevisi($filter);
        $data['filter_tindak_lanjut'] = $filter;
        $this->load->view('laporan_revisi/laporan_revisi_filter', $data);
    }

    public function getLaporanRevisi($filter = null)
    {
        $this->db->select('nisn, nama_siswa, kelas, wali_kelas, tanggal, jenis, keterangan, poin, treatment_count, tindak_lanjut');
        $this->db->from('revisi');
        
        if (!empty($filter)) {
            $this->db->where('tindak_lanjut', $filter);
        }
        
        $this->db->order_by('kelas', 'ASC');
        return $this->db->get()->result();
    }

    public function search_siswa()
    {
        $keyword = $this->input->get('term'); 
        $result = $this->M_revisi->cari_siswa($keyword);

        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'label' => $row['nama_siswa'] . " — " . $row['kelas'], 
                'value' => $row['nama_siswa'],
                'nisn'  => $row['nisn']
            ];
        }

        echo json_encode($data);
    }

    public function export_pdf_per_siswa()
    {
        $nisn = $this->input->get('nisn');

        $siswa       = $this->m_siswa->get_by_nisn($nisn);
        $pelanggaran = $this->M_revisi->get_pelanggaran($nisn);
        $kehadiran   = $this->M_revisi->get_kehadiran($nisn);
        $treatment = $this->M_revisi->get_treatment($nisn);
        $lastRevisi = $this->M_revisi->get_last_revisi_poin($nisn);

        $total_poin      = $lastRevisi['poin'] ?? 0;
        $treatment_count = $lastRevisi['treatment_count'] ?? 0;

        $sortByDate = function($data){
            usort($data, function($a, $b){
                return strtotime($a['tanggal']) - strtotime($b['tanggal']);
            });
            return $data;
        };

        $pelanggaran = $sortByDate($pelanggaran);
        $kehadiran   = $sortByDate($kehadiran);
        $treatment   = $sortByDate($treatment);

        $formatTanggal = function($data){
            foreach($data as &$item){
                if(isset($item['tanggal'])){
                    $item['tanggal'] = date('d-m-Y', strtotime($item['tanggal']));
                }
            }
            return $data;
        };

        $pelanggaran = $formatTanggal($pelanggaran);
        $kehadiran   = $formatTanggal($kehadiran);
        $treatment   = $formatTanggal($treatment);

        $data = [
            'siswa'       => $siswa,
            'pelanggaran' => $pelanggaran,
            'kehadiran'   => $kehadiran,
            'treatment'   => $treatment,
            'total_poin'  => $total_poin,
            'treatment_count' => $treatment_count
        ];

        $html = $this->load->view('laporan_revisi/laporan_persiswa', $data, true);

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'Laporan_Revisi_'.$siswa['nama_siswa'].'.pdf';
        $dompdf->stream($filename, ["Attachment" => false]);
    }

    public function get_pelanggaran($nisn = null)
    {
        $this->db->select('p.*, s.nama_siswa, s.kelas, s.wali_kelas');
        $this->db->from('pelanggaran p');
        $this->db->join('siswa s', 's.nisn = p.nisn', 'left');
        
        if ($nisn) {
            $this->db->where('p.nisn', $nisn); 
        }
        
        return $this->db->get()->result_array();
    }

    public function get_kehadiran($nisn = null)
    {
        $this->db->select('k.*, s.nama_siswa, s.kelas, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('siswa s', 's.nisn = k.nisn', 'left');
        
        if ($nisn) {
            $this->db->where('k.nisn', $nisn); 
        }
        
        return $this->db->get()->result_array();
    }

    public function get_treatment($nisn = null)
    {
        $this->db->from('treatment');
        if ($nisn) {
            $this->db->where('nisn', $nisn); 
        }
        return $this->db->get()->result_array();
    }

    public function get_total_poin($nisn)
    {
        // Pelanggaran
        $pelanggaran = $this->db->select_sum('poin')
            ->where('nisn', $nisn)
            ->get('pelanggaran')
            ->row()->poin ?? 0;

        // Kehadiran
        $kehadiran = $this->db->select_sum('poin')
            ->where('nisn', $nisn)
            ->get('kehadiran')
            ->row()->poin ?? 0;

        $treatment_count = $this->db->where('nisn', $nisn)->count_all_results('treatment');
        $treatment_poin = $treatment_count * 30;

        return (int)$pelanggaran + (int)$kehadiran - (int)$treatment_poin;
    }
}