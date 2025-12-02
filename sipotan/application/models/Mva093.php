<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mva093 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS jenis_tanaman FROM komoditas AS a LEFT JOIN jenis_tanaman AS b ON a.id_jenis_tanaman = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM komoditas WHERE id='$a' ORDER BY id";
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

	public function tambah($komoditas, $nama, $lama_tanam){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO komoditas VALUES(UNIX_TIMESTAMP(NOW()), '$komoditas', '$nama', '$lama_tanam',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $komoditas, $nama, $lama_tanam){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE komoditas SET id_jenis_tanaman='$komoditas', nama='$nama', lama_tanam='$lama_tanam',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM komoditas WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}