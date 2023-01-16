<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public function getSubMenu()
	{
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
				  FROM `user_sub_menu` JOIN `user_menu`
				  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
				";
		return $this->db->query($query)->result_array();
	}

	// Data Menu
	public function deleteMenuById($id)
	{
		return $this->db->delete('user_menu', ['id' => $id]);
	}

	public function editMenuById($id, $data)
	{
		return $this->db->where('id', $id)->update('user_menu', $data);
	}

	// Data Sub Menu
	public function deleteSubMenuById($id)
	{
		return $this->db->delete('user_sub_menu', ['id' => $id]);
	}

	public function editSubMenuById($id, $data)
	{
		return $this->db->where('id', $id)->update('user_sub_menu', $data);
	}

	// Data Role
	public function deleteRoleById($id)
	{
		return $this->db->delete('user_role', ['id' => $id]);
	}

	public function editRoleById($id, $data)
	{
		return $this->db->where('id', $id)->update('user_role', $data);
	}

	// Data User
	public function editUserById($id, $data)
	{
		return $this->db->where('id', $id)->update('user', $data);
	}

	public function editPasswordUserById($id, $data)
	{
		return $this->db->where('id', $id)->update('user', $data);
	}

	public function getAutoSearch($keyword)
	{
		$query = "SELECT * FROM pelanggan WHERE cid LIKE '%" . $keyword . "%' ORDER BY cid LIMIT 10
		";
		return $this->db->query($query)->result_array();
	}

	// Kriteria
	public function kodeKriteria()
	{
		$query = "SELECT max(kd_kriteria) as kodeTerbesar FROM kriteria";
		return $this->db->query($query)->row_array();
	}

	public function editKriteriaById($id, $data)
	{
		return $this->db->where('kd_kriteria', $id)->update('kriteria', $data);
	}

	public function deleteKriteriaById($id)
	{
		return $this->db->delete('kriteria', ['kd_kriteria' => $id]);
	}

	// Bobot
	public function kodeBobot()
	{
		$query = "SELECT max(kd_bobot) as kodeTerbesar FROM bobot";
		return $this->db->query($query)->row_array();
	}

	public function editBobotById($id, $data)
	{
		return $this->db->where('kd_bobot', $id)->update('bobot', $data);
	}

	public function deleteBobotById($id)
	{
		return $this->db->delete('bobot', ['kd_bobot' => $id]);
	}

	// Paket
	public function kodePaket()
	{
		$query = "SELECT max(kd_paket) as kodeTerbesar FROM paket";
		return $this->db->query($query)->row_array();
	}

	public function editPaketById($id, $data)
	{
		return $this->db->where('kd_paket', $id)->update('paket', $data);
	}

	public function deletePaketById($id)
	{
		return $this->db->delete('paket', ['kd_paket' => $id]);
	}

	// Tes Minat
	public function kodeTesMinat()
	{
		$query = "SELECT max(kd_tes) as kodeTerbesar FROM tes_minat";
		return $this->db->query($query)->row_array();
	}

	public function editTesMinatById($id, $data)
	{
		return $this->db->where('kd_tes', $id)->update('tes_minat', $data);
	}

	public function deleteTesMinatById($id)
	{
		return $this->db->delete('tes_minat', ['kd_tes' => $id]);
	}

	// Soal Tes
	public function editSoalTesById($id, $data)
	{
		return $this->db->where('kd_soal', $id)->update('soal_tes', $data);
	}

	public function deleteSoalTesById($id)
	{
		return $this->db->delete('soal_tes', ['kd_soal' => $id]);
	}

	// Nilai Soal Tes
	public function editNilaiSoalTesById($id, $data)
	{
		return $this->db->where('kd_nilai', $id)->update('nilai_soal_tes', $data);
	}

	public function deleteNilaiSoalTesById($id)
	{
		return $this->db->delete('nilai_soal_tes', ['kd_nilai' => $id]);
	}

	// Form Pelanggan
	public function kodeFormPelanggan()
	{
		$query = "SELECT max(kd_pelanggan) as kodeTerbesar FROM pelanggan";
		return $this->db->query($query)->row_array();
	}

	public function editPelangganById($id, $data)
	{
		return $this->db->where('kd_pelanggan', $id)->update('pelanggan', $data);
	}

	public function deletePelangganById($id)
	{
		return $this->db->delete('pelanggan', ['kd_pelanggan' => $id]);
	}

	public function nilaiSPK($kd)
	{
		$query = "SELECT *, MAX(nilai) as totalNilai
		FROM `nilai_spk`
		WHERE kd_pelanggan = '$kd' GROUP BY kd_paket ORDER BY nilai ASC";
		return $this->db->query($query)->result_array();
	}
}
