<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanObat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ResepModel', 'validasi', 'ObatModel','validasi']);
        $this->validasi->validasiakun();
    }

    public function index()
    {
        $data['bulan'] = $this->input->get('bulan') ?? date('m');
        $data['tahun'] = $this->input->get('tahun') ?? date('Y');
        // Get filtered data
        $data['obat'] = $this->ObatModel->get_laporan_stok($data['bulan'], $data['tahun']);

        // Calculate totals
        $totalStok = 0;
        $totalNilai = 0;
        foreach ($data['obat'] as $item) {
            $totalStok += $item->StokObat;
            $totalNilai += ($item->StokObat * $item->HargaSatuan);
        }

        $data['totalStok'] = $totalStok;
        $data['totalNilai'] = $totalNilai;

        $data['konten'] = $this->load->view('masterData/laporanObat', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function cetak_pdf()
    {
        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');

        $dompdf = new \Dompdf\Dompdf();
        $bulan = $this->input->get('bulan') ?? date('m');
        $tahun = $this->input->get('tahun') ?? date('Y');

        $data['obat'] = $this->ObatModel->get_laporan_stok($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $totalStok = 0;
        $totalNilai = 0;
        foreach ($data['obat'] as $item) {
            $totalStok += $item->StokObat;
            $totalNilai += ($item->StokObat * $item->HargaSatuan);
        }

        $data['totalStok'] = $totalStok;
        $data['totalNilai'] = $totalNilai;

        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        $html = $this->load->view('masterData/laporan_stok_pdf', $data, true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("laporan_stok_" . $bulan . "_" . $tahun . ".pdf", array("Attachment" => false));
    }
}
