<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mrg402 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS asosiasi_kec, c.nama AS gapoktan FROM relasi_gapoktan AS a LEFT JOIN asosiasi_kec AS b ON a.id_asosiasi_kec = b.id LEFT JOIN gapoktan AS c ON a.id_gapoktan = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM relasi_gapoktan WHERE id='$a' ORDER BY id";
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

	public function tambah($kec, $gap){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO relasi_gapoktan VALUES(UNIX_TIMESTAMP(NOW()),'$kec','$gap',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $kec, $gap){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE relasi_gapoktan SET id_asosiasi_kec='$kec', id_gapoktan='$gap', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM relasi_gapoktan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}
}