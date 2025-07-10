<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property m_pelanggaran $m
 * @property CI_Input $input
 * @property m_pelanggaran $m_pelanggaran
 * @property m_siswa $m_siswa
 * @property CI_Upload $upload
 * @property CI_Output $output
 * @property Dompdf_gen $dompdf_gen
 * @property CI_DB_query_builder $db
 */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pelanggaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_pelanggaran', 'm');
        $this->load->helper(['form', 'url']);
    }

    public function index(){
        $this->load->model('m_siswa'); 
        $data['title'] = "Data Pelanggaran";
        $data['siswa'] = $this->m_siswa->ambildata('tb_siswa')->result(); 
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pelanggaran', $data);
        $this->load->view('templates/footer');
    }    

    public function ambildata()
    {
        $data = $this->m->ambildata('tb_pelanggaran')->result();
        echo json_encode($data);
    }

    public function tambahdata()
    {
        $data = [
            'waktu' => $this->input->post('waktu'),
            'nama' => strtoupper(trim($this->input->post('nama'))),
            'nisn' => $this->input->post('nisn'),
            'kelas' => strtoupper(trim($this->input->post('kelas'))),
            'wali_kelas' => $this->input->post('wali_kelas'),
            'kode' => strtoupper(trim($this->input->post('kode'))),
            'keterangan' => $this->input->post('keterangan'), 
            'poin' => $this->input->post('poin'),             
        ];

        $sukses = $this->m->tambahdata($data, 'tb_pelanggaran');

        echo json_encode([
            'pesan' => $sukses ? '' : 'Gagal menyimpan data'
        ]);
    }

    public function ambilId()
    {
        $id = $this->input->post('id');
        $where = ['id' => $id];
        $data = $this->m->ambilId('tb_pelanggaran', $where)->result();
        echo json_encode($data);
    }

    public function ubahdata()
    {
        $id = $this->input->post('id');
        $data = [
            'waktu' => $this->input->post('waktu'),
            'nama' => strtoupper(trim($this->input->post('nama'))),
            'kelas' => strtoupper(trim($this->input->post('kelas'))),
            'kode' => strtoupper(trim($this->input->post('kode'))),
            'keterangan' => $this->input->post('keterangan'),
            'poin' => $this->input->post('poin'),
        ];
        $where = ['id' => $id];
        $sukses = $this->m->ubahdata('tb_pelanggaran', $data, $where);

        echo json_encode([
            'pesan' => $sukses ? '' : 'Gagal mengubah data'
        ]);
    }

    public function detail($id)
    {
        $this->db->select('p.*, s.jk AS jenis_kelamin');
        $this->db->from('tb_pelanggaran p');
        $this->db->join('tb_siswa s', 'p.nisn = s.nisn', 'left');
        $this->db->where('p.id', $id);
        $row = $this->db->get()->row();

        if (!$row) {
            show_404();
        }

        $data['title'] = 'Detail Pelanggaran';
        $data['data'] = $row;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('detail_pelanggaran', $data);
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
        $this->db->from('tb_pelanggaran k');
        $this->db->join('tb_siswa s', 'k.nisn = s.nisn', 'left');
        $data['pelanggaran'] = $this->db->get()->result();

        $this->load->view('laporan_pelanggaran/laporan_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf_gen->dompdf->setPaper($paper_size, $orientation);
        $this->dompdf_gen->dompdf->loadHtml($html);
        $this->dompdf_gen->dompdf->render();
        $this->dompdf_gen->dompdf->stream("laporan_pelanggaran.pdf", array("Attachment" => 0));
    }

    public function excel()
    {
        $this->load->model('m_pelanggaran');
        $this->db->select('k.nisn, k.waktu, k.kode, k.keterangan, k.poin, s.nama, s.kelas, s.jk as jenis_kelamin, s.wali_kelas');
        $this->db->from('tb_pelanggaran k');
        $this->db->join('tb_siswa s', 'k.nisn = s.nisn', 'left');
        $data['pelanggaran'] = $this->db->get()->result();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NISN');
        $sheet->setCellValue('C1', 'TANGGAL');
        $sheet->setCellValue('D1', 'NAMA');
        $sheet->setCellValue('E1', 'JENIS KELAMIN');
        $sheet->setCellValue('F1', 'KELAS');
        $sheet->setCellValue('G1', 'WALI KELAS');
        $sheet->setCellValue('H1', 'KODE');
        $sheet->setCellValue('I1', 'KETERANGAN');
        $sheet->setCellValue('J1', 'POIN');

        $row = 2;
        $no = 1;
        foreach ($data['pelanggaran'] as $k) {
            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $k->nisn);
            $sheet->setCellValue('C'.$row, $k->waktu);
            $sheet->setCellValue('D'.$row, $k->nama);
            $sheet->setCellValue('E'.$row, $k->jenis_kelamin == 'L' ? 'Laki-laki' : ($k->jenis_kelamin == 'P' ? 'Perempuan' : '-'));
            $sheet->setCellValue('F'.$row, $k->kelas);
            $sheet->setCellValue('G'.$row, $k->wali_kelas);
            $sheet->setCellValue('H'.$row, $k->kode);
            $sheet->setCellValue('I' . $row, $k->keterangan);
            $sheet->setCellValue('J' . $row, $k->poin);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data_Pelanggaran.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
