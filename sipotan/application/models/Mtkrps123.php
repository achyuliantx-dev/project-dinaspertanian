<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrps123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama, c.nama_ketua FROM tkr_penyedia_saprodi AS a LEFT JOIN kecamatan AS b ON a.id_kec = b.id LEFT JOIN ipw_kecamatan AS c ON a.id_tkr_kode_ipwkec = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_penyedia_saprodi WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function cekform($a)
	{
		$sql = "SELECT * FROM form_level WHERE id_form='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function tambah($kondisi_baik, $kondisi_buruk, $id_kec, $id_tkr_kode_ipwkec, $tahun, $jumlah_seluruh, $jenis_usaha)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_penyedia_saprodi VALUES('$id', '$kondisi_baik', '$kondisi_buruk', '$id_kec', '$id_tkr_kode_ipwkec', '$tahun','$jumlah_seluruh', '$jenis_usaha',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $kondisi_baik, $kondisi_buruk, $id_kec, $id_tkr_kode_ipwkec, $tahun, $jumlah_seluruh, $jenis_usaha)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_penyedia_saprodi SET kondisi_baik='$kondisi_baik', kondisi_buruk='$kondisi_buruk', id_kec='$id_kec', id_tkr_kode_ipwkec='$id_tkr_kode_ipwkec', tahun='$tahun', jumlah_seluruh='$jumlah_seluruh', jenis_usaha='$jenis_usaha', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_penyedia_saprodi WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
