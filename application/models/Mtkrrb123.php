<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrrb123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT * FROM tkr_rincian_bulanan ORDER BY id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_rincian_bulanan WHERE id='$a' ORDER BY id";
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

	public function tambah($target, $nip, $realisasi, $bulan_ke, $tahun, $kode_jenjang, $triwulan, $no_urut_rencana, $pangkat_gol_asli)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_rincian_bulanan VALUES('$id', '$target', '$nip', '$realisasi', '$bulan_ke', '$tahun', '$kode_jenjang', '$triwulan', '$no_urut_rencana', '$pangkat_gol_asli', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $target, $nip, $realisasi, $bulan_ke, $tahun, $kode_jenjang, $triwulan, $no_urut_rencana, $pangkat_gol_asli)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_rincian_bulanan SET target='$target', nip='$nip', realisasi='$realisasi', bulan_ke='$bulan_ke', tahun='$tahun', kode_jenjang='$kode_jenjang',triwulan='$triwulan', no_urut_rencana='$no_urut_rencana', pangkat_gol_asli='$pangkat_gol_asli', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_rincian_bulanan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
