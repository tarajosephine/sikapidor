<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model', 'mm');
	}

	public function index()
	{
		$data['title'] = 'Home';
		$data['tes'] = $this->db->get('tes_minat')->result_array();
		$data['soal'] = $this->db->get('soal_tes')->result_array();
		$data['bobot'] = $this->db->get('bobot')->result_array();
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/index', $data);
		$this->load->view('templates/frondendFooter', $data);
	}

	public function Tentang()
	{
		$data['title'] = 'Tentang';
		$data['tes'] = $this->db->get('tes_minat')->result_array();
		$data['soal'] = $this->db->get('soal_tes')->result_array();
		$data['paket'] = $this->db->get('paket')->result_array();
		$data['bobot'] = $this->db->get('bobot')->result_array();
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/tentang', $data);
		$this->load->view('templates/frondendFooter', $data);
	}

	public function Contactus()
	{
		$data['title'] = 'Contact Us';
		$data['tes'] = $this->db->get('tes_minat')->result_array();
		$data['soal'] = $this->db->get('soal_tes')->result_array();
		$data['bobot'] = $this->db->get('bobot')->result_array();
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/contact', $data);
		$this->load->view('templates/frondendFooter', $data);
	}

	public function cdFormPelanggan()
	{
		$kode = $this->mm->kodeFormPelanggan();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "P";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function updateFormPelanggan()
	{
		$vld = $this->input->post('validasi');
		$soal = $this->db->get('soal_tes')->result_array();
		$kd_pelanggan = $this->input->post('kd_responden');
		$data = [
			'kd_pelanggan' => $kd_pelanggan,
			'nama' => $this->input->post('namad') . " " . $this->input->post('namab'),
			'no_hp' => $this->input->post('nohp'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat')
		];
		if ($vld == "new") {
			$this->db->insert('pelanggan', $data);
			foreach ($soal as $s) :
				$data_responden = [
					'kd_pelanggan' => $kd_pelanggan,
					'kd_tes' => $s['kd_tes'],
					'kd_soal' => $s['kd_soal'],
					'nilai' => $this->input->post(1 . $s['kd_soal'] . $s['kd_tes'])
				];
				$this->db->insert('responden', $data_responden);

			endforeach;
			$vl = [
				'pesan' => $vld,
				'url' => '/Pelayanan/cdFormPelanggan',
				'kd_input' => '#kd_responden',
				'status' => 200,
			];
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function saw($kd)
	{
		$this->db->select('tes_minat.*, soal_tes.kd_soal, soal_tes.soal, nilai_soal_tes.kd_paket, nilai_soal_tes.nilai');
		$this->db->from('tes_minat');
		$this->db->join('soal_tes', 'soal_tes.kd_tes = tes_minat.kd_tes');
		$this->db->join('nilai_soal_tes', 'soal_tes.kd_soal = nilai_soal_tes.kd_soal');
		$this->db->order_by('soal_tes.kd_soal');
		$dataSoal = $this->db->get()->result_array();
		foreach ($dataSoal as $d) :

			$nilaiR = $this->db->get_where('responden', ['kd_pelanggan' => $kd, 'kd_tes' => $d['kd_tes']])->result_array();
			if ($d['atribut'] == "Benefit") {
				$this->db->select_max('nilai');
				$this->db->from('nilai_soal_tes');
				$this->db->where('kd_paket', $d['kd_paket']);
				$nilai_max = $this->db->get()->row_array();

				$hasil_n_max = $d['nilai'] / $nilai_max['nilai'];
				foreach($nilaiR as $nr) :
					$hasil[] = $hasil_n_max * $nr['nilai'];
				endforeach;
				$jml_akhir = array_sum($hasil);
			} else {
				$this->db->select_min('nilai');
				$this->db->from('nilai_soal_tes');
				$this->db->where('kd_paket', $d['kd_paket']);
				$nilai_min = $this->db->get()->row_array();

				$hasil_n_min = $d['nilai'] / $nilai_min['nilai'];
				foreach ($nilaiR as $nr) :
					$hasil[] = $hasil_n_min * $nr['nilai'];
				endforeach;
				$jml_akhir = array_sum($hasil);
			}

			$data_spk = [
				'kd_pelanggan' => $kd,
				'kd_paket' => $d['kd_paket'],
				'nilai' => $jml_akhir
			];
			$this->db->insert('nilai_spk', $data_spk);
		endforeach;
		redirect('Pelayanan/Rekomendasi/'.$kd);
	}

	public function Rekomendasi($kd)
	{
		$data['title'] = 'Rekomdasi';
		$data['tes'] = $this->db->get('tes_minat')->result_array();
		$data['soal'] = $this->db->get('soal_tes')->result_array();
		$data['bobot'] = $this->db->get('bobot')->result_array();
		$data['spk'] = $this->mm->nilaiSPK($kd);
		$data['paket'] = $this->db->get('paket')->result_array();
		$this->load->view('templates/frondendHeader', $data);
		$this->load->view('pelayanan/rekomendasi', $data);
		$this->load->view('templates/frondendFooter', $data);
	}
}
