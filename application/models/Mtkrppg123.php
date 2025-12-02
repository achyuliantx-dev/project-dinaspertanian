<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrppg123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama AS nama_kec, c.nama_ketua FROM tkr_petugas_pendamping AS a LEFT JOIN kecamatan AS b ON a.id_kec = b.id LEFT JOIN ipw_kecamatan AS c ON a.id_tkr_kode_ipwkec = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_petugas_pendamping WHERE id='$a' ORDER BY id";
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

	public function tambah($petugas, $jumlah, $id_kec, $id_tkr_kode_ipwkec, $tahun)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_petugas_pendamping VALUES('$id', '$petugas', '$jumlah', '$id_kec', '$id_tkr_kode_ipwkec', '$tahun', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $petugas, $jumlah, $id_kec, $id_tkr_kode_ipwkec, $tahun)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_petugas_pendamping SET petugas='$petugas', jumlah='$jumlah', id_kec='$id_kec', id_tkr_kode_ipwkec='$id_tkr_kode_ipwkec', tahun='$tahun', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_petugas_pendamping WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
