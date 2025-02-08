<?php
class Pengguna extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(['validasi','PenggunaModel']);
        $this->validasi->validasiakun();
    }
    
    public function index() {
        $data['pengguna'] = $this->PenggunaModel->get_all();
        $data['success'] = $this->session->flashdata('success');
        $data['error'] = $this->session->flashdata('error');
        $data['konten'] = $this->load->view('admin/pengguna', $data, TRUE);
        $this->load->view('dashboard', $data);    }
    public function save()
    {
        $idLogin = $this->input->post('id_login');
        $Password= $this->input->post('password');
        $Username=$this->input->post('username');
        $NamaLengkap = $this->input->post('nama_lengkap');
        $NoTelepon=$this->input->post('no_telepon');
        $Level=$this->input->post('level');
        if (!empty($Password)) {
            $encrypted_password = hash('sha256', $Password);
        }
        $data = [
            'idLogin' => $idLogin,
            'Username'=>$Username,
            'NamaLengkap' => $NamaLengkap,
            'NoTelepon' => $NoTelepon,
            'Level' => $Level,
        ];
        if (!empty($Password)) {
            $data['Password'] = $encrypted_password;
        }
        try {
            if (empty($idLogin)) {
                if (empty($Password)) {
                    $this->session->set_flashdata('error', 'Password harus diisi');
                    redirect('pengguna');
                    return;
                }
                $result = $this->PenggunaModel->insert($data);
                if($result){
                    $this->session->set_flashdata('success','Data pengguna berhasil ditambahkan');
                }else{
                    $this->session->set_flashdata('error','Gagal menambahkan data pengguna ');
                }
            } else {
                if (empty($Password)) {
                    unset($data['Password']);
                }
                $result = $this->PenggunaModel->update($idLogin, $data);
                if($result){
                    $this->session->set_flashdata('success','Data pengguna berhasil diperbarui');
                }else{
                    $this->session->set_flashdata('error','Gagal memperbarui data pengguna');
                }
            }
            redirect('pengguna');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        redirect('pengguna');
    }

    public function get($id)
    {
        $pengguna = $this->PenggunaModel->get_by_id($id);
        if ($pengguna) {
            echo json_encode($pengguna);
        } else {
            show_404();
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->PenggunaModel->delete($id);
            if ($result) {
                $this->session->set_flashdata('success', 'Data pengguna berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data pengguna');
            }
            redirect('pengguna');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        redirect('pengguna');
    }
}
