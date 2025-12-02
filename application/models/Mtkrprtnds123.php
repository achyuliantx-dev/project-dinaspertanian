<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrprtnds123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama AS nama_kec, c.nama AS nama_des, d.nama_ketua FROM tkr_pertanian_des AS a LEFT JOIN kecamatan AS b ON a.id_kec = b.id LEFT JOIN desa AS c ON a.id_des = c.id LEFT JOIN ipw_desa AS d ON a.id_tkr_kode_ipwdes = d.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_pertanian_des WHERE id='$a' ORDER BY id";
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

	public function tambah($kode_lahan, $jenis_pertanian, $luas_jumlah, $keterangan, $uraian, $tahun, $id_des, $id_kec, $id_tkr_kode_ipwdes)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_pertanian_des VALUES('$id', '$kode_lahan', '$jenis_pertanian', '$luas_jumlah', '$keterangan', '$uraian', '$tahun', '$id_des', '$id_kec', '$id_tkr_kode_ipwdes',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $kode_lahan, $jenis_pertanian, $luas_jumlah, $keterangan, $uraian, $tahun, $id_des, $id_kec, $id_tkr_kode_ipwdes)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_pertanian_des SET kode_lahan='$kode_lahan', jenis_pertanian='$jenis_pertanian', luas_jumlah='$luas_jumlah', keterangan='$keterangan', uraian='$uraian', tahun='$tahun', id_des='$id_des', id_kec='$id_kec', id_tkr_kode_ipwdes='$id_tkr_kode_ipwdes', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_pertanian_des WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
