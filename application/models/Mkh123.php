<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mkh123 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS id_lahan FROM tbl_kand_hara AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_kand_hara WHERE id='$a' ORDER BY id";
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

	public function tambah($id_lahan, $nilai_n, $nilai_p, $nilai_k, $ph){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_kand_hara VALUES(UNIX_TIMESTAMP(NOW()), '$id_lahan', '$nilai_n', '$nilai_p', '$nilai_k', '$ph',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $id_lahan, $nilai_n, $nilai_p, $nilai_k, $ph){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_kand_hara SET id_lahan='$id_lahan', nilai_n='$nilai_n', nilai_p='$nilai_p', nilai_k='$nilai_k', nilai_ph='$ph', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_kand_hara WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}