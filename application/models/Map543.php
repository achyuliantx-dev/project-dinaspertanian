<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Map543 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM tbl_jenis_alat_penyiangan ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_jenis_alat_penyiangan WHERE id='$a' ORDER BY id";
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

	public function tambah($nama){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_jenis_alat_penyiangan VALUES(UNIX_TIMESTAMP(NOW()),'$nama', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_jenis_alat_penyiangan SET nama='$nama', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_jenis_alat_penyiangan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}