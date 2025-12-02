<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrpt123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama AS nama_kec, c.nama_ketua FROM tkr_pola_tanam AS a LEFT JOIN kecamatan AS b ON a.id_kec = b.id LEFT JOIN tkr_kode_ipwkec AS c ON a.id_tkr_kode_ipwkec = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_pola_tanam WHERE id='$a' ORDER BY id";
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

	public function tambah($nama_pola_tanam, $luas, $keterangan, $tahun, $id_kec, $id_tkr_kode_ipwkec)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_pola_tanam VALUES('$id', '$nama_pola_tanam', '$luas', '$keterangan','$tahun', '$id_kec', '$id_tkr_kode_ipwkec,  NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $nama_pola_tanam, $luas, $keterangan, $tahun, $id_kec, $id_tkr_kode_ipwkec)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_pola_tanam SET $nama_pola_tanam='$nama_pola_tanam', $luas='$luas', $keterangan='$keterangan', tahun='$tahun', id_kec='$id_kec', id_tkr_kode_ipwkec='$id_tkr_kode_ipwkec',  tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_pola_tanam WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
