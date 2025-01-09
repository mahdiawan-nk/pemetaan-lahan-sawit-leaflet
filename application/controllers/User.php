<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('M_user');
    }

	public function index()
	{
		$data['title'] = "Data User | Webgis PT Mitra Bumi";
		$data['page'] = "Data User";
		$data['user'] = $this->M_user->show_user()->result();
		$this->load->view('layout/header', $data);
		$this->load->view('administrator/user/index', $data);
		$this->load->view('layout/footer', $data);
	}

	public function submit_form()
    {
        // Form validation rules
        $this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return errors
          	$data['title'] = "Data User | Webgis PT Mitra Bumi";
			$data['page'] = "Data User";
			$data['user'] = $this->M_user->show_user()->result();
			$this->load->view('layout/header', $data);
			$this->load->view('administrator/user/index', $data);
			$this->load->view('layout/footer', $data);
        } else {
            // Data is valid, insert into database
            $data = [
                'nama_pengguna' => $this->input->post('nama_pengguna'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];

            if ($this->M_user->insert_user($data)) {
                // Success message and redirection (you can adjust as needed)
                $this->session->set_flashdata('success', 'User successfully created!');
                redirect('user');
            } else {
                // Error handling
                $this->session->set_flashdata('error', 'Failed to create user.');
                redirect('user');
            }
        }
    }

	public function change_status($user_id, $current_status)
    {
        // Toggle the status (1 for active, 0 for inactive)
        $new_status = ($current_status == 1) ? 0 : 1;

        // Update status in the database
        if ($this->M_user->update_status($user_id, $new_status)) {
            // Redirect with success message
            $this->session->set_flashdata('success', 'User status updated.');
        } else {
            // Redirect with error message
            $this->session->set_flashdata('error', 'Failed to update status.');
        }

        // Redirect to the user list page (or previous page)
        redirect('user');
    }

	public function update($user_id)
    {
        // Get the form data
        $nama_pengguna = $this->input->post('nama_pengguna');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Prepare data to update (only update password if provided)
        $data = [
            'nama_pengguna' => $nama_pengguna,
            'email' => $email
        ];

        if (!empty($password)) {
            // Hash password if it's provided
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Update the user data
        if ($this->M_user->update_user($user_id, $data)) {
            $this->session->set_flashdata('success', 'User updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update user');
        }

        // Redirect to user list or wherever necessary
        redirect('user');
    }

	public function delete($user_id)
    {
        // Call the model method to delete the user by ID
        if ($this->M_user->delete_user($user_id)) {
            // Success message
            $this->session->set_flashdata('success', 'User deleted successfully');
        } else {
            // Error message
            $this->session->set_flashdata('error', 'Failed to delete user');
        }

        // Redirect to the user list page or the appropriate page
        redirect('user');
    }
}
