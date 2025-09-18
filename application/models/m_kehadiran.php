<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kehadiran extends CI_Model
{
    public function ambildata()
    {
        $this->db->select('k.*, s.nama_siswa, s.kelas, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
        return $this->db->get();
    }

    public function tambahdata($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function ambilId($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function hapusdata($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function get_total_alpha_bulan_lalu()
    {
        $bulan_lalu = date('m', strtotime('-1 month'));
        $tahun_lalu = date('Y', strtotime('-1 month'));

        $this->db->from('kehadiran');
        $this->db->where('keterangan', 'A');
        $this->db->where('MONTH(tanggal)', $bulan_lalu);
        $this->db->where('YEAR(tanggal)', $tahun_lalu);

        return $this->db->count_all_results();
    }

    public function get_laporan_persiswa()
    {
        return $this->db->select('
                data_siswa.nisn,
                data_siswa.nama_siswa,
                data_siswa.kelas,
                data_siswa.wali_kelas,
                GROUP_CONCAT(CONCAT(DATE_FORMAT(kehadiran.tanggal, "%d-%m-%Y"), " - ", kehadiran.kode, " (", kehadiran.poin, " poin)") SEPARATOR "<br>") as daftar_kehadiran,
                SUM(kehadiran.poin) as total_poin
            ')
            ->from('kehadiran')
            ->join('data_siswa', 'kehadiran.nisn = data_siswa.nisn')
            ->group_by('data_siswa.nisn')
            ->order_by('total_poin', 'DESC')
            ->get()
            ->result();
    }

    public function search_data($keyword)
    {
        $this->db->select('k.*, s.nama_siswa, s.kelas, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
    
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('s.nama_siswa', $keyword);
            $this->db->or_like('s.kelas', $keyword);
            $this->db->or_like('s.wali_kelas', $keyword);
            $this->db->or_like('k.keterangan', $keyword);
            $this->db->or_like('k.nisn', $keyword);
            $this->db->or_like('k.tanggal', $keyword);
            $this->db->or_like('k.poin', $keyword);
            $this->db->group_end();
        }
    
        return $this->db->get();
    }
}