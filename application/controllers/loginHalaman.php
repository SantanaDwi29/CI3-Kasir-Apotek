<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginHalaman extends CI_Controller
{

	public function index()
	{
		$this->load->view('login');
	}

	public function proseslogin()
	{
		$Username = $this->input->post('Username');
		$Password = $this->input->post('Password');

		if (empty($Username) || empty($Password)) {
			$this->session->set_flashdata('pesan', 'Username dan password harus diisi');
			redirect('loginHalaman', 'refresh');
			return;
		}

		$query = $this->db->query("SELECT * FROM tb_login WHERE Username = ?", array($Username));
		if ($query->num_rows() > 0) {
			$data = $query->row();
			// Periksa kecocokan password yang telah dienkripsi
			$encrypted_password = hash('sha256', $Password);
			if ($data->Password === $encrypted_password) {
				// Simpan data ke session
				$session_data = array(
					'idLogin' => $data->idLogin,
					'Username' => $data->Username,
					'NamaLengkap' => $data->NamaLengkap,
					'NoTelepon' => $data->NoTelepon,
					'Level' => $data->Level
				);
				$this->session->set_userdata($session_data);

				// Redirect ke dashboard
				redirect('dashboard/admin', 'refresh');
			} else {
				$this->session->set_flashdata('pesan', 'Password salah');
				redirect('loginHalaman', 'refresh');
			}
		} else {
			$this->session->set_flashdata('pesan', 'Username tidak ditemukan');
			redirect('loginHalaman', 'refresh');
		}
	}
}
