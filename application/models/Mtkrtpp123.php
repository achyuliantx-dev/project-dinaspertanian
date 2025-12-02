<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrtpp123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama AS nama_kec, c.nama_ketua FROM tkr_tingkat_pendidikan_penduduk AS a LEFT JOIN kecamatan AS b ON a.id_kec = b.id LEFT JOIN ipw_kecamatan AS c ON a.id_tkr_kode_ipwkec = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_tingkat_pendidikan_penduduk WHERE id='$a' ORDER BY id";
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

	public function tambah($no_urut, $tingkat_pendidikan, $jumlah,  $tahun, $id_kec, $id_tkr_kode_ipwkec)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_tingkat_pendidikan_penduduk VALUES('$id', '$no_urut', '$tingkat_pendidikan','$jumlah', '$tahun',  '$id_kec', '$id_tkr_kode_ipwkec',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $no_urut, $tingkat_pendidikan, $jumlah,  $tahun, $id_kec, $id_tkr_kode_ipwkec)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_tingkat_pendidikan_penduduk SET no_urut='$no_urut', tingkat_pendidikan='$tingkat_pendidikan',  jumlah='$jumlah', tahun='$tahun', id_kec='$id_kec', id_tkr_kode_ipwkec='$id_tkr_kode_ipwkec', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_tingkat_pendidikan_penduduk WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
