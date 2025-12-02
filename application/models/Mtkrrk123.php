<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrrk123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT * FROM tkr_realisasi_kegiatan ORDER BY id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_realisasi_kegiatan WHERE id='$a' ORDER BY id";
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

	public function tambah($bulan_ke, $tahun, $nip, $kode_jenjang, $no_urut_rencana, $pangkat_gol_asli, $no_urut_relasi, $tanggal_relasi, $penjelasan, $alternatif, $bukti_fisik, $is_tpp)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_realisasi_kegiatan VALUES('$id', '$bulan_ke', '$tahun', '$nip', '$kode_jenjang', '$no_urut_rencana', '$pangkat_gol_asli', '$no_urut_relasi', '$tanggal_relasi', '$penjelasan', '$alternatif', '$bukti_fisik', '$is_tpp', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $bulan_ke, $tahun, $nip, $kode_jenjang, $no_urut_rencana, $pangkat_gol_asli, $no_urut_relasi, $tanggal_relasi, $penjelasan, $alternatif, $bukti_fisik, $is_tpp)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_realisasi_kegiatan SET bulan_ke='$bulan_ke', tahun='$tahun', nip='$nip', kode_jenjang='$kode_jenjang', no_urut_rencana='$no_urut_rencana', pangkat_gol_asli='$pangkat_gol_asli', no_urut_relasi='$no_urut_relasi', tanggal_relasi='$tanggal_relasi', penjelasan='$penjelasan', alternatif='$alternatif', bukti_fisik='$bukti_fisik', is_tpp='$is_tpp', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_realisasi_kegiatan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
