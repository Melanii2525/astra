<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_revisi extends CI_Model
{
    //Ambil data pelanggaran siswa + join data siswa.
    public function get_pelanggaran()
    {
        return $this->db->select('s.nisn, s.nama_siswa, s.kelas, s.wali_kelas, p.tanggal, p.keterangan, p.poin')
            ->from('pelanggaran p')
            ->join('data_siswa s', 's.nisn = p.nisn')
            ->order_by('p.poin', 'DESC')
            ->order_by('s.kelas', 'ASC')
            ->get()->result_array();
    }

    //	Ambil data kehadiran siswa + join data siswa.
    public function get_kehadiran()
    {
        return $this->db->select('s.nisn, s.nama_siswa, s.kelas, s.wali_kelas, k.tanggal, k.keterangan, k.poin')
            ->from('kehadiran k')
            ->join('data_siswa s', 's.nisn = k.nisn')
            ->order_by('s.kelas', 'ASC')
            ->order_by('k.tanggal', 'DESC')
            ->get()->result_array();
    }

    //Simpan/update data revisi ke tabel revisi.
    public function simpan_revisi($data)
    {
        $cek = $this->db->get_where('revisi', ['nisn' => $data['nisn']])->row();

        if ($cek) {
            $this->db->where('nisn', $data['nisn'])->update('revisi', $data);
        } else {
            $this->db->insert('revisi', $data);
        }
    }

    //Ambil data revisi berdasarkan daftar NISN.
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
            ->where('treatment_count >', 0)
            ->count_all_results('revisi');
    }

    public function getAll() {
        $revisi = $this->db->select('r.*, s.nama_siswa, s.kelas, s.nisn, s.wali_kelas')
                           ->from('revisi r')
                           ->join('data_siswa s', 's.nisn = r.nisn', 'left')
                           ->get()
                           ->result_array();
    
        // Tambahkan kolom tindak_lanjut hasil perhitungan
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

    // Ambil data berdasarkan tindak lanjut
    public function getByTindakLanjut($tindak) {
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
    
    // M_revisi.php
public function getLaporanRevisi($filter = null)
{
    $this->db->select('r.*, s.nama_siswa, s.kelas, s.nisn, s.wali_kelas');
    $this->db->from('revisi r');
    $this->db->join('data_siswa s', 's.nisn = r.nisn', 'left');

    if (!empty($filter) && $filter != 'all') {
        $this->db->where('r.tindak_lanjut', $filter);
    }

    $this->db->order_by('s.kelas', 'ASC');
    return $this->db->get()->result_array();
}

}