<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kehadiran extends CI_Model
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

    public function ubahdata($data, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapusdata($table, $where)
    {
        return $this->db->delete($table, $where);
    }
}
