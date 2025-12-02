<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrob123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama, c.nama_ketua FROM tkr_orbitasi AS a LEFT JOIN kecamatan AS b ON a.id_kec = b.id LEFT JOIN ipw_kecamatan AS c ON a.id_tkr_kode_ipwkec = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_orbitasi WHERE id='$a' ORDER BY id";
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

	public function tambah($no_urut, $uraian, $jarak, $jenis_jalan, $kondisi_jalan, $id_kec, $id_tkr_kode_ipwkec)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_orbitasi VALUES('$id', '$no_urut', '$uraian', '$jarak', '$jenis_jalan','$kondisi_jalan', '$id_kec','$id_tkr_kode_ipwkec',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $no_urut, $uraian, $jarak, $jenis_jalan, $kondisi_jalan, $id_kec, $id_tkr_kode_ipwkec)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_orbitasi SET no_urut='$no_urut', uraian='$uraian', jarak='$jarak', jenis_jalan='$jenis_jalan', kondisi_jalan='$kondisi_jalan', id_kec='$id_kec', id_tkr_kode_ipwkec='$id_tkr_kode_ipwkec', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_orbitasi WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
