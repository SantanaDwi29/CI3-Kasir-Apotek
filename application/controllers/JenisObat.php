<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisObat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ObatModel', 'JenisObatModel', 'validasi']);
        $this->validasi->validasiakun();
    }

    public function index()
    {
        $data['jenisObat'] = $this->JenisObatModel->get_all();
        $data['obat'] = $this->ObatModel->get_all();
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
        $data['konten'] = $this->load->view('admin/jenisObat', $data, TRUE);
        $data['table'] = $this->load->view('admin/tabelJenisObat', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function save()
    {
        $idJenisObat = $this->input->post('idjenisObat');
        $namaJenis = $this->input->post('namaJenis');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'idJenisObat'=>$idJenisObat,
            'JenisObat' => $namaJenis,
            'Keterangan' => $keterangan
        ];

        try {
            if (empty($idJenisObat)) {
                $result = $this->JenisObatModel->insert($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data jenis obat berhasil ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data jenis obat');
                }
            } else {
                $result = $this->JenisObatModel->update($idJenisObat, $data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data jenis obat berhasil diperbarui');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui data jenis obat');
                }
            }
            redirect('jenisObat');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        redirect('jenisObat');
    }

    public function get($id)
    {
        $jenisObat = $this->JenisObatModel->get_by_id($id);
        if ($jenisObat) {
            echo json_encode($jenisObat);
        } else {
            show_404();
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->JenisObatModel->delete($id);
            if ($result) {
                $this->session->set_flashdata('success', 'Data jenis obat berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data jenis obat');
            }
            redirect('jenisObat');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        redirect('jenisObat');
    }
}