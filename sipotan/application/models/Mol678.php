<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mol678 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS tbl_lahan_demp FROM tbl_olah_lahan AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_olah_lahan WHERE id='$a' ORDER BY id";
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

	public function tambah($lahan, $tgl_singkal1, $tgl_singkal2, $tgl_garuh, $tanah){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_olah_lahan VALUES(UNIX_TIMESTAMP(NOW()), '$lahan', '$tgl_singkal1', '$tgl_singkal2', '$tgl_garuh', '$tanah',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $lahan, $tgl_singkal1, $tgl_singkal2, $tgl_garuh, $tanah){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_olah_lahan SET id='$id', id_lahan='$lahan', tgl_singkal1='$tgl_singkal1', tgl_singkal2='$tgl_singkal2', tgl_garuh='$tgl_garuh', jenis_tanah='$tanah', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_olah_lahan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}