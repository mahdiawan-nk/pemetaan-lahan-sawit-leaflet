<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent:: __construct();
		$this->load->library('session');
		$this->load->model('user_model');
	}

	public function index()
	{
		$data['title'] = 'Login | Webgis PT Mitra Bumi';
		$this->load->view('login/index', $data);
	}

	public function Login_aksi()
	{
		$email = $this-> input->post('email');
		$password = $this->input->post('password');
		if(empty($email) || empty($password))
		{
			$this->session->set_flashdata('message', '<div class="badge badge-pill badge-danger" role="alert">username atau password tidak boleh kosong!</div>');
			redirect('welcome');
		}

		// $user=$this->user_model->get_user($email);
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if($user)
		{

			if($user['is_aktif'] != 1)
			{
			$this->session->set_flashdata('message', '<div class="badge badge-pill badge-danger" role="alert">akun belum diaktifkan!</div>');	
			redirect('welcome');
			}

			if(password_verify ($password,$user['password']))
			{
				$userdata = [
					'user_id' =>$user['id'],
					'email' => $user['email'],
					'nama_pengguna' => $user['nama_pengguna'],
					'logged_in' =>true

				];
				$this->session->set_userdata($userdata);
				redirect('dashboard');
			} else{
				$this->session->set_flashdata('message', '<div class="badge badge-pill badge-danger" role="alert">password salah!</div>');
				redirect('welcome');
			}
		}else{
			$this->session->set_flashdata('message', '<div class="badge badge-pill badge-danger" role="alert">Akun Anda Tidak Ditemukan!</div>');
			redirect('welcome');
		}
	}
	public function logout() {
		// Hapus semua data sesi
		$this->session->unset_userdata(['user_id', 'email', 'nama_pengguna', 'logged_in']);
		
		// Hancurkan seluruh sesi
		$this->session->sess_destroy();
		
		// Set flash data untuk menunjukkan pesan sukses
		// $this->session->set_flashdata('success', 'Akun sudah logout');
		$this->session->set_flashdata('message', '<div class="badge badge-pill badge-success" role="alert">Akun Sudah Logout</div>');
		
		// Redirect ke halaman login (jangan gunakan index.php)
		redirect('welcome');  // Pastikan 'welcome' adalah controller yang benar
	}

}
