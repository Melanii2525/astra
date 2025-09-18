<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_siswa extends CI_Model
{
    public function get_siswa_paginated($limit, $offset)
    {
        return $this->db->order_by('id', 'ASC')
            ->limit($limit, $offset)
            ->get('data_siswa')
            ->result();
    }

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

    public function search_siswa($keyword, $limit = null, $offset = null)
    {
        $this->db->from('data_siswa');
        $this->db->group_start();
        $this->db->like('nisn', $keyword);
        $this->db->or_like('nipd', $keyword);
        $this->db->or_like('nama_siswa', $keyword);
        $this->db->or_like('kelas', $keyword);
        $this->db->or_like('wali_kelas', $keyword);
        $this->db->or_like('jenis_kelamin', $keyword);
        $this->db->group_end();

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result();
    }

    public function get_by_nisn($nisn)
    {
        return $this->db->get_where('data_siswa', ['nisn' => $nisn])->row_array();
    }
}