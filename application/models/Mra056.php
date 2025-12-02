<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mra056 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS asosiasi_kab, c.nama AS asosiasi_kec FROM relasi_asosiasi AS a LEFT JOIN asosiasi_kab AS b ON a.id_asosiasi_kab = b.id LEFT JOIN asosiasi_kec AS c ON a.id_asosiasi_kec = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM relasi_asosiasi WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM form_level WHERE id_form='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($akab, $akec){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO relasi_asosiasi VALUES(UNIX_TIMESTAMP(NOW()),'$akab','$akec',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $akab, $akec){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE relasi_asosiasi SET id_asosiasi_kab='$akab', id_asosiasi_kec='$akec',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM relasi_asosiasi WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}