<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['validasi', 'ObatModel', 'TransaksiModel']);
        $this->validasi->validasiakun();
    }

    function admin()
    {
        $data['obat'] = $this->ObatModel->get_all();
        $totalStok = 0;
        $expiredStok = 0;
        $tanggalSekarang = date('Y-m-d');

        foreach ($data['obat'] as $item) {
            $totalStok += $item->StokObat;
            if (strtotime($item->ExpObat) < strtotime($tanggalSekarang)) {
                $expiredStok += $item->StokObat;
            }
        }
        $data['totalStok'] = $totalStok;
        $data['expiredStok'] = $expiredStok;
        $data['transaksi_hari_ini'] = $this->TransaksiModel->get_total_transaksi_hari_ini();
        $data['penjualan_harian'] = $this->TransaksiModel->get_penjualan_harian();
        $data['penjualan_mingguan'] = $this->TransaksiModel->get_penjualan_mingguan();

        // Format data untuk grafik
        $data['grafik_harian_labels'] = json_encode(array_map(function ($penjualan) {
            return date('d M', strtotime($penjualan->tanggal));
        }, $data['penjualan_harian']));

        $data['grafik_harian_data'] = json_encode(array_map(function ($penjualan) {
            return $penjualan->total_penjualan;
        }, $data['penjualan_harian']));

        $data['grafik_mingguan_labels'] = json_encode(array_map(function ($penjualan) {
            return date('d M', strtotime($penjualan->awal_minggu)) . ' - ' .
                date('d M', strtotime($penjualan->akhir_minggu));
        }, $data['penjualan_mingguan']));

        $data['grafik_mingguan_data'] = json_encode(array_map(function ($penjualan) {
            return $penjualan->total_penjualan;
        }, $data['penjualan_mingguan']));

        $this->load->view('dashboard', $data);
    }


    function logout()
    {
        $this->session->sess_destroy();
        redirect('loginHalaman', 'refresh');
    }
}
