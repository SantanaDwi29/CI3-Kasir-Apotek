<?php
class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['TransaksiModel','validasi']);
        $this->validasi->validasiakun();
    }

    public function index()
    {
        $data['obat'] = $this->TransaksiModel->get_all_obat();
        $data['resep'] = $this->TransaksiModel->get_active_resep();
        $data['transaksi'] = $this->TransaksiModel->get_all_transaksi();
        $data['konten'] = $this->load->view('kasir/transaksi', $data, TRUE);
        $data['table'] = $this->load->view('kasir/listTransaksi', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function search()
    {
        $term = $this->input->get('term');
        $results = $this->TransaksiModel->search_obat($term);
        echo json_encode($results);
    }

    public function getResepData()
    {
        $idResep = $this->input->post('idResep') ? $this->input->post('idResep') : null;
        $resep = $this->TransaksiModel->get_resep_by_id($idResep);

        if ($resep) {
            echo json_encode(['success' => true] + (array)$resep);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function simpan()
    {
        $this->db->trans_start();

        try {
            $cartItems = json_decode($this->input->post('cartItems'), true);
            $idResep = $this->input->post('idResep') ?: null;
            $totalHarga = $this->input->post('totalHarga');
            $jumlahBayar = $this->input->post('jumlahBayar');
            $tanggalTransaksi = date('Y-m-d H:i:s');
            $noTransaksi = $this->buatnotransaksi();

            if (empty($cartItems)) {
                throw new Exception('Keranjang belanja kosong. Tambahkan obat terlebih dahulu.');
            }

            if (!empty($idResep)) {
                $resep = $this->TransaksiModel->get_resep_by_id($idResep);
                if (!$resep) {
                    throw new Exception('Resep tidak ditemukan.');
                }
                if ($resep->Status == 1) {
                    throw new Exception('Resep sudah digunakan.');
                }
            }

            if ($jumlahBayar < $totalHarga) {
                throw new Exception('Jumlah bayar tidak mencukupi.');
            }

            // Process each cart item
            foreach ($cartItems as $item) {
                $obat = $this->TransaksiModel->get_obat_by_id($item['idObat']);
                
                if (!$obat) {
                    throw new Exception("Obat dengan ID {$item['idObat']} tidak ditemukan");
                }
                
                if ($obat->StokObat < $item['jumlah']) {
                    throw new Exception("Stok tidak mencukupi untuk obat {$obat->NamaObat}");
                }

                if ($this->TransaksiModel->cek_obat_kadaluarsa($item['idObat'])) {
                    throw new Exception("Obat {$item['nama']} sudah kadaluarsa dan tidak dapat dijual.");
                }

                $transaksi = [
                    'NoTransaksi' => $noTransaksi,
                    'idObat' => $item['idObat'],
                    'TanggalTransaksi' => $tanggalTransaksi,
                    'TotalHarga' => $item['subtotal'],
                    'StatusResep' => $idResep ? 1 : 0,
                    'JumlahDibeli' => $item['jumlah'],
                    'JumlahBayar' => $jumlahBayar,
                    'Kembalian' => $jumlahBayar - $totalHarga,
                    'idResep' => $idResep,
                    'Status' => 'Lunas',
                    
                ];

                $this->TransaksiModel->insert_transaksi($transaksi);
                $this->TransaksiModel->update_stok_obat($item['idObat'], $item['jumlah']);
            }

            if ($idResep) {
                $this->TransaksiModel->update_resep_status($idResep, 1);
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menyimpan transaksi');
            }

            echo json_encode([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan',
                'noTransaksi' => $noTransaksi
            ]);

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    function buatnotransaksi()
    {
        $kata = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        $Tahun = date('Y');
        $Bulan = date('m');
        $nomoracak = substr(str_shuffle($kata), 0, 4);
        return "ASF-" . $Tahun . $Bulan . "-" . $nomoracak;
    }

    function selesaidancetak()
    {
        $this->cetaknota();
    }

    function cetaknota()
    {
        $transaksi = $this->TransaksiModel->get_latest_transaction();
        $data['transaksi'] = $transaksi;
        $data['items'] = $this->TransaksiModel->get_transactions_by_group($transaksi->NoTransaksi);

        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
        $pdf = new Dompdf\Dompdf();
        $pdf->setPaper('A4', 'landscape');
        $pdf->set_option('isRemoteEnabled', TRUE);
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isPhpEnabled', true);
        $pdf->set_option('isFontSubsettingEnabled', true);

        $pdf->loadHtml($this->load->view('kasir/cetaknota_pdf', $data, true));

        $pdf->render();
        $pdf->stream('Nota Pembelian', ['Attachment' => false]);
    }
}