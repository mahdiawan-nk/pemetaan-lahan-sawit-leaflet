<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	// public function __construct()
	// {
		// parent:: __construct();
		// $this->load->library('session');
		// $this->load->model('user_model');
	// }
	public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['email'])) {
            $url = base_url('welcome');
            redirect($url);
        }
    }

	public function index()
	{
		$data['title'] = 'Dashboard | Webgis PT Mitra Bumi';
		$this->load->view('layout/header', $data);
		$this->load->view('administrator/data_lahan/peta_lahan', $data);
		$this->load->view('layout/footer', $data);
	}
}
