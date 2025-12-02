<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpe999 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS tbl_lahan_demp FROM tbl_pengamatan AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_pengamatan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM tbl_lahan_demp WHERE id_lahan='$a' ORDER BY id_lahan";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($lahan, $pengamatan, $tanaman, $anakan, $tinggiTan, $malai, $rerata){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_pengamatan VALUES(UNIX_TIMESTAMP(NOW()), '$lahan', '$pengamatan', '$tanaman', '$anakan', '$tinggiTan', '$malai', '$rerata', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $lahan, $pengamatan, $tanaman, $anakan, $tinggiTan, $malai, $rerata){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_pengamatan SET id='$id', id_lahan='$lahan', pengamatan_ke='$pengamatan', tanaman_ke='$tanaman', jml_anakan='$anakan', tinggi_tanaman='$tinggiTan', jml_malai='$malai', rerata_gabah_malai='$rerata',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_pengamatan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}