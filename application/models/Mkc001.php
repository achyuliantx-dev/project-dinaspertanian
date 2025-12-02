<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mkc001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kabupaten FROM kecamatan AS a LEFT JOIN kabupaten AS b ON a.id_kabupaten = b.id WHERE a.id LIKE '%3517%' ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM kecamatan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM desa WHERE id_kecamatan='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id,$nama,$kab){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO kecamatan VALUES('$id','$nama','$kab');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $kab){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE kecamatan SET nama='$nama', id_kabupaten='$kab' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM kecamatan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}