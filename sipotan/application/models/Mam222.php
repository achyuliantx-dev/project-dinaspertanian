<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mam222 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS id_lahan FROM tbl_apl_mol AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_apl_mol WHERE id='$a' ORDER BY id";
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

	public function tambah($id_lahan, $uam1, $dam1, $uam2, $dam2, $uam3, $dam3, $uam4, $dam4, $uam5, $dam5){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_apl_mol VALUES(UNIX_TIMESTAMP(NOW()), '$id_lahan', '$uam1', '$dam1', '$uam2', '$dam2', '$uam3', '$dam3', '$uam4', '$dam4', '$uam5', '$dam5',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $id_lahan, $uam1, $dam1, $uam2, $dam2, $uam3, $dam3, $uam4, $dam4, $uam5, $dam5){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_apl_mol SET id_lahan='$id_lahan', umur_apl_mol1='$uam1', dosis_apl_mol1='$dam1', umur_apl_mol2='$uam2', dosis_apl_mol2='$dam2', umur_apl_mol3='$uam3', dosis_apl_mol3='$dam3', umur_apl_mol4='$uam4', dosis_apl_mol4='$dam4', umur_apl_mol5='$uam5', dosis_apl_mol5='$dam5', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_apl_mol WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}