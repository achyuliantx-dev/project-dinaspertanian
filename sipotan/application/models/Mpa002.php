<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpa002 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS asosiasi_kab FROM pengurus_asosiasi_kab AS a LEFT JOIN asosiasi_kab AS b ON a.id_asosiasi_kab = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM pengurus_asosiasi_kab WHERE id='$a' ORDER BY id";
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

	public function tambah($akab, $ket, $sek, $ben, $pawal, $pakhir){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO pengurus_asosiasi_kab VALUES(UNIX_TIMESTAMP(NOW()), '$akab', '$ket', '$sek', '$ben', '$pawal', '$pakhir',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $akab, $ket, $sek, $ben, $pawal, $pakhir){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE pengurus_asosiasi_kab SET id_asosiasi_kab='$akab', ketua='$ket', sekretaris='$sek', bendahara='$ben', periode_awal='$pawal', periode_akhir='$pakhir', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM pengurus_asosiasi_kab WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}