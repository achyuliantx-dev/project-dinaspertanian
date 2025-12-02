<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpg207 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS gapoktan FROM pengurus_gapoktan AS a LEFT JOIN gapoktan AS b ON a.id_gapoktan = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM pengurus_gapoktan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM form WHERE id_menu='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($gap, $ket, $sek, $ben, $tgl1, $tgl){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO pengurus_gapoktan VALUES(UNIX_TIMESTAMP(NOW()),'$gap','$ket','$sek','$ben','$tgl1','$tgl',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $gap, $ket, $sek, $ben, $tgl1, $tgl){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE pengurus_gapoktan SET id_gapoktan='$gap', ketua='$ket', sekretaris='$sek', bendahara='$ben', periode_awal='$tgl1', periode_akhir='$tgl', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM pengurus_gapoktan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}