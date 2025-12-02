<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpp321 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS pupuk, c.masa_tanam AS rencana_pola_tanam FROM penggunaan_pupuk AS a LEFT JOIN pupuk AS b ON a.id_pupuk = b.id LEFT JOIN rencana_pola_tanam AS c ON a.id_rencana_pola_tanam = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM penggunaan_pupuk WHERE id='$a' ORDER BY id";
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

	public function tambah($pupuk, $jumlah, $tgl_pakai, $pt){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO penggunaan_pupuk VALUES(UNIX_TIMESTAMP(NOW()),'$pupuk','$jumlah','$tgl_pakai','$pt',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $pupuk, $jumlah, $tgl_pakai, $pt){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE penggunaan_pupuk SET id_pupuk='$pupuk', jumlah='$jumlah', tgl_pakai='$tgl_pakai', id_rencana_pola_tanam='$pt', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM penggunaan_pupuk WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}