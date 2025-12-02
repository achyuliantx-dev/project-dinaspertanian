<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpr012 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM propinsi ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM propinsi WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM kabupaten WHERE id_propinsi='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO propinsi VALUES('$id','$nama');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE propinsi SET nama='$nama' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM propinsi WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}