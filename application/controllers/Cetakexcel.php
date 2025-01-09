<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cetakexcel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_lahan', 'Lahan_model');
    }

    public function index()
    {
        // Mengambil data dari tabel lahan
        $lahan_data = $this->Lahan_model->show_lahan()->result_array();

        // Menyiapkan header data untuk file Excel
        $data = [
            ['ID Lahan', 'Tahun Tanam', 'Blok', 'Luas Blok', 'Jumlah Tandan', 'Produksi'] // Header kolom
        ];

        // Menambahkan data lahan ke array
        foreach ($lahan_data as $row) {
            $data[] = [
                $row['id_lahan'], // ID Lahan
                $row['tahun_tanam'], // Tahun Tanam
                $row['blok'], // Blok
                $row['luas_blok'], // Luas Blok
                $row['jumlah_tandan'], // Jumlah Tandan
                $row['produksi'] // Produksi
            ];
        }

        // Membuat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan data ke spreadsheet
        $sheet->fromArray($data, NULL, 'A1');

        // Membuat writer untuk format Excel
        $writer = new Xlsx($spreadsheet);

        $filename = 'lahan_data_' . date('Ymd_His') . '.xlsx'; // Format: lahan_data_YYYYMMDD_HHMMSS.xlsx

        // Set header untuk pengunduhan file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Menulis file Excel ke output
        $writer->save('php://output');
    }
}

/* End of file Cetakexcel.php and path \application\controllers\Cetakexcel.php */
