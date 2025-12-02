<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mip001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan, c.id AS ipw, d.nama AS tahun, e.nama AS komoditas, f.nama AS pasar FROM informasi_pasar AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id LEFT JOIN ipw_kecamatan AS c ON a.id_ipwkecamatan = c. id LEFT JOIN m_tahun_anggaran AS d ON a.id_tahun = d.id LEFT JOIN komoditas AS e ON a.id_komoditas = e.id LEFT JOIN rantai_pasar AS f ON a.id_rantai = f.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	// contoh untuk koneksi db2
	// public function tes(){
	// 	$db2 = $this->load->database('db2', true);
	// 	$sql = "SELECT a.*, b.nama AS kecamatan FROM asosiasi_kec AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
	// 	$querySQL = $db2->query($sql);
	// 	if($querySQL){return $querySQL->result();}
	// 	else{return 0;}
	// }

	public function filter($a){
		$sql = "SELECT * FROM informasi_pasar WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM rantai_pasar WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($komo, $tujuan, $ran, $cam, $ipw, $thn){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO informasi_pasar VALUES(UNIX_TIMESTAMP(NOW()),'$komo','$tujuan','$ran','$cam','$ipw','$thn',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $komo, $tujuan, $ran, $cam, $ipw, $thn){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE informasi_pasar SET id_komoditas='$komo', tujuan_pasar='$tujuan', id_rantai='$ran', id_kecamatan='$cam', id_ipwkecamatan='$ipw', id_tahun='$thn', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM informasi_pasar WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}