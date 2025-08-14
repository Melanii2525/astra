<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model
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
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_kehadiran', 'm');
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

    //	Digunakan di AJAX untuk menampilkan tabel data kehadiran.
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

    // public function tambah()
    // {
    //     $this->load->model('m_kehadiran');
    //     $this->load->model('m_siswa');

    //     $data['siswa'] = $this->m_siswa->get_all();
    //     $data['title'] = 'Tambah Data Kehadiran';

    //     if ($this->input->post()) {
    //         $nis = $this->input->post('nis');
    //         $tanggal = $this->input->post('tanggal');
    //         $keterangan = strtoupper($this->input->post('keterangan'));

    //         if ($keterangan !== 'A') {
    //             $this->session->set_flashdata('error', 'Keterangan hanya boleh huruf A.');
    //             redirect('kehadiran/tambah');
    //         }

    //         $poin = 7;

    //         $data_insert = [
    //             'nis' => $nis,
    //             'tanggal' => $tanggal,
    //             'keterangan' => $keterangan,
    //             'poin' => $poin
    //         ];

    //         $this->m->insert($data_insert);
    //         $this->session->set_flashdata('success', 'Data kehadiran berhasil disimpan.');
    //         redirect('kehadiran');
    //     }

    //     $this->load->view('template/header', $data);
    //     $this->load->view('kehadiran/tambah', $data);
    //     $this->load->view('template/footer');
    // }

    //dipakai untuk fungsi edit data (terhubung ke form), meskipun tidak lengkap di HTML.
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
    // Ambil data dari database
    $this->db->select('k.*, s.nama_siswa, s.kelas, s.jenis_kelamin, s.wali_kelas');
    $this->db->from('kehadiran k');
    $this->db->join('data_siswa s', 'k.nisn = s.nisn', 'left');
    $this->db->order_by('k.tanggal', 'ASC'); 
    $data['kehadiran'] = $this->db->get()->result();

    // Convert view menjadi HTML
    $html = $this->load->view('laporan_kehadiran/laporan_pdf', $data, true);

    // Konfigurasi Dompdf
    require_once FCPATH . 'vendor/autoload.php';
    $options = new Options();
    $options->set('isRemoteEnabled', true); // jika load gambar/css eksternal
    $dompdf = new Dompdf($options);

    // Load HTML
    $dompdf->loadHtml($html);

    // Set ukuran kertas & orientasi
    $dompdf->setPaper('A4', 'landscape');

    // Render PDF
    $dompdf->render();

    // Output ke browser (Attachment=0 berarti langsung buka di browser)
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

    public function laporan_persiswa($nisn)
{
    // Ambil data siswa
    $siswa = $this->db->get_where('data_siswa', ['nisn' => $nisn])->row();
    if (!$siswa) {
        show_error("Siswa tidak ditemukan.");
    }

    // Ambil data kehadiran siswa
    $kehadiran = $this->db->get_where('kehadiran', ['nisn' => $nisn])->result();

    // Siapkan data untuk view
    $data = [
        'siswa' => $siswa,
        'kehadiran' => $kehadiran
    ];

    // Load view jadi HTML string
    $html = $this->load->view('laporan_kehadiran/laporan_persiswa', $data, true);

    // Load Dompdf terbaru
    require_once FCPATH . 'vendor/autoload.php';
    $dompdf = new Dompdf();

    // Load HTML ke Dompdf
    $dompdf->loadHtml($html);

    // Atur ukuran & orientasi kertas
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Outputkan PDF ke browser
    $dompdf->stream('Laporan_Kehadiran_' . $siswa->nama_siswa . '.pdf', [
        "Attachment" => false // false = tampil di browser, true = download otomatis
    ]);
}

public function export_laporan_persiswa_pdf()
{
    // Ambil data laporan (pastikan model & method benar)
    $this->load->model('m_kehadiran');
    $data['laporan'] = $this->m->get_laporan_persiswa();

    // Load view jadi HTML string
    $html = $this->load->view('laporan_persiswa_pdf', $data, true);

    // Load Dompdf terbaru
    require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
    $dompdf = new Dompdf();

    // Load HTML ke Dompdf
    $dompdf->loadHtml($html);

    // Atur ukuran & orientasi kertas
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Outputkan PDF ke browser
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