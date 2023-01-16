<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Menu_model', 'menu');
	}

	public function index()
	{
		$data['title'] = 'Pelanggan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/index', $data);
		$this->load->view('templates/footer');
	}

	public function tablePelanggan()
	{
		$output['data'] = $this->db->get('pelanggan')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updatePelanggan()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_kriteria' => $this->input->post('kd_kriteria'),
			'kriteria' => $this->input->post('kriteria'),
			'atribut' => $this->input->post('atribut'),
			'status' => $is_active,
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => $vld,
				'url' => '/Management/cdKriteria',
				'kd_input' => '#kd_kriteria',
				'status' => 200,
			];
			$this->db->insert('kriteria', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => $vld,
				'status' => 200,
			];
			$this->menu->editKriteriaById($_POST['kd_kriteria'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getPelangganModal()
	{
		$data = $this->db->get_where('pelanggan', ['kd_pelanggan' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deletePelangganModal()
	{
		$result = $this->menu->deletePelangganById($this->input->post('id'));
		echo json_decode($result);
	}

	// ##################################################################################################################################
	// Pelanggan
	public function showPelanggan($id)
	{
		$data['title'] = 'Detail Pelanggan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kd_pelanggan'] = $id;
		$data['pelanggan'] = $this->db->get_where('pelanggan', ['kd_pelanggan' => $id])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/showPelanggan', $data);
		$this->load->view('templates/footer');
	}

	public function tableDetailPelanggan($id)
	{
		$this->db->select('responden.*, tes_minat.kriteria, soal_tes.soal');
		$this->db->from('responden');
		$this->db->join('tes_minat', 'tes_minat.kd_tes = responden.kd_tes');
		$this->db->join('soal_tes', 'soal_tes.kd_soal = responden.kd_soal');
		$this->db->where('responden.kd_pelanggan', $id);
		$output['data'] = $this->db->get()->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	//##################################################################################################################################
	// Bobot
	public function bobot()
	{
		$data['title'] = 'Bobot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/bobot');
		$this->load->view('templates/footer');
	}

	public function cdBobot()
	{
		$kode = $this->menu->kodeBobot();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "B";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function tableBobot()
	{
		$output['data'] = $this->db->get('bobot')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateBobot()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_bobot' => $this->input->post('kd_bobot'),
			'nilai_bobot' => $this->input->post('nilai_bobot'),
			'bobot' => $this->input->post('bobot'),
			'status' => $is_active,
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => $vld,
				'url' => '/Management/cdBobot',
				'kd_input' => '#kd_bobot',
				'status' => 200,
			];
			$this->db->insert('bobot', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => $vld,
				'status' => 200,
			];
			$this->menu->editBobotById($_POST['kd_bobot'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getBobotModal()
	{
		$data = $this->db->get_where('bobot', ['kd_bobot' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteBobotModal()
	{
		$result = $this->menu->deleteBobotById($this->input->post('id'));
		echo json_decode($result);
	}

	//##################################################################################################################################
	// Paket
	public function paket()
	{
		$data['title'] = 'Paket Wedding';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/paket');
		$this->load->view('templates/footer');
	}

	public function cdPaket()
	{
		$kode = $this->menu->kodePaket();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "P";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function tablePaket()
	{
		$output['data'] = $this->db->get('paket')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updatePaket()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$totalHarga = $this->input->post('harga_wo') + $this->input->post('harga_dekorasi') + $this->input->post('harga_brp') + $this->input->post('harga_catering') + $this->input->post('harga_dokumentasi') + $this->input->post('harga_ah');
		$data = [
			'kd_paket' => $this->input->post('kd_paket'),
			'paket' => $this->input->post('paket'),
			'harga' => $totalHarga,
			'kru' => $this->input->post('kru'),
			'harga_wo' => $this->input->post('harga_wo'),
			'dekorasi' => $this->input->post('dekorasi'),
			'harga_dekorasi' => $this->input->post('harga_dekorasi'),
			'brp' => $this->input->post('brp'),
			'harga_brp' => $this->input->post('harga_brp'),
			'catering' => $this->input->post('catering'),
			'harga_catering' => $this->input->post('harga_catering'),
			'dokumentasi' => $this->input->post('dokumentasi'),
			'harga_dokumentasi' => $this->input->post('harga_dokumentasi'),
			'ah' => $this->input->post('ah'),
			'harga_ah' => $this->input->post('harga_ah'),
			'jumlah_tamu' => $this->input->post('jumlah_tamu'),
			'jumlah_tamu2' => $this->input->post('jumlah_tamu2'),
			'status' => $is_active
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => $vld,
				'url' => '/Management/cdPaket',
				'kd_input' => '#kd_paket',
				'status' => 200,
			];
			$this->db->insert('paket', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => $vld,
				'status' => 200,
			];
			$this->menu->editPaketById($_POST['kd_paket'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getPaketModal()
	{
		$data = $this->db->get_where('paket', ['kd_paket' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deletePaketModal()
	{
		$result = $this->menu->deletePaketById($this->input->post('id'));
		echo json_decode($result);
	}

	//##################################################################################################################################
	// Paket
	public function showPaket($id)
	{
		$data['title'] = 'Detail Paket Wedding';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['paket'] = $this->db->get_where('paket', ['kd_paket' => $id])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/showPaket');
		$this->load->view('templates/footer');
	}

	//##################################################################################################################################
	// Tes Minat
	public function tesMinat()
	{
		$data['title'] = 'Tes Minat';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/tesMinat');
		$this->load->view('templates/footer');
	}

	public function cdTesMinat()
	{
		$kode = $this->menu->kodeTesMinat();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "T";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function tableTesMinat()
	{
		$output['data'] = $this->db->get('tes_minat')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateTesMinat()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_tes' => $this->input->post('kd_tes'),
			'kriteria' => $this->input->post('kriteria'),
			'atribut' => $this->input->post('atribut'),
			'status' => $is_active,
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => $vld,
				'url' => '/Management/cdTesMinat',
				'kd_input' => '#kd_tes',
				'status' => 200,
			];
			$this->db->insert('tes_minat', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => $vld,
				'status' => 200,
			];
			$this->menu->editTesMinatById($_POST['kd_tes'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getTesMinatModal()
	{
		$data = $this->db->get_where('tes_minat', ['kd_tes' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteTesMinatModal()
	{
		$result = $this->menu->deleteTesMinatById($this->input->post('id'));
		echo json_decode($result);
	}

	//##################################################################################################################################
	// Soal Tes
	public function showSoalTes($id)
	{
		$data['title'] = 'Soal Tes Minat';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kd_tesMinat'] = $id;
		$data['tesMinat'] = $this->db->get_where('tes_minat', ['kd_tes' => $id])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/soalTes');
		$this->load->view('templates/footer');
	}

	public function tableSoalTes($id)
	{
		$this->db->select('soal_tes.*, tes_minat.kd_tes, tes_minat.kriteria');
		$this->db->from('soal_tes');
		$this->db->join('tes_minat', 'tes_minat.kd_tes = soal_tes.kd_tes');
		$this->db->where('soal_tes.kd_tes', $id);
		$output['data'] = $this->db->get()->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateSoalTes()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_tes' => $this->input->post('kd_tes'),
			'soal' => $this->input->post('soal'),
			'status' => $is_active,
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => $vld,
				'url' => '',
				'status' => 200,
			];
			$this->db->insert('soal_tes', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => $vld,
				'status' => 200,
			];
			$this->menu->editSoalTesById($_POST['kd_soal'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getSoalTesModal()
	{
		$data = $this->db->get_where('soal_tes', ['kd_soal' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteSoalTesModal()
	{
		$result = $this->menu->deleteSoalTesById($this->input->post('id'));
		echo json_decode($result);
	}

	//##################################################################################################################################
	// Nilai Soal Tes
	public function showNilaiSoalTes($id)
	{
		$data['title'] = 'Nilai Soal Tes Minat';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kd_soalTes'] = $id;
		$data['soaTes'] = $this->db->get_where('soal_tes', ['kd_soal' => $id])->row_array();
		$data['paket'] = $this->db->get('paket')->result_array();
		$data['nilaiBobot'] = $this->db->get('bobot')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/nilaiSoalTes');
		$this->load->view('templates/footer');
	}

	public function tableNilaiSoalTes($id)
	{
		$this->db->select('nilai_soal_tes.*, paket.kd_paket, paket.paket, paket.harga');
		$this->db->from('nilai_soal_tes');
		$this->db->join('soal_tes', 'soal_tes.kd_soal = nilai_soal_tes.kd_soal');
		$this->db->join('paket', 'paket.kd_paket = nilai_soal_tes.kd_paket');
		$this->db->where('nilai_soal_tes.kd_soal', $id);
		$output['data'] = $this->db->get()->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function chekPaket()
	{
		$output = $this->db->get_where('nilai_soal_tes', ['kd_soal' => $_POST['kd_soal'], 'kd_paket' => $_POST['kd_paket']])->row_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateNilaiSoalTes()
	{
		$vld = $this->input->post('validasi');
		$data = [
			'kd_nilai' => $this->input->post('kd_nilai'),
			'kd_soal' => $this->input->post('kd_soal'),
			'kd_paket' => $this->input->post('kd_paket'),
			'nilai' => $this->input->post('nilai')
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => $vld,
				'url' => '',
				'status' => 200,
			];
			$this->db->insert('nilai_soal_tes', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => $vld,
				'status' => 200,
			];
			$this->menu->editNilaiSoalTesById($_POST['kd_nilai'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getNilaiSoalTesModal()
	{
		$data = $this->db->get_where('nilai_soal_tes', ['kd_nilai' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteNilaiSoalTesModal()
	{
		$result = $this->menu->deleteNilaiSoalTesById($this->input->post('id'));
		echo json_decode($result);
	}
}
