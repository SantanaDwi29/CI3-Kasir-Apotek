<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPemasok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['PemasokModel', 'ObatModel', 'validasi']);
        $this->validasi->validasiakun();
    }

    public function index()
    {
        $data['pemasok'] = $this->PemasokModel->get_all();
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
        $data['totalStok'] = $totalStok;
        $data['konten'] = $this->load->view('admin/dataPemasok', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    public function save()
    {
        $idPemasok = $this->input->post('id_pemasok');
        $NamaPemasok = $this->input->post('nama_pemasok');
        $Alamat = $this->input->post('alamat');
        $Telepon = $this->input->post('telepon');
        $Email = $this->input->post('email');

        $data = [
            'idPemasok' => $idPemasok,
            'NamaPemasok' => $NamaPemasok,
            'Alamat' => $Alamat,
            'Telepon' => $Telepon,
            'Email' => $Email
        ];

        try {
            if (empty($idPemasok)) {
                $result = $this->PemasokModel->insert($data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data pemasok berhasil ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'Gagal menambahkan data pemasok');
                }
            } else {
                $result = $this->PemasokModel->update($idPemasok, $data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Data pemsok berhasil diperbarui');
                } else {
                    $this->session->set_flashdata('error', 'Gagal memperbarui data pemasok');
                }
            }
            redirect('dataPemasok');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjad kesalahan: ' . $e->getMessage());
            redirect('dataPemasok');
        }
    }

    public function get($id)
    {
        $pemasok = $this->PemasokModel->get_by_id($id);
        if ($pemasok) {
            echo json_encode($pemasok);
        } else {
            show_404();
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->PemasokModel->delete($id);

            if ($result) {
                $this->session->set_flashdata('success', 'Data pemasok berhasil di hapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data pemasok');
            }
            redirect('dataPemasok');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjad kesalahan: ' . $e->getMessage());
            redirect('dataPemasok');
        }
    }
}
