<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mal111 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM jenis_alsintan ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM jenis_alsintan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM form_level WHERE id_level='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($jenis){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO jenis_alsintan VALUES(UNIX_TIMESTAMP(NOW()),'$jenis');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $jenis){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE jenis_alsintan SET jenis='$jenis' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM jenis_alsintan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}