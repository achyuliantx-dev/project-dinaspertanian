<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mte456 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS id_lahan, c.nama_opt AS jenis_opt FROM tbl_ekosistem AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan LEFT JOIN tbl_mst_opt AS c ON a.jenis_opt = c.id_opt ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_ekosistem WHERE id='$a' ORDER BY id";
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

	public function tambah($id_lahan, $jo, $tl, $htl){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_ekosistem VALUES(UNIX_TIMESTAMP(NOW()), '$id_lahan', '$jo', '$tl', '$htl',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $id_lahan, $jo, $tl, $htl){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_ekosistem SET id_lahan='$id_lahan', jenis_opt='$jo', tindak_lanjut='$tl', hasil_tindak_lanjut='$htl', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_ekosistem WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}