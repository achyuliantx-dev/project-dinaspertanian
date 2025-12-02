<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mkb844 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS propinsi FROM kabupaten AS a LEFT JOIN propinsi AS b ON a.id_propinsi = b.id WHERE a.id LIKE '%35%' ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM kabupaten WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM kecamatan WHERE id_kabupaten='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id,$nama,$prov,$jenis){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO kabupaten VALUES('$id','$nama','$prov','$jenis');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $prov, $jenis){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE kabupaten SET nama='$nama', id_propinsi='$prov',jenis='$jenis' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM kabupaten WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}