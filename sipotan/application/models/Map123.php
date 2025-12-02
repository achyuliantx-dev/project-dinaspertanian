<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Map123 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS id_lahan FROM tbl_apl_poc AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_apl_poc WHERE id='$a' ORDER BY id";
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

	public function tambah($id_lahan, $uap1, $dap1, $uap2, $dap2, $uap3, $dap3, $uap4, $dap4, $uap5, $dap5){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_apl_poc VALUES(UNIX_TIMESTAMP(NOW()), '$id_lahan', '$uap1', '$dap1', '$uap2', '$dap2', '$uap3', '$dap3', '$uap4', '$dap4', '$uap5', '$dap5',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $id_lahan, $uap1, $dap1, $uap2, $dap2, $uap3, $dap3, $uap4, $dap4, $uap5, $dap5){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_apl_poc SET id_lahan='$id_lahan', umur_apl_poc1='$uap1', dosis_apl_poc1='$dap1', umur_apl_poc2='$uap2', dosis_apl_poc2='$dap2', umur_apl_poc3='$uap3', dosis_apl_poc3='$dap3', umur_apl_poc4='$uap4', dosis_apl_poc4='$dap4', umur_apl_poc5='$uap5', dosis_apl_poc5='$dap5', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_apl_poc WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}