<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_revisi extends CI_Model
{
    // Ambil data pelanggaran siswa + join data siswa (bisa filter per nisn)
    public function get_pelanggaran($nisn = null)
    {
        $this->db->select('s.nisn, s.nama_siswa, s.kelas, s.wali_kelas, p.tanggal, p.keterangan, p.poin')
            ->from('pelanggaran p')
            ->join('data_siswa s', 's.nisn = p.nisn');

        if ($nisn !== null) {
            $this->db->where('s.nisn', $nisn); // filter per siswa
        }

        $this->db->order_by('p.tanggal', 'ASC');
        return $this->db->get()->result_array();
    }

    // Ambil data kehadiran siswa + join data siswa (bisa filter per nisn)
    public function get_kehadiran($nisn = null)
    {
        $this->db->select('s.nisn, s.nama_siswa, s.kelas, s.wali_kelas, k.tanggal, k.keterangan, k.poin')
            ->from('kehadiran k')
            ->join('data_siswa s', 's.nisn = k.nisn');

        if ($nisn !== null) {
            $this->db->where('s.nisn', $nisn); // filter per siswa
        }

        $this->db->order_by('k.tanggal', 'ASC');
        return $this->db->get()->result_array();
    }

    // Hitung total poin pelanggaran + kehadiran (bukan dari revisi)
    public function get_total_poin($nisn)
{
    // total pelanggaran
    $pelanggaran = $this->db->select_sum('poin')
        ->where('nisn', $nisn)
        ->get('pelanggaran')
        ->row()->poin ?? 0;

    // total kehadiran
    $kehadiran = $this->db->select_sum('poin')
        ->where('nisn', $nisn)
        ->get('kehadiran')
        ->row()->poin ?? 0;

    return (int)$pelanggaran + (int)$kehadiran;
}

    public function simpan_revisi($data)
    {
        $cek = $this->db->get_where('revisi', ['nisn' => $data['nisn']])->row();
        if ($cek) {
            $this->db->where('nisn', $data['nisn']);
            $this->db->update('revisi', $data);
        } else {
            $this->db->insert('revisi', $data);
        }
    }

    public function get_keterangan_revisi_batch($nisns)
    {
        $this->db->where_in('nisn', $nisns);
        $query = $this->db->get('revisi');
        $result = $query->result_array();

        $map = [];
        foreach ($result as $row) {
            $map[$row['nisn']] = $row;
        }
        return $map;
    }

    public function get_total_pelanggaran_bulan_lalu()
    {
        $bulan_lalu = date('m', strtotime('-1 month'));
        $tahun_lalu = date('Y', strtotime('-1 month'));

        return $this->db->where('MONTH(tanggal)', $bulan_lalu)
            ->where('YEAR(tanggal)', $tahun_lalu)
            ->count_all_results('pelanggaran');
    }

    public function get_total_siswa_treatment_tahun_ini()
    {
        $tahun_ini = date('Y');
        return $this->db->where('YEAR(tanggal)', $tahun_ini)
            ->where("treatment_count > 0") // ✅ diperbaiki
            ->count_all_results('revisi');
    }

    public function getAll()
    {
        $revisi = $this->db->select('r.*, s.nama_siswa, s.kelas, s.nisn, s.wali_kelas')
            ->from('revisi r')
            ->join('data_siswa s', 's.nisn = r.nisn', 'left')
            ->get()
            ->result_array();

        foreach ($revisi as &$item) {
            $poin = $item['poin'];
            if ($poin >= 0 && $poin <= 10) $item['tindak_lanjut'] = 'Pengarahan Tim Tatib';
            elseif ($poin >= 11 && $poin <= 35) $item['tindak_lanjut'] = 'Peringatan ke I (Petugas Ketertiban)';
            elseif ($poin >= 36 && $poin <= 55) $item['tindak_lanjut'] = 'Peringatan ke II (Koordinator Ketertiban)';
            elseif ($poin >= 56 && $poin <= 75) $item['tindak_lanjut'] = 'Panggilan Orang Tua ke I + Form Treatment';
            elseif ($poin >= 76 && $poin <= 100) $item['tindak_lanjut'] = 'Panggilan Orang Tua ke II + Surat Peringatan I';
            elseif ($poin >= 101 && $poin <= 150) $item['tindak_lanjut'] = 'Panggilan Orang Tua ke III + Surat Peringatan II';
            elseif ($poin >= 151 && $poin <= 200) $item['tindak_lanjut'] = 'Panggilan Orang Tua ke IV + Surat Peringatan III';
            elseif ($poin >= 201 && $poin <= 249) $item['tindak_lanjut'] = 'Skorsing (Waka Kesiswaan)';
            else $item['tindak_lanjut'] = 'Dikembalikan ke Orang Tua (Kepala Sekolah)';
        }

        return $revisi;
    }

    public function getByTindakLanjut($tindak)
    {
        $revisi = $this->db->select('r.*, s.nama_siswa, s.kelas, s.nisn, s.wali_kelas')
            ->from('revisi r')
            ->join('data_siswa s', 's.nisn = r.nisn', 'left')
            ->get()
            ->result_array();

        $filtered = [];
        foreach ($revisi as $item) {
            $poin = $item['poin'];
            $tl = '';

            if ($poin >= 0 && $poin <= 10) $tl = 'Pengarahan Tim Tatib';
            elseif ($poin >= 11 && $poin <= 35) $tl = 'Peringatan ke I (Petugas Ketertiban)';
            elseif ($poin >= 36 && $poin <= 55) $tl = 'Peringatan ke II (Koordinator Ketertiban)';
            elseif ($poin >= 56 && $poin <= 75) $tl = 'Panggilan Orang Tua ke I + Form Treatment';
            elseif ($poin >= 76 && $poin <= 100) $tl = 'Panggilan Orang Tua ke II + Surat Peringatan I';
            elseif ($poin >= 101 && $poin <= 150) $tl = 'Panggilan Orang Tua ke III + Surat Peringatan II';
            elseif ($poin >= 151 && $poin <= 200) $tl = 'Panggilan Orang Tua ke IV + Surat Peringatan III';
            elseif ($poin >= 201 && $poin <= 249) $tl = 'Skorsing (Waka Kesiswaan)';
            else $tl = 'Dikembalikan ke Orang Tua (Kepala Sekolah)';

            if ($tl == $tindak) $filtered[] = $item;
        }

        return $filtered;
    }

    public function getLaporanRevisi($filter = [])
    {
        $this->db->select('r.*, s.nama_siswa, s.kelas, s.nisn, s.wali_kelas')
            ->from('revisi r')
            ->join('data_siswa s', 's.nisn = r.nisn', 'left');

        if (!empty($filter['tindak_lanjut'])) {
            $this->db->where('r.tindak_lanjut', $filter['tindak_lanjut']);
        }

        return $this->db->get()->result_array();
    }

    public function cari_siswa($keyword)
    {
        return $this->db->select('nisn, nama_siswa, kelas')
            ->from('data_siswa')
            ->like('nama_siswa', $keyword)
            ->limit(10)
            ->get()
            ->result_array();
    }

    public function get_treatment($nisn)
    {
        return $this->db->select('tanggal, tindak_lanjut')
            ->from('revisi')
            ->where('nisn', $nisn)
            ->get()
            ->result_array();
    }

    // Ranking siswa berdasarkan poin di tabel revisi
    public function get_ranking_siswa($limit = 5)
    {
        return $this->db->select('r.nisn, s.nama_siswa, s.kelas, s.wali_kelas, r.poin')
            ->from('revisi r')
            ->join('data_siswa s', 's.nisn = r.nisn', 'left')
            ->order_by('r.poin', 'DESC')
            ->limit($limit)
            ->get()
            ->result_array();
    }

    public function get_last_revisi_poin($nisn)
{
    $this->db->select('poin, treatment_count');
    $this->db->from('revisi');
    $this->db->where('nisn', $nisn);
    $this->db->order_by('id', 'DESC'); // ambil revisi terakhir
    $this->db->limit(1);
    return $this->db->get()->row_array();
}

}