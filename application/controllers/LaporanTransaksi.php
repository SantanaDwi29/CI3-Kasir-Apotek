<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanTransaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['TransaksiModel', 'validasi']);
        $this->validasi->validasiakun();
    }

    public function index()
    {
        $data['bulan'] = $this->input->get('bulan') ?? date('m');
        $data['tahun'] = $this->input->get('tahun') ?? date('Y');

        // Ambil data transaksi
        $data['transaksi'] = $this->TransaksiModel->get_laporan_transaksi($data['bulan'], $data['tahun']);

        // Hitung total keseluruhan nilai transaksi
        $totalNilai = 0;
        foreach ($data['transaksi'] as $item) {
            $totalNilai += $item->TotalHarga;
        }

        $data['totalNilai'] = $totalNilai;

        // Tampilkan view
        $data['konten'] = $this->load->view('masterData/laporanTransaksi', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function cetak_pdf()
    {
        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');

        $dompdf = new \Dompdf\Dompdf();
        $bulan = $this->input->get('bulan') ?? date('m');
        $tahun = $this->input->get('tahun') ?? date('Y');

        // Ambil data transaksi
        $data['transaksi'] = $this->TransaksiModel->get_laporan_transaksi($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        // Hitung total keseluruhan nilai transaksi
        $totalNilai = 0;
        foreach ($data['transaksi'] as $item) {
            $totalNilai += $item->TotalHarga;
        }

        $data['totalNilai'] = $totalNilai;

        // Set opsi DOMPDF
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        // Render PDF
        $html = $this->load->view('masterData/laporan_transaski_pdf', $data, true);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("laporan_transaksi_" . $bulan . "_" . $tahun . ".pdf", array("Attachment" => false));
    }
}
