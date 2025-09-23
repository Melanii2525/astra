<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property m_kehadiran $m
 * @property m_siswa $m_siswa
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_Output $output
 * @property CI_DB_query_builder $db
 */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class Kehadiran extends CI_Controller
{

    public function __construct()
{
    parent::__construct();

    // Cek apakah user sudah login
    if (!$this->session->userdata('logged_in')) {
        redirect('landingpage');
    }

    // Load semua model yang dipakai
    $this->load->model('M_kehadiran');
    $this->load->model('M_revisi');
    $this->load->model('M_pelanggaran');
    $this->load->model('m_kehadiran', 'm');

    // Load helper
    $this->load->helper(['form', 'url']);
}

    public function index()
    {
        $this->load->model('m_siswa');

        $data['title'] = "Data Kehadiran";
        $data['siswa'] = $this->m_siswa->get_all_ordered();
        $data['siswa_kosong'] = empty($data['siswa']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kehadiran', $data);
        $this->load->view('templates/footer');
    }

    public function ambildata()
    {
        $data = $this->m->ambildata()->result();
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
        $hapus = $this->m->hapusdata('kehadiran', $where);

        if ($hapus) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function detail($id)
    {
        $this->db->select('k.*, s.jenis_kelamin, s.nama_siswa, s.kelas, s.wali_kelas, s.foto');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
        $this->db->where('k.id', $id);
        $row = $this->db->get()->row();

        if (!$row) {
            show_404();
        }

        $data['title'] = 'Detail Kehadiran';
        $data['data']  = $row;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('detail_kehadiran', $data);
        $this->load->view('templates/footer');
    }

    public function export_pdf()
    {
        $this->db->select('k.*, s.nama_siswa, s.kelas, s.jenis_kelamin, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
        $this->db->order_by('k.tanggal', 'ASC');
        $data['kehadiran'] = $this->db->get()->result();

        $html = $this->load->view('laporan_kehadiran/laporan_pdf', $data, true);

        require_once FCPATH . 'vendor/autoload.php';
        $options = new Options();
        $options->set('isRemoteEnabled', true); 
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $dompdf->stream("laporan_kehadiran.pdf", ["Attachment" => 0]);
    }

    public function excel()
    {
        $this->load->model('m_kehadiran');
        $this->db->select('k.*, s.nama_siswa, s.kelas, s.jenis_kelamin, s.wali_kelas');
        $this->db->from('kehadiran k');
        $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
        $this->db->order_by('k.tanggal', 'ASC');
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
        $sheet->setCellValue('I1', 'POIN');

        $row = 2;
        $no = 1;
        foreach ($data['kehadiran'] as $k) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $k->nisn);
            $sheet->setCellValue('C' . $row, date('d-m-Y', strtotime($k->tanggal)));
            $sheet->setCellValue('D' . $row, $k->nama_siswa);
            $sheet->setCellValue('E' . $row, $k->jenis_kelamin == 'L' ? 'Laki-laki' : ($k->jenis_kelamin == 'P' ? 'Perempuan' : '-'));
            $sheet->setCellValue('F' . $row, $k->kelas);
            $sheet->setCellValue('G' . $row, $k->wali_kelas);
            $sheet->setCellValue('H' . $row, $k->keterangan);
            $sheet->setCellValue('I' . $row, $k->poin);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data_Kehadiran.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function laporan_persiswa($nisn)
    {
        $siswa = $this->db->get_where('data_siswa', ['nisn' => $nisn])->row();
        if (!$siswa) {
            show_error("Siswa tidak ditemukan.");
        }

        $kehadiran = $this->db->get_where('kehadiran', ['nisn' => $nisn])->result();

        $data = [
            'siswa' => $siswa,
            'kehadiran' => $kehadiran
        ];

        $html = $this->load->view('laporan_kehadiran/laporan_persiswa', $data, true);

        require_once FCPATH . 'vendor/autoload.php';
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('Laporan_Kehadiran_' . $siswa->nama_siswa . '.pdf', [
            "Attachment" => false 
        ]);
    }

    public function export_laporan_persiswa_pdf()
    {
        $this->load->model('m_kehadiran');
        $data['laporan'] = $this->m->get_laporan_persiswa();

        $html = $this->load->view('laporan_persiswa_pdf', $data, true);

        require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("Laporan_Kehadiran_Per_Siswa.pdf", [
            "Attachment" => false
        ]);
    }
    
    public function get_autocomplete_siswa()
    {
        $term = $this->input->get('term');
        $this->db->like('nama_siswa', $term);
        $result = $this->db->get('data_siswa')->result();

        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'nama_siswa' => $row->nama_siswa,
                'kelas'      => $row->kelas,
                'nisn'       => $row->nisn
            ];
        }

        echo json_encode($data);
    }

    public function cari()
    {
        $keyword = $this->input->post('keyword');
        $data = $this->m->search_data($keyword)->result();
        echo json_encode($data);
    }
}
