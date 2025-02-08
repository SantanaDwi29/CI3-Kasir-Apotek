<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataObat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ObatModel', 'validasi', 'PemasokModel','JenisObatModel']);
        $this->validasi->validasiakun();
    }

    public function index()
    {
        $data['obat'] = $this->ObatModel->get_all();
        $data['pemasok'] = $this->PemasokModel->get_all();
        $data['jenisObat'] = $this->JenisObatModel->get_all();
        
        $totalStok = 0;
        $expiredStok = 0;
        $currentDate = date('Y-m-d');

        foreach ($data['obat'] as $item) {
            $totalStok += $item->StokObat;
            if (strtotime($item->ExpObat) < strtotime($currentDate)) {
                $expiredStok += $item->StokObat;
            }
        }

        $data['totalStok'] = $totalStok;
        $data['expiredStok'] = $expiredStok;
        $data['konten'] = $this->load->view('admin/dataObat', $data, TRUE);
        $data['table'] = $this->load->view('admin/tabelDataObat', $data, TRUE);
        $this->load->view('dashboard', $data);
    }

    private function buatNamaFile()
    {
        $kata = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        $namafile = substr(str_shuffle($kata), 0, 6);
        return $namafile;
    }

    private function upload_file($uploadFile, $field, $nama)
    {
        if (empty($uploadFile['name'])) {
            return "";
        }
        $NamaFile = str_replace(' ', '', $nama);
        
        $extractFile = pathinfo($uploadFile['name']);    
        $ekst = $extractFile['extension'];
        $newName = $NamaFile.".".$ekst;
        
        $config['upload_path'] = FCPATH.'uploads/obat';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048; // 2MB
        $config['overwrite'] = true;
        $config['file_name'] = $newName;
        
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            return "";
        }
        
        return $newName;
    }

    public function save()
{
    $NamaFile = $this->buatNamaFile();
    $idObat = $this->input->post('id_obat');
    
    $data = [
        'idObat' => $idObat,
        'idPemasok' => $this->input->post('id_pemasok'),
        'KodeObat' => $this->input->post('kode_obat'),
        'NamaObat' => $this->input->post('nama_obat'),
        'idJenisObat' => $this->input->post('id_jenisObat'),
        'HargaSatuan' => $this->input->post('harga_satuan'),
        'HargaBeli' => $this->input->post('harga_beli'),
        'HargaJual' => $this->input->post('harga_jual'),
        'StokObat' => $this->input->post('stok'),
        'ExpObat' => $this->input->post('expired'),
        'Keterangan' => $this->input->post('keterangan'),
        'TanggalMasuk' => $this->input->post('tanggal_masuk')
    ];

    try {
        if (empty($idObat)) {
            if (!empty($_FILES['foto_obat']['name'])) {
                $FotoObat = $this->upload_file($_FILES['foto_obat'], 'foto_obat', $NamaFile);
                if (!empty($FotoObat)) {
                    $data['FotoObat'] = $FotoObat;
                }
            }
            $result = $this->ObatModel->insert($data);
            $this->session->set_flashdata('success', 'Data obat berhasil ditambahkan');
        } 
        else {
            if (!empty($_FILES['foto_obat']['name'])) {
                $FotoObat = $this->upload_file($_FILES['foto_obat'], 'foto_obat', $NamaFile);
                if (!empty($FotoObat)) {
                    $old_data = $this->ObatModel->get_by_id($idObat);
                    if ($old_data && $old_data->FotoObat) {
                        $old_file = FCPATH.'uploads/obat/' . $old_data->FotoObat;
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }
                    $data['FotoObat'] = $FotoObat;
                }
            }
            $result = $this->ObatModel->update($idObat, $data);
            $this->session->set_flashdata('success', 'Data obat berhasil diperbarui');
        }
        
        redirect('dataObat');
    } catch (Exception $e) {
        $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        redirect('dataObat');
    }
}
    public function delete($id)
    {
        try {
            $obat = $this->ObatModel->get_by_id($id);
            if ($obat && $obat->FotoObat) {
                $file_path = FCPATH.'uploads/obat/' . $obat->FotoObat;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $result = $this->ObatModel->delete($id);
            if ($result) {
                $this->session->set_flashdata('success', 'Data obat berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data obat');
            }
            redirect('dataObat');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi Kesalahan: ' . $e->getMessage());
            redirect('dataObat');
        }
    }
    public function get($id)
    {
        $obat = $this->ObatModel->get_by_id($id);
        if ($obat) {
            echo json_encode($obat);
        } else {
            show_404();
        }
    }
}