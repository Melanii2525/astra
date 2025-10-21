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
        $query = $this->db->select('
                data_siswa.nisn,
                data_siswa.nama_siswa,
                data_siswa.kelas,
                data_siswa.wali_kelas,
                pelanggaran.tanggal,
                pelanggaran.kode,
                pelanggaran.poin
            ')
            ->from('pelanggaran')
            ->join('data_siswa', 'pelanggaran.nisn = data_siswa.nisn')
            ->order_by('data_siswa.nisn, pelanggaran.tanggal', 'ASC')
            ->get();

        $result = $query->result_array();
        $laporan = [];

        foreach ($result as $row) {
            $nisn = $row['nisn'];
            if (!isset($laporan[$nisn])) {
                $laporan[$nisn] = [
                    'nisn' => $row['nisn'],
                    'nama_siswa' => $row['nama_siswa'],
                    'kelas' => $row['kelas'],
                    'wali_kelas' => $row['wali_kelas'],
                    'daftar_pelanggaran' => [],
                    'total_poin' => 0
                ];
            }

            $laporan[$nisn]['daftar_pelanggaran'][] =
                date('d-m-Y', strtotime($row['tanggal'])) .
                " - " . $row['kode'] .
                " (" . $row['poin'] . " poin)";

            $laporan[$nisn]['total_poin'] += $row['poin'];
        }
        
        return array_values($laporan);
    }
}                                                              