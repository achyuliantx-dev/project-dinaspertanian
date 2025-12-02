<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrprodtm123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama AS nama_kec, c.nama AS nama_des, d.nama_ketua FROM tkr_produktifitas_tanam AS a LEFT JOIN kecamatan AS b ON a.id_kec = b.id LEFT JOIN desa AS c ON a.id_des = c.id LEFT JOIN ipw_desa AS d ON a.id_tkr_kode_ipwdes = d.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_produktifitas_tanam WHERE id='$a' ORDER BY id";
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

	public function tambah($jenis_tanaman, $luas_tanam, $luas_panen, $produksi, $produktivitas, $tahun, $id_des,$id_kec, $id_tkr_kode_ipwdes, $nama_tanaman)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_produktifitas_tanam VALUES('$id', '$jenis_tanaman', '$luas_tanam', '$luas_panen', '$produksi', '$produktivitas', '$tahun', '$id_des', '$id_kec', '$id_tkr_kode_ipwdes', '$nama_tanaman',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $jenis_tanaman, $luas_tanam, $luas_panen, $produksi, $produktivitas, $tahun, $id_des, $id_kec, $id_tkr_kode_ipwdes, $nama_tanaman)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_produktifitas_tanam SET jenis_tanaman='$jenis_tanaman', luas_tanam='$luas_tanam', luas_panen='$luas_panen', produksi='$produksi', produktivitas='$produktivitas', tahun='$tahun', id_des='$id_des', id_kec='$id_kec', id_tkr_kode_ipwdes='$id_tkr_kode_ipwdes', nama_tanaman='$nama_tanaman', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_produktifitas_tanam WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
