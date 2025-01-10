<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lihat_data_lahan extends CI_Controller
{

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
		$this->load->model('M_lahan');
		$this->load->model('Pemetaan_model');
	}
	public function index()
	{
		$data['title'] = "Data Lahan | Webgis PT Mitra Bumi";
		$data['page'] = "Data Lahan";
		// $data['user'] = $this->M_lahan->show_user()->result();
		$this->load->view('layout/header', $data);
		$this->load->view('administrator/data_lahan/index', $data);
		$this->load->view('layout/footer', $data);
	}

	function fetch_data()
	{
		// Ambil nilai halaman saat ini dari request, default ke 1 jika tidak ada
		$currentPage = $this->input->get('page') ? (int)$this->input->get('page') : 1;
		$perPage = $this->input->get('limit') ? (int)$this->input->get('limit') : 25; // Jumlah data per halaman

		// Hitung offset berdasarkan halaman saat ini
		$offset = ($currentPage - 1) * $perPage;
		if ($this->input->get('keyword')) {
			$this->db->like('tahun_tanam', $this->input->get('keyword'));
			$this->db->or_like('blok', $this->input->get('keyword'));
			$this->db->or_like('luas_blok', $this->input->get('keyword'));
			$this->db->or_like('jumlah_tandan', $this->input->get('keyword'));
			$this->db->or_like('produksi', $this->input->get('keyword'));
		}
		// Query database dengan limit dan offset
		$this->db->offset($offset)->limit($perPage);
		$data = $this->M_lahan->show_lahan();

		// Hitung total data secara keseluruhan (tanpa limit dan offset)
		$totalData = $this->db->count_all('lahan'); // Pastikan tabel "lahan" sesuai dengan database Anda

		// Hitung total halaman
		$totalPage = ceil($totalData / $perPage);

		// Siapkan response
		$codeResponse = 200;

		if (!$data->result()) {
			$response = array(
				"message" => "Data Tidak Tersedia",
				"data" => [],
				"pagination" => [
					"totalData" => 0,
					"totalPage" => 0,
					"currentPage" => $currentPage,
					"perPage" => $perPage,
					"from" => 0,
					"to" => 0
				]
			);
			$codeResponse = 404;
		} else {
			// Data untuk paginasi
			$from = $offset + 1;
			$to = $offset + $data->num_rows();

			$dataPagination = [
				"data" => $data->result(),
				"pagination" => [
					"totalData" => $totalData,
					"totalPage" => $totalPage,
					"currentPage" => $currentPage,
					"perPage" => $perPage,
					"from" => $from,
					"to" => $to
				]
			];

			$response = array(
				"message" => "Data Tersedia",
				"data" => $dataPagination
			);
		}

		// Output response JSON dengan kode HTTP yang sesuai
		$this->output
			->set_content_type('application/json')
			->set_status_header($codeResponse)
			->set_output(json_encode($response));
	}

	public function buat_polygon_lahan($id)
	{
		$checkData = $this->M_lahan->show_by_id($id);
		if (!empty($id) && !empty($checkData)) {
			$data['title'] = "Data Lahan | Webgis PT Mitra Bumi";
			$data['page'] = "Data Lahan";
			$data['id'] = $id;
			$data['data'] = $checkData;
			$this->load->view('layout/header', $data);
			$this->load->view('administrator/data_lahan/pemetaan_blok', $data);
			$this->load->view('layout/footer', $data);
		}
	}


	public function submit_form()
	{
		// Form validation rules
		$this->form_validation->set_rules('tahun_tanam', 'Tahun tanam', 'required');
		$this->form_validation->set_rules('blok', 'Blok', 'required');
		$this->form_validation->set_rules('luas_blok', 'Luas blok', 'required');
		$this->form_validation->set_rules('jumlah_tandan', 'Jumlah tandan', 'required');
		$this->form_validation->set_rules('produksi', 'Produksi(Kg)', 'required');


		if ($this->form_validation->run() == FALSE) {
			// Validation failed, return errors
			$this->output->set_content_type('application/json')->set_output(json_encode($this->form_validation->error_array()));
		} else {
			// Data is valid, insert into database
			$data = [
				'tahun_tanam' => $this->input->post('tahun_tanam'),
				'blok' => $this->input->post('blok'),
				'luas_blok' => $this->input->post('luas_blok'),
				'jumlah_tandan' => $this->input->post('jumlah_tandan'),
				'produksi' => $this->input->post('produksi'),
			];

			if ($this->M_lahan->insert_lahan($data)) {
				// Success message and redirection (you can adjust as needed)
				$response = array(
					"message" => "Data Lahan successfully created!",
					"data" => $data
				);
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			} else {
				// Error handling
				$this->output->set_content_type('application/json')->set_output(json_encode(array('error' => 'Failed to create data lahan.')));
			}
		}
	}

	public function update_lahan($id)
	{
		$checkData = $this->M_lahan->show_by_id($id);
		if (!empty($id) && !empty($checkData)) {
			$data = [
				'tahun_tanam' => $this->input->post('tahun_tanam'),
				'blok' => $this->input->post('blok'),
				'luas_blok' => $this->input->post('luas_blok'),
				'jumlah_tandan' => $this->input->post('jumlah_tandan'),
				'produksi' => $this->input->post('produksi'),
			];
			if ($this->M_lahan->update_lahan($id, $data)) {
				// Success message and redirection (you can adjust as needed)
				$response = array(
					"message" => "Data Lahan successfully updated!",
					"data" => $data
				);
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			} else {
				// Error handling
				$this->output->set_content_type('application/json')->set_output(json_encode(array('error' => 'Failed to update data lahan.')));
			}
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('error' => 'Failed to update data lahan.')));
		}
	}

	public function delete_lahan($id)
	{
		if ($this->M_lahan->delete_lahan($id)) {
			// Success message and redirection (you can adjust as needed)
			$response = array(
				"message" => "Data Lahan successfully deleted!",
			);
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			// Error handling
			$this->output->set_content_type('application/json')->set_output(json_encode(array('error' => 'Failed to delete data lahan.')));
		}
	}

	public function save_pemetaan_lahan()
	{
		$blok = $this->input->post('id');
		$polygon = $this->input->post('polygon');
		$data = [
			'lahan_id' => $blok,
			'coordinates' => $polygon,
		];
		$dataIsValid = $this->db->get_where('pemetaan_blok', ['lahan_id' => $data['lahan_id']])->row();
		if ($dataIsValid) {
			$this->Pemetaan_model->update($data, $data['lahan_id']);
			$this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($data));
		} else {

			if ($this->Pemetaan_model->save($data)) {

				$data = [
					'success' => true,
					'message' => 'Polygon saved successfully!'
				];
				$this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($data));
			} else {

				$data = [
					'success' => false,
					'message' => 'Failed to save polygon.'
				];
				$this->output
					->set_content_type('application/json')
					->set_status_header(500)
					->set_output(json_encode($data));
			}
		}
	}

	public function show_polygon_lahan($id)
	{
		// Fetch data from the model
		$data = $this->Pemetaan_model->show_by_id($id);

		// If the result is a single polygon object, wrap it in an array
		if (!is_array($data)) {
			$checkData = $this->M_lahan->show_by_id($id);
			if ($checkData) {
				$data = [$data];
			}
			// Wrap the single polygon object in an array
		}

		// Return the data as a JSON response
		$this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode($data));
	}

	public function peta_lahan($id = null)
	{
		$data['title'] = "Data Lahan | Webgis PT Mitra Bumi";
		$data['page'] = "Peta Lahan";
		if ($id) {
			$checkData = $this->M_lahan->show_by_id($id);
			if (!empty($checkData)) {
				$data['id'] = $id;
				$data['data'] = $checkData;
				$this->load->view('layout/header', $data);
				$this->load->view('administrator/data_lahan/single_blok', $data);
				$this->load->view('layout/footer', $data);
			}
		} else {
			$this->load->view('layout/header', $data);
			$this->load->view('administrator/data_lahan/peta_lahan', $data);
			$this->load->view('layout/footer', $data);
		}
	}

	public function json_lahan()
	{
		$data = $this->db->get('pemetaan_blok')->result();

		$result = [];

		foreach ($data as $item) {
			// Decode koordinat dari JSON
			$coordinates = json_decode($item->coordinates);

			// Validasi koordinat dan ubah urutan jika diperlukan
			if ($coordinates && isset($coordinates->coordinates)) {
				$flippedCoordinates = array_map(function ($polygon) {
					// return array_map(function ($point) {
					if (is_array($polygon) && count($polygon) === 2) {
						[$lng, $lat] = $polygon;
						// Balik koordinat jika lng lebih besar dari lat
						if (abs($lng) < abs($lat)) {
							return [$lat, $lng];
						}
					}
					return $polygon; // Tetap gunakan point asli jika tidak memenuhi kriteria
					// }, $polygon);
				}, $coordinates->coordinates);

				$result[] = [
					'properties' => $this->propertiesData($item->lahan_id),
					'type' => 'Feature',
					'geometry' => [
						'type' => 'Polygon',
						'coordinates' => $flippedCoordinates
					],

				];
			}
		}

		$response = [
			'type' => 'FeatureCollection',
			'features' => $result
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response, JSON_PRETTY_PRINT));
	}

	private function propertiesData($id)
	{
		$data = $this->db->get_where('lahan', ['id_lahan' => $id])->row_array();
		return $data;
	}

	public function print($id)
	{
		$data['data'] = $this->M_lahan->show_by_id($id);
		$dataPemetaan = $this->db->get_where('pemetaan_blok', ['lahan_id' => $id])->row()->coordinates;
		$jsonDecode = json_decode($dataPemetaan);

		// Pastikan data 'coordinates' adalah array
		if (isset($jsonDecode->coordinates) && is_array($jsonDecode->coordinates)) {
			$data['tikor'] = $this->calculateCentroid($jsonDecode->coordinates);
		} else {
			$data['tikor'] = null; // Atau berikan pesan error
		}

		// $this->output->set_content_type('application/json')->set_output(json_encode($data));

		$this->load->view('administrator/data_lahan/print_map', $data);
	}

	function calculateCentroid($coordinates)
	{
		$sumLatitude = 0;
		$sumLongitude = 0;
		$totalPoints = count($coordinates[0]);
		// Pastikan $coordinates adalah array dua dimensi
		if ($totalPoints > 0 && is_array($coordinates[0])) {
			foreach ($coordinates[0] as $point) {
				if (is_array($point) && count($point) == 2) {
					$sumLongitude += $point[0]; // Bujur
					$sumLatitude += $point[1];   // Lintang
				}
			}

			// 	// Hitung rata-rata bujur dan lintang untuk titik tengah
			$centroidLongitude = $sumLongitude / $totalPoints;
			$centroidLatitude = $sumLatitude / $totalPoints;

			return ['kordinat' => $centroidLongitude . ',' . $centroidLatitude, 'lintang' => $this->convertCoordinateToDMS($centroidLatitude, 'latitude'), 'bujur' => $this->convertCoordinateToDMS($centroidLongitude, 'longitude')];
		}

		// return ['longitude' => 0, 'latitude' => 0]; // Kembalikan nilai default jika data tidak valid
	}

	function convertCoordinateToDMS($coordinate, $type)
	{
		$isNegative = $coordinate < 0;
		$absoluteCoordinate = abs($coordinate);

		// Hitung derajat, menit, dan detik
		$degrees = floor($absoluteCoordinate);
		$minutes = floor(($absoluteCoordinate - $degrees) * 60);
		$seconds = (($absoluteCoordinate - $degrees - ($minutes / 60)) * 3600);

		// Tentukan label untuk lintang/bujur
		$hemisphere = '';
		if ($type === 'latitude') {
			$hemisphere = $isNegative ? 'LS' : 'LU'; // Lintang
		} elseif ($type === 'longitude') {
			$hemisphere = $isNegative ? 'BB' : 'BT'; // Bujur
		}

		// Format hasil dengan dua digit detik
		return sprintf('%d°%d\'%.2f" %s', $degrees, $minutes, $seconds, $hemisphere);
	}


	public function  cetakpdf()
	{
		$data['data'] = $this->M_lahan->show_lahan()->result();
		$this->load->view('administrator/data_lahan/print_all', $data);
	}
}
