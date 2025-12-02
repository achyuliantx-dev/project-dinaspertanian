<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mrp098 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS varietas_tanaman FROM rencana_pola_tanam AS a LEFT JOIN varietas_tanaman AS b ON a.id_varietas = b.id ORDER BY a.id";
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
		$sql = "SELECT * FROM form_level WHERE id_level='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id,$mt,$varietas){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO rencana_pola_tanam VALUES('$id','$mt','$varietas',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}
	public function update($id, $mt, $varietas){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE rencana_pola_tanam SET masa_tanam='$mt',id_varietas='$varietas',  tgl_update=NOW(), id_update='$user' WHERE id='$id';";
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