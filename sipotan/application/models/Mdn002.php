<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdn002 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS desa FROM dusun AS a LEFT JOIN desa AS b ON a.id_desa = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM dusun WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM log_history WHERE id_user='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id,$nama,$des){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO dusun VALUES('$id','$nama','$des');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $des){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE dusun SET nama='$nama', id_desa='$des' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM dusun WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}