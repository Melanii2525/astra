<?php
class M_siswa extends CI_Model
{
    public function ambildata($table)
    {
        return $this->db->get($table);
    }

    public function tambahdata($data, $table)
    {
        $this->db->insert($table, $data);
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

    public function get_all_ordered()
    {
        return $this->db->order_by('id', 'ASC')->get('data_siswa')->result();
    }        

    public function cari_siswa($keyword)
    {
        $this->db->like('nama_siswa', $keyword);
        return $this->db->get('data_siswa')->result_array();
    }

}