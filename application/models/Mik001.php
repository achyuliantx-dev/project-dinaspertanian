<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mik001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan FROM ipw_kecamatan AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
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
		$sql = "SELECT * FROM ipw_kecamatan WHERE id='$a' ORDER BY id";
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

	public function tambah($nama, $kec, $buk, $btk, $bsk, $bbk){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO ipw_kecamatan VALUES(UNIX_TIMESTAMP(NOW()),'$nama','$kec','$buk','$btk','$bsk','$bbk',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $kec, $buk, $btk, $bsk, $bbk){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE ipw_kecamatan SET nama='$nama', id_kecamatan='$kec', batas_utara_kec='$buk', batas_timur_kec='$btk', batas_selatan_kec='$bsk', batas_barat_kec='$bbk', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM ipw_kecamatan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}