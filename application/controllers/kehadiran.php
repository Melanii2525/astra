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
        $data = $this->m->ambildata()->result(); // ambil dari model yang JOIN
        echo json_encode($data);
    }       

    public function tambahdata()
    {
        $data = [
            'nisn' => $this->input->post('nisn'),
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan'), 
            'poin' => $this->input->post('poin')
        ];        
    
        $this->m->tambahdata($data, 'kehadiran'); 
        echo json_encode(['pesan' => '']);
    }      

    public function tambah()
    {
        $this->load->model('m_kehadiran');
        $this->load->model('m_siswa');

        $data['siswa'] = $this->m_siswa->get_all();
        $data['title'] = 'Tambah Data Kehadiran';

        if ($this->input->post()) {
            $nis = $this->input->post('nis');
            $tanggal = $this->input->post('tanggal');
            $keterangan = strtoupper($this->input->post('keterangan'));

            // Validasi: hanya boleh huruf A
            if ($keterangan !== 'A') {
                $this->session->set_flashdata('error', 'Keterangan hanya boleh huruf A.');
                redirect('kehadiran/tambah');
            }

            $poin = 7;

            $data_insert = [
                'nis' => $nis,
                'tanggal' => $tanggal,
                'keterangan' => $keterangan,
                'poin' => $poin
            ];

            $this->m_kehadiran->insert($data_insert);
            $this->session->set_flashdata('success', 'Data kehadiran berhasil disimpan.');
            redirect('kehadiran');
        }

        $this->load->view('template/header', $data);
        $this->load->view('kehadiran/tambah', $data);
        $this->load->view('template/footer');
    }

    public function ambilId()
    {
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $data = $this->m->ambilId('kehadiran', $where)->result();
        echo json_encode($data);
    }

    public function hapusdata()
    {
        $id = $this->input->post('id');
        $where = ['id' => $id];
    
        $this->load->model('m_kehadiran');
        $hapus = $this->m_kehadiran->hapusdata('kehadiran', $where);
    
        if ($hapus) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }    

    public function detail($id)
    {
        $this->db->select('k.*, s.jenis_kelamin, s.nama_siswa, s.kelas, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
        $this->db->where('k.id', $id);
        $row = $this->db->get()->row();
    
        if (!$row) {
            show_404();
        }
    
        $data['title'] = 'Detail Kehadiran';
        $data['data'] = $row;
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('detail_kehadiran', $data);
        $this->load->view('templates/footer');
    }    

    // public function print(){
    //     $data['kehadiran'] = $this->m_kehadiran->tampil_data("kehadiran")->result();
    //     $this->load->view('print_kehadiran', $data);
    // }

    public function export_pdf()
    {
        $this->load->library('dompdf_gen');
        $this->db->select('k.*, s.nama_siswa, s.kelas, s.jenis_kelamin, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
        $this->db->order_by('k.tanggal', 'ASC'); // tambahkan baris ini
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
        $this->db->select('k.*, s.nama_siswa, s.kelas, s.jenis_kelamin, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
        $this->db->order_by('k.tanggal', 'ASC'); // tambahkan baris ini
        $data['kehadiran'] = $this->db->get()->result();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // header kolom
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NISN');
        $sheet->setCellValue('C1', 'TANGGAL');
        $sheet->setCellValue('D1', 'NAMA');
        $sheet->setCellValue('E1', 'JENIS KELAMIN');
        $sheet->setCellValue('F1', 'KELAS');
        $sheet->setCellValue('G1', 'WALI KELAS');
        $sheet->setCellValue('H1', 'KETERANGAN');
        $sheet->setCellValue('I1', 'POIN');

        $row = 2;
        $no = 1;
        foreach ($data['kehadiran'] as $k) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $k->nisn);
            $sheet->setCellValue('C'.$row, date('d-m-Y', strtotime($k->tanggal)));
            $sheet->setCellValue('D'.$row, $k->nama_siswa);
            $sheet->setCellValue('E'.$row, $k->jenis_kelamin == 'L' ? 'Laki-laki' : ($k->jenis_kelamin == 'P' ? 'Perempuan' : '-'));
            $sheet->setCellValue('F'.$row, $k->kelas);
            $sheet->setCellValue('G'.$row, $k->wali_kelas);
            $sheet->setCellValue('H'.$row, $k->keterangan);
            $sheet->setCellValue('I'.$row, $k->poin);
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