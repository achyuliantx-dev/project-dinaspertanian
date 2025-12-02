<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mch001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan, c.nama AS tahun_anggaran FROM curah_hujan AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id LEFT JOIN m_tahun_anggaran AS c ON a.id_tahun_anggaran = c.id WHERE a.id_kecamatan  LIKE '%3517%' ORDER BY a.id";
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
		$sql = "SELECT * FROM curah_hujan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM kecamatan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($bul, $ch, $hh, $ta, $kec){
		$user = $this->Mlogin->ambiluser();
		// $id = floor(microtime(true) * 1000) . rand(1111, 9999);
		$sql = "INSERT INTO curah_hujan VALUES('$bul','$ch','$hh','$ta','$kec',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $bul, $ch, $hh, $ta, $kec){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE curah_hujan SET bulan='$bul', ch='$ch', hh='$hh', id_tahun_anggaran='$ta', id_kecamatan='$kec', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM curah_hujan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}