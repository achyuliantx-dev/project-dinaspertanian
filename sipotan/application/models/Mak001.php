<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mak001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan FROM asosiasi_kec AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
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
		$sql = "SELECT * FROM asosiasi_kec WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM pengurus_asosiasi_kec WHERE id_asosiasi_kec='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama,$tgl,$no,$stat, $alamat,$kec,$telp,$email){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO asosiasi_kec VALUES(UNIX_TIMESTAMP(NOW()),'$nama','$tgl','$no','$stat','$alamat','$kec','$telp','$email',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama,$tgl,$no,$stat, $alamat,$kec,$telp,$email){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE asosiasi_kec SET nama='$nama', tgl_berdiri='$tgl', no_legalitas='$no', status='$stat', alamat='$alamat', id_kecamatan='$kec', telp='$telp', email='$email', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM asosiasi_kec WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}