<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpp023 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS poktan FROM pengurus_poktan AS a LEFT JOIN poktan AS b ON a.id_poktan = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM pengurus_poktan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM poktan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($pok, $ket, $sek, $ben, $pawal, $pakhir){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO pengurus_poktan VALUES(UNIX_TIMESTAMP(NOW()), '$pok', '$ket', '$sek', '$ben', '$pawal', '$pakhir',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $pok, $ket, $sek, $ben, $pawal, $pakhir){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE pengurus_poktan SET id_poktan='$pok', ketua='$ket', sekretaris='$sek', bendahara='$ben', periode_awal='$pawal', periode_akhir='$pakhir', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM pengurus_poktan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}