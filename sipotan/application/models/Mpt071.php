<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpt071 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS komoditas, c.nop AS lahan FROM rencana_pola_tanam AS a LEFT JOIN komoditas AS b ON a.id_komoditas = b.id LEFT JOIN lahan AS c ON a.nop=c.nop ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM rencana_pola_tanam WHERE id='$a' ORDER BY id";
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

	public function tambah($nop, $mt, $tgl, $komoditas){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO rencana_pola_tanam VALUES(UNIX_TIMESTAMP(NOW()),'$nop','$mt', '$tgl', '$komoditas',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nop, $mt, $tgl, $komoditas){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE rencana_pola_tanam SET nop='$nop', masa_tanam='$mt', tgl_mulai='$tgl', id_komoditas='$komoditas', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM rencana_pola_tanam WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}