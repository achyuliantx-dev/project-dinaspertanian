<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mse552 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS tbl_lahan_demp FROM tbl_semaian AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_semaian WHERE id='$a' ORDER BY id";
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

	public function tambah($lahan, $tglSemaiK, $tglSemaiB, $jml, $tglPu, $jenisPu, $dosisPu, $dosisPua){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_semaian VALUES(UNIX_TIMESTAMP(NOW()), '$lahan', '$tglSemaiK', '$tglSemaiB', '$jml', '$tglPu', '$jenisPu', '$dosisPu', '$dosisPua',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $lahan, $tglSemaiK, $tglSemaiB, $jml, $tglPu, $jenisPu, $dosisPu, $dosisPua){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_semaian SET id='$id', id_lahan='$lahan', tgl_semai_kering='$tglSemaiK', tgl_semai_basah='$tglSemaiB', jml_benih='$jml', tgl_pupuk_semaian='$tglPu', jenis_pupuk_semai='$jenisPu', dosis_pupuk_semai_organik='$dosisPu', dosis_pupuk_semai_anorganik='$dosisPua',tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_semaian WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}