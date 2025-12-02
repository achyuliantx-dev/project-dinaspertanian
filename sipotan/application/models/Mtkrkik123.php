<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrkik123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT a.*, b.nama AS nama_des FROM ipw_kecamatan AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM ipw_kecamatan WHERE id='$a' ORDER BY id";
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

	public function tambah($nama_ketua, $id_kecamatan, $batas_utara_des, $batas_utara_kec, $batas_selatan_des, $batas_selatan_kec, $batas_timur_des, $batas_timur_kec, $batas_barat_des, $batas_barat_kec, $alamat, $bujur, $lintang)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO ipw_kecamatan VALUES('$id', '$nama_ketua', '$id_kecamatan', '$batas_utara_des', '$batas_utara_kec', '$batas_selatan_des', '$batas_selatan_kec', '$batas_timur_des', '$batas_timur_kec', '$batas_barat_des', '$batas_barat_kec', '$alamat', '$bujur', '$lintang',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $nama_ketua, $id_kecamatan, $batas_utara_des, $batas_utara_kec,  $batas_selatan_des, $batas_selatan_kec, $batas_timur_des,  $batas_timur_kec, $batas_barat_des, $batas_barat_kec, $alamat, $bujur, $lintang)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE ipw_kecamatan SET $nama_ketua='$nama_ketua', $id_kecamatan='$id_kecamatan', $batas_utara_des='$batas_utara_des', $batas_utara_kec='$batas_utara_kec', $batas_selatan_des='$batas_selatan_des', batas_selatan_kec='$batas_selatan_kec', batas_timur_des='$batas_timur_des', batas_timur_kec='$batas_timur_kec', batas_barat_des='$batas_barat_des',batas_barat_kec='$batas_barat_kec',alamat='$alamat',bujur='$bujur',lintang='$lintang', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM ipw_kecamatan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
