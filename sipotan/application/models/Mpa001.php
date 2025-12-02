<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpa001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS asosiasi_kec FROM pengurus_asosiasi_kec AS a LEFT JOIN asosiasi_kec AS b ON a.id_asosiasi_kec = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM pengurus_asosiasi_kec WHERE id='$a' ORDER BY id";
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

	public function tambah($kec, $ket, $sek, $ben, $tgl1, $tgl){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO pengurus_asosiasi_kec VALUES(UNIX_TIMESTAMP(NOW()),'$kec','$ket','$sek','$ben','$tgl1','$tgl',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $kec, $ket, $sek, $ben, $tgl1, $tgl){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE pengurus_asosiasi_kec SET id_asosiasi_kec='$kec', ketua='$ket', sekretaris='$sek', bendahara='$ben', periode_awal='$tgl1', periode_akhir='$tgl', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM pengurus_asosiasi_kec WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}