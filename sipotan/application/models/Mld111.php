<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mld111 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama_bpp AS nama_bpp, c.nama_varietas AS nama_varietas FROM tbl_lahan_demp AS a LEFT JOIN tbl_mst_bpp AS b ON a.id_bpp = b.id_bpp LEFT JOIN tbl_mst_varietas AS c ON a.id_varietas=c.id_varietas ORDER BY a.id_lahan";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_lahan_demp WHERE id_lahan='$a' ORDER BY id_lahan";
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

	public function tambah($id_bpp, $luas, $msm, $id_var, $pt, $kbo){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_lahan_demp VALUES(UNIX_TIMESTAMP(NOW()), '$id_bpp', '$luas', '$msm', '$id_var','$pt', '$kbo',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id_lahan,$id_bpp, $luas, $msm, $id_var, $pt, $kbo){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_lahan_demp SET id_lahan='$id_lahan',id_bpp='$id_bpp', luas='$luas', musim='$msm', id_varietas='$id_var', pola_tanam='$pt', kandungan_bo='$kbo', tgl_update=NOW(), id_update='$user' WHERE id_lahan='$id_lahan';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id_lahan){
		$sql = "DELETE FROM tbl_lahan_demp WHERE id_lahan='$id_lahan';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}