<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpe888 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS tbl_lahan_demp, c.nama AS jenis_alat FROM tbl_penyiangan AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan LEFT JOIN tbl_jenis_alat_penyiangan AS c ON a.alat_penyiangan1 = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_penyiangan WHERE id='$a' ORDER BY id";
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

	public function tambah($lahan, $umur1, $alat1, $umur2, $alat2, $umur3, $alat3, $umur4,  $alat4){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_penyiangan VALUES(UNIX_TIMESTAMP(NOW()), '$lahan', '$umur1', '$alat1', '$umur2', '$alat2', '$umur3', '$alat3', '$umur4',  '$alat4', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $lahan, $umur1, $alat1, $umur2, $alat2, $umur3, $alat3, $umur4,  $alat4){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_penyiangan SET id='$id', id_lahan='$lahan', umur_penyiangan1='$umur1', alat_penyiangan1='$alat1', umur_penyiangan2='$umur2', alat_penyiangan2='$alat2', umur_penyiangan3='$umur3', alat_penyiangan3='$alat3', umur_penyiangan4='$umur4', alat_penyiangan4='$alat4', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_penyiangan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}