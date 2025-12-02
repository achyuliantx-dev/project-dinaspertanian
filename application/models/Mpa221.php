<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpa221 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS tbl_lahan_demp FROM tbl_panen AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_panen WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filteranalisis($id){
		$sql = "SELECT * FROM tbl_analisa_usaha_tani WHERE id_lahan='$id' ORDER BY tgl_buat DESC LIMIT 1";
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

	public function tambah($lahan, $panen, $produksi, $produktivitas, $biaya, $keuntungan, $masalah, $saran){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_panen VALUES(UNIX_TIMESTAMP(NOW()), '$lahan', '$panen', '$produksi', '$produktivitas', '$biaya', '$keuntungan', '$masalah', '$saran',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $lahan, $panen, $produksi, $produktivitas, $biaya, $keuntungan, $masalah, $saran){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_panen SET id='$id', id_lahan='$lahan', tgl_panen='$panen', produksi_real='$produksi', produktivitas='$produktivitas', biaya_usaha_tani='$biaya', keuntungan='$keuntungan', masalah='$masalah', saran='$saran',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_panen WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}