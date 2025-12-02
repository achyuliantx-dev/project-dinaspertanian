<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrkid123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama AS nama_des , c.nama AS nama_kec FROM ipw_desa AS a LEFT JOIN desa AS b ON a.id_desa = b.id LEFT JOIN kecamatan AS c ON a.id_kecamatan = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM ipw_desa WHERE id='$a' ORDER BY id";
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

	public function tambah($nama_ketua, $id_desa, $id_kecamatan, $batas_utara_des, $batas_utara_kec, $batas_selatan_des, $batas_selatan_kec, $batas_timur_des, $batas_timur_kec, $batas_barat_des, $batas_barat_kec)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO ipw_desa VALUES('$id', '$nama_ketua', '$id_desa', '$id_kecamatan', '$batas_utara_des', '$batas_utara_kec', '$batas_selatan_des', '$batas_selatan_kec', '$batas_timur_des', '$batas_timur_kec', '$batas_barat_des', '$batas_barat_kec',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $nama_ketua, $id_desa, $id_kecamatan, $batas_utara_des, $batas_utara_kec,  $batas_selatan_des, $batas_selatan_kec, $batas_timur_des,  $batas_timur_kec, $batas_barat_des, $batas_barat_kec)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE ipw_desa SET $nama_ketua='$nama_ketua',  $id_desa='$id_desa',$id_kecamatan='$id_kecamatan', $batas_utara_des='$batas_utara_des', $batas_utara_kec='$batas_utara_kec', $batas_selatan_des='$batas_selatan_des', batas_selatan_kec='$batas_selatan_kec', batas_timur_des='$batas_timur_des', batas_timur_kec='$batas_timur_kec', batas_barat_des='$batas_barat_des',batas_barat_kec='$batas_barat_kec', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM ipw_desa WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
