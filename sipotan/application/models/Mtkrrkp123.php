<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mtkrrkp123 extends CI_Model
{
	public function data()
	{
		$sql = "SELECT * FROM tkr_rencana_kerja_pegawai ORDER BY id";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return $querySQL->result();
		} else {
			return 0;
		}
	}

	public function filter($a)
	{
		$sql = "SELECT * FROM tkr_rencana_kerja_pegawai WHERE id='$a' ORDER BY id";
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

	public function tambah($tahun, $nip, $kode_jenjang, $no_urut_rencana, $narasi_rencana, $target_kinerja, $indikator_kinerja, $ak, $output_jumlah, $output_satuan, $waktu, $biaya, $formulasi, $sumber_data, $pangkat_gol_asli, $no_urut_tupoksi, $kode_range_pangkat, $kode_jenjang_tupoksi, $mutu, $pangkat_aktif, $kelompok_tupoksi, $kuantitas, $bobot_kerja)
	{
		$user = $this->Mlogin->ambiluser();
		$id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO tkr_rencana_kerja_pegawai VALUES('$id', '$tahun', '$nip', '$kode_jenjang', '$no_urut_rencana', '$narasi_rencana', '$target_kinerja', '$indikator_kinerja', '$ak', '$output_jumlah', '$output_satuan', '$waktu', '$biaya', '$formulasi', '$sumber_data', '$pangkat_gol_asli', '$no_urut_tupoksi', '$kode_range_pangkat', '$kode_jenjang_tupoksi', '$mutu', '$pangkat_aktif','$kelompok_tupoksi','$kuantitas', '$bobot_kerja',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function update($id, $tahun, $nip, $kode_jenjang, $no_urut_rencana, $narasi_rencana, $target_kinerja, $indikator_kinerja, $ak, $output_jumlah, $output_satuan,  $waktu, $biaya, $formulasi, $sumber_data, $pangkat_gol_asli, $no_urut_tupoksi, $kode_range_pangkat, $kode_jenjang_tupoksi, $mutu, $pangkat_aktif, $kelompok_tupoksi, $kuantitas, $bobot_kerja)
	{
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tkr_rencana_kerja_pegawai SET tahun='$tahun', nip='$nip', kode_jenjang='$kode_jenjang', no_urut_rencana='$no_urut_rencana', narasi_rencana='$narasi_rencana', target_kinerja='$target_kinerja',indikator_kinerja='$indikator_kinerja', ak='$ak', output_jumlah='$output_jumlah', output_satuan='$output_satuan', waktu='$waktu', biaya='$biaya', formulasi='$formulasi',sumber_data='$sumber_data', pangkat_gol_asli='$pangkat_gol_asli', no_urut_tupoksi='$no_urut_tupoksi', kode_range_pangkat='$kode_range_pangkat', kode_jenjang_tupoksi='$kode_jenjang_tupoksi', mutu='$mutu', pangkat_aktif='$pangkat_aktif', kelompok_tupoksi='$kelompok_tupoksi', kuantitas='$kuantitas',  bobot_kerja='$bobot_kerja',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}

	public function hapus($id)
	{
		$sql = "DELETE FROM tkr_rencana_kerja_pegawai WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if ($querySQL) {
			return "1";
		} else {
			return "0";
		}
	}
}
