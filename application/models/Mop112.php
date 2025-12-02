<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mop112 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM tbl_mst_opt ORDER BY id_opt";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_mst_opt WHERE id_opt='$a' ORDER BY id_opt";
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
		$sql = "INSERT INTO tbl_mst_opt VALUES(UNIX_TIMESTAMP(NOW()),'$nama', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_mst_opt SET nama_opt='$nama', tgl_update=NOW(), id_update='$user' WHERE id_opt='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_mst_opt WHERE id_opt='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}