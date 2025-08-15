<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 * @property CI_Session $session
 * @property M_revisi $M_revisi
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

        $nisns = array_column($data['revisi'], 'nisn');
        $ketMap = [];

        if (!empty($nisns)) {
            $ketMap = $this->M_revisi->get_keterangan_revisi_batch($nisns);
        }

        foreach ($data['revisi'] as &$row) {
            if (isset($ketMap[$row['nisn']])) {
                $row['treatment_count'] = $ketMap[$row['nisn']]['treatment_count'];
                $row['poin'] = $ketMap[$row['nisn']]['poin']; // ✅ update poin dari revisi terakhir
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

    //	Digunakan saat form revisi disubmit.
    public function simpan()
{
    $revisi = $this->input->post('revisi');
    $treatment_checked = $this->input->post('treatment_checked'); // ✅ array NISN

    if ($revisi) {
        foreach ($revisi as $r) {
            $treatment_count = 0;

            // Cek apakah siswa ini di-ceklist treatment
            if (!empty($treatment_checked) && in_array($r['nisn'], $treatment_checked)) {
                $cek = $this->db->get_where('revisi', ['nisn' => $r['nisn']])->row();
                $treatment_count = ($cek && isset($cek->treatment_count)) ? $cek->treatment_count + 1 : 1;
            } else {
                // Ambil treatment_count lama jika ada
                $cek = $this->db->get_where('revisi', ['nisn' => $r['nisn']])->row();
                if ($cek && isset($cek->treatment_count)) {
                    $treatment_count = $cek->treatment_count;
                }
            }

            // Hitung tindak lanjut berdasarkan poin
            $tindak_lanjut = '';
            if ($r['poin'] >= 0 && $r['poin'] <= 10) $tindak_lanjut = 'Pengarahan Tim Tatib';
            elseif ($r['poin'] >= 11 && $r['poin'] <= 35) $tindak_lanjut = 'Peringatan ke I (Petugas Ketertiban)';
            elseif ($r['poin'] >= 36 && $r['poin'] <= 55) $tindak_lanjut = 'Peringatan ke II (Koordinator Ketertiban)';
            elseif ($r['poin'] >= 56 && $r['poin'] <= 75) $tindak_lanjut = 'Panggilan Orang Tua ke I + Form Treatment';
            elseif ($r['poin'] >= 76 && $r['poin'] <= 100) $tindak_lanjut = 'Panggilan Orang Tua ke II + Surat Peringatan I';
            elseif ($r['poin'] >= 101 && $r['poin'] <= 150) $tindak_lanjut = 'Panggilan Orang Tua ke III + Surat Peringatan II';
            elseif ($r['poin'] >= 151 && $r['poin'] <= 200) $tindak_lanjut = 'Panggilan Orang Tua ke IV + Surat Peringatan III';
            elseif ($r['poin'] >= 201 && $r['poin'] <= 249) $tindak_lanjut = 'Skorsing (Waka Kesiswaan)';
            else $tindak_lanjut = 'Dikembalikan ke Orang Tua (Kepala Sekolah)';

            // Simpan ke database
            $this->M_revisi->simpan_revisi([
                'nisn'            => $r['nisn'],
                'nama_siswa'      => $r['nama_siswa'],
                'kelas'           => $r['kelas'],
                'wali_kelas'      => $r['wali_kelas'],
                'tanggal'         => $r['tanggal'],
                'jenis'           => $r['jenis_data'],
                'keterangan'      => $r['keterangan'],
                'poin'            => $r['poin'],
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
    $tindak = $this->input->get('tindak'); // ambil filter
    $filter = ($tindak && $tindak != 'semua') ? $tindak : null;

    $data['revisi'] = $this->M_revisi->getLaporanRevisi(['tindak_lanjut' => $filter]);
    $data['filter_tindak_lanjut'] = $filter;

    $this->load->view('laporan_revisi/laporan_revisi_filter', $data);
    
    // atau pakai Dompdf
    $dompdf = new Dompdf();
    $html = $this->load->view('laporan_revisi/laporan_revisi_filter', $data, true);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('laporan_revisi.pdf', ["Attachment" => false]); // false = tampil di browser
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

}