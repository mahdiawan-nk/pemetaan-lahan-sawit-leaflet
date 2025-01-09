<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sejarah_model', 'sejarah');
        $this->load->model('Visimisi_model', 'visi');
        
    }

    public function index()
    {
        $data['halaman']="website/home";
        $this->load->view('website/layouts/index', $data);
    }

    public function tentang()
    {
        $data['sejarah']=$this->sejarah->select();
        $data['visi']=$this->visi->select();
        $data['halaman']="website/tentang";
        $this->load->view('website/layouts/index', $data);
    }

    public function peta_lahan()
    {
  
        $data['halaman']="website/peta_lahan";
        $this->load->view('website/layouts/index', $data);
    }
}

/* End of file Website.php and path \application\controllers\Website.php */
