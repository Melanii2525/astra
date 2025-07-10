<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property m_kehadiran $m
 * @property m_kehadiran $m_kehadiran
 * @property m_siswa $m_siswa
 * @property CI_Input $input
 * @property CI_Upload $upload
 * @property CI_Output $output
 * @property Dompdf_gen $dompdf_gen
 * @property CI_DB_query_builder $db
 */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kehadiran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_kehadiran', 'm');
        $this->load->helper(['form', 'url']);
    }

    public function index(){
        $this->load->model('m_siswa'); 
    
        $data['title'] = "Data Kehadiran";
        $data['siswa'] = $this->m_siswa->get_all_ordered(); 
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('kehadiran', $data); 
        $this->load->view('templates/footer');
    }    

    public function ambildata()
    {
        $data = $this->m->ambildata('tb_kehadiran')->result();
        echo json_encode($data);
    }

    public function tambahdata()
    {
        $nisn = $this->input->post('nisn');
        $waktu = $this->input->post('waktu');
        $nama = $this->input->post('nama');
        $kelas = $this->input->post('kelas');
        $wali_kelas = $this->input->post('wali_kelas');
        $keterangan = $this->input->post('keterangan'); 

        if (empty($waktu) || empty($nama) || empty($nisn) || empty($kelas) || empty($keterangan) || empty($wali_kelas)) {
            $result = [
                'status' => false,
                'pesan' => 'Semua kolom wajib diisi!'
            ];
        } else {
            $data = [
                'nisn' => $nisn,
                'waktu' => $waktu,
                'nama' => $nama,
                'kelas' => $kelas,
                'wali_kelas' => $wali_kelas,
                'keterangan' => $keterangan
            ];
            $this->m->tambahdata($data, 'tb_kehadiran');

            $result = [
                'status' => true,
                'pesan' => ''
            ];
        }

        echo json_encode($result);
    }

    public function ambilId()
    {
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $data = $this->m->ambilId('tb_kehadiran', $where)->result();
        echo json_encode($data);
    }

    public function ubahdata()
    {
        $data = [
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'waktu' => $this->input->post('waktu'),
            'kelas' => $this->input->post('kelas'),
            'wali_kelas' => $this->input->post('wali_kelas'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $id = $this->input->post('id');

        $this->load->model('m_kehadiran');
        $this->m_kehadiran->ubahdata($data, ['id' => $id], 'tb_kehadiran');

        echo json_encode(['pesan' => '']);
    }

    public function detail($id)
    {
        $this->db->select('k.*, s.jk AS jenis_kelamin');
        $this->db->from('tb_kehadiran k');
        $this->db->join('tb_siswa s', 'k.nisn = s.nisn', 'left');
        $this->db->where('k.id', $id);
        $row = $this->db->get()->row();

        if (!$row) {
            show_404();
        }

        $data['title'] = 'Detail Kehadiran';
        $data['data'] = $row;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('detail_kehadiran', $data); // pastikan nama file view ini benar
        $this->load->view('templates/footer');
    }

    // public function print(){
    //     $data['kehadiran'] = $this->m_kehadiran->tampil_data("tb_kehadiran")->result();
    //     $this->load->view('print_kehadiran', $data);
    // }

    public function export_pdf()
    {
        $this->load->library('dompdf_gen');
        $this->db->select('k.*, s.nama, s.kelas, s.jk as jenis_kelamin, s.wali_kelas');
        $this->db->from('tb_kehadiran k');
        $this->db->join('tb_siswa s', 'k.nisn = s.nisn', 'left');
        $data['kehadiran'] = $this->db->get()->result();

        $this->load->view('laporan_kehadiran/laporan_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf_gen->dompdf->setPaper($paper_size, $orientation);
        $this->dompdf_gen->dompdf->loadHtml($html);
        $this->dompdf_gen->dompdf->render();
        $this->dompdf_gen->dompdf->stream("laporan_kehadiran.pdf", array("Attachment" => 0));
    }

    public function excel()
    {
        $this->load->model('m_kehadiran');
        $this->db->select('k.*, s.nama, s.kelas, s.jk as jenis_kelamin, s.wali_kelas');
        $this->db->from('tb_kehadiran k');
        $this->db->join('tb_siswa s', 'k.nisn = s.nisn', 'left');
        $data['kehadiran'] = $this->db->get()->result();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NISN');
        $sheet->setCellValue('C1', 'TANGGAL');
        $sheet->setCellValue('D1', 'NAMA');
        $sheet->setCellValue('E1', 'JENIS KELAMIN');
        $sheet->setCellValue('F1', 'KELAS');
        $sheet->setCellValue('G1', 'WALI KELAS');
        $sheet->setCellValue('H1', 'KETERANGAN');

        $row = 2;
        $no = 1;
        foreach ($data['kehadiran'] as $k) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $k->nisn);
            $sheet->setCellValue('C'.$row, $k->waktu);
            $sheet->setCellValue('D'.$row, $k->nama);
            $sheet->setCellValue('E'.$row, $k->jenis_kelamin == 'L' ? 'Laki-laki' : ($k->jenis_kelamin == 'P' ? 'Perempuan' : '-'));
            $sheet->setCellValue('F'.$row, $k->kelas);
            $sheet->setCellValue('G'.$row, $k->wali_kelas);
            $sheet->setCellValue('H'.$row, $k->keterangan);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data_Kehadiran.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    // public function search(){
    //     $keyword = $this->input->post('keyword');
    //     $data['kehadiran']=$this->m_kehadiran->get_keyword($keyword);

    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('kehadiran', $data);
    //     $this->load->view('templates/footer');
    // }
}