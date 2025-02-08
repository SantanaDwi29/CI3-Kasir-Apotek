<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resep extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ResepModel', 'validasi', 'ObatModel']);
        $this->validasi->validasiakun();
    }

    public function index()
    {
        $data['obat'] = $this->ObatModel->get_all();
        $data['resep'] = $this->ResepModel->get_all();
        $totalStok = 0;
        $expiredStok = 0;
        $currentDate = date('Y-m-d');

        foreach ($data['obat'] as $item) {
            $totalStok += $item->StokObat;

            if (strtotime($item->ExpObat) < strtotime($currentDate)) {
                $expiredStok += $item->StokObat;
            }
        }
        $data['success'] = $this->session->flashdata('success');
        $data['error'] = $this->session->flashdata('error');
        $data['totalStok'] = $totalStok;
        $data['expiredStok'] = $expiredStok;
        $data['totalStok'] = $totalStok;
        $data['konten'] = $this->load->view('resep', $data, TRUE);
        $data['table'] = $this->load->view('tbresep', $data, TRUE);

        $this->load->view('dashboard', $data);
    }


    public function save()
    {
        $idResep = $this->input->post('id_resep');
        $NamaDokter=$this->input->post('nama_dokter');
        $NamaPelanggan=$this->input->post('nama_pelanggan');
        $AlamatPelanggan=$this->input->post('alamat_pelanggan');
        $TanggalResep=$this->input->post('tanggal_resep');
        $Status=$this->input->post('status');
        $data = [
            'NamaDokter' => $NamaDokter,
            'NamaPelanggan' => $NamaPelanggan,
            'AlamatPelanggan' => $AlamatPelanggan,
            'TanggalResep' => $TanggalResep,
            'Status'=>0
        ];
        try {
            if (empty($idResep)) {
                $result = $this->ResepModel->insert($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data resep berhasil ditambah');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambah data resep');
                }
            } else {
                $result = $this->ResepModel->update($idResep, $data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data resep berhasil diperbarui');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui data resep');
                }
            }
            redirect('resep');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi Kesalahan' . $e->getMessage());
            redirect('resep');
        }
    }
    public function get($id)
    {
        $resep = $this->ResepModel->get_by_id($id);
        if ($resep) {
            echo json_encode($resep);
        } else {
            show_404();
        }
    }
    public function delete($id)
    {
        try {
            $result = $this->ResepModel->delete($id);
            if ($result) {
                $this->session->set_flashdata('success', 'Data resep berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data resep');
            }
            redirect('resep');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi Kesalahan' . $e->getMessage());
            redirect('resep');
        }
    }
}
