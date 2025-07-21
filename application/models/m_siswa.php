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
        $this->db->order_by("
            FIELD(kelas, 
                'X RPL A', 'X RPL B', 'X RPL C', 'X RPL D',
                'X TKJ A', 'X TKJ B', 'X TKJ C', 'X TKJ D',
                'X METRO A', 'X METRO B',
                'X ELIN A', 'X ELIN B',

                'XI RPL A', 'XI RPL B', 'XI RPL C', 'XI RPL D',
                'XI TKJ A', 'XI TKJ B', 'XI TKJ C', 'XI TKJ D',
                'XI METRO A', 'XI METRO B',
                'XI ELIN A', 'XI ELIN B',

                'XII RPL A', 'XII RPL B', 'XII RPL C', 'XII RPL D',
                'XII TKJ A', 'XII TKJ B', 'XII TKJ C', 'XII TKJ D',
                'XII METRO A', 'XII METRO B',
                'XII ELIN A', 'XII ELIN B'
            )", '', false);

        $this->db->order_by('nama', 'ASC'); 

        return $this->db->get('tb_siswa')->result();
    }

    public function cari_siswa($keyword)
    {
        $this->db->like('nama', $keyword);
        return $this->db->get('tb_siswa')->result_array();
    }

}