<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_revisi extends CI_Model {

    public function get_pelanggaran()
    {
        return $this->db->select('s.nisn, s.nama, s.kelas, s.wali_kelas, p.tanggal, p.keterangan, p.poin')
                        ->from('tb_pelanggaran p')
                        ->join('tb_siswa s', 's.nisn = p.nisn')
                        ->order_by('p.poin', 'DESC')  
                        ->order_by('s.kelas', 'ASC') 
                        ->get()->result_array();
    }

    public function get_kehadiran()
    {
        return $this->db->select('s.nisn, s.nama, s.kelas, s.wali_kelas, k.tanggal, k.keterangan')
                        ->from('tb_kehadiran k')
                        ->join('tb_siswa s', 's.nisn = k.nisn')
                        ->order_by('s.kelas', 'ASC')
                        ->order_by('k.tanggal', 'DESC')
                        ->get()->result_array();
    }

    public function simpan_revisi($data)
    {
        return $this->db->insert('tb_revisi', $data);
    }

    public function get_keterangan_revisi_batch($nisns)
    {
        $this->db->where_in('nisn', $nisns);
        $query = $this->db->get('tb_revisi');
        $result = $query->result_array();
    
        $map = [];
        foreach ($result as $row) {
            $map[$row['nisn']] = $row;
        }
        return $map;
    }
    

}
