<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tentang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['email'])) {
			$url = base_url('welcome');
			redirect($url);
		}
		$this->load->model('Sejarah_model', 'sejarah');
		$this->load->model('Visimisi_model', 'visimisi');
	}
	public function index()
	{
		$data['title'] = "Tentang | PT Mitra Bumi";
		$data['page'] = "Tentang";
		$this->load->view('layout/header', $data);
		$this->load->view('administrator/Tentang/index', $data);
		$this->load->view('layout/footer', $data);
	}

	public function sejarah()
	{

		$data = $this->sejarah->select();
		$response = array('data' => $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function sejarah_post()
	{

		$data = $this->sejarah->select();
		if ($data != null) {
			$this->sejarah->update($data->id, ['content' => $this->input->post('content')]);
		} else {
			$this->sejarah->insert(['content' => $this->input->post('content')]);
		}
		$getUpdated = $this->sejarah->select();
		$response = array('data' => $getUpdated->content);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function visi_misi()
	{

		$data = $this->visimisi->select();
		$response = array('data' => $data);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function visi_misi_post()
	{

		$data = $this->visimisi->select();
		if ($data != null) {
			$this->visimisi->update($data->id, ['content' => $this->input->post('content')]);
		} else {
			$this->visimisi->insert(['content' => $this->input->post('content')]);
		}
		$getUpdated = $this->visimisi->select();
		$response = array('data' => $getUpdated->content);
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
