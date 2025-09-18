<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggaran extends CI_Model
{
    public function tampil_data($table)
    {
        return $this->db->get($table);
    }

    public function ambildata($table)
    {
        return $this->db->get($table);
    }

    public function tambahdata($data, $table)
    {
        return $this->db->insert($table, $data); 
    }

    public function ambilId($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    public function ubahdata($table, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function hapusdata($table, $where)
    {
        return $this->db->delete($table, $where);
    }

    public function total_pelanggaran_bulan_lalu()
    {
        $bulan_lalu = date('m', strtotime('-1 month'));
        $tahun_lalu = date('Y', strtotime('-1 month'));

        return $this->db->select('COUNT(DISTINCT nisn) as total')
            ->from('pelanggaran')
            ->where('MONTH(tanggal)', $bulan_lalu)
            ->where('YEAR(tanggal)', $tahun_lalu)
            ->get()
            ->row()
            ->total;
    }

    public function get_total_terlambat_hari_ini()
    {
        $today = date('Y-m-d');

        return $this->db->select('COUNT(DISTINCT nisn) as total')
            ->from('pelanggaran')
            ->like('kode', 'B-1', 'after') 
            ->where('DATE(tanggal)', $today) 
            ->get()
            ->row()
            ->total;
    }

    public function get_laporan_persiswa()
    {
        return $this->db->select('
                data_siswa.nisn,
                data_siswa.nama_siswa,
                data_siswa.kelas,
                data_siswa.wali_kelas,
                GROUP_CONCAT(CONCAT(DATE_FORMAT(pelanggaran.tanggal, "%d-%m-%Y"), " - ", pelanggaran.kode, " (", pelanggaran.poin, " poin)") SEPARATOR "<br>") as daftar_pelanggaran,
                SUM(pelanggaran.poin) as total_poin
            ')
            ->from('pelanggaran')
            ->join('data_siswa', 'pelanggaran.nisn = data_siswa.nisn')
            ->group_by('data_siswa.nisn')
            ->order_by('total_poin', 'DESC')
            ->get()
            ->result();
    }
}                                                              