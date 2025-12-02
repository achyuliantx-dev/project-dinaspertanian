<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mmh149 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id AS pola_tanam, c.nama AS unsur_hara, d.nop FROM monitoring_unsur_hara AS a LEFT JOIN rencana_pola_tanam AS b ON a.id_rencana_pola_tanam = b.id LEFT JOIN unsur_hara AS c ON a.id_unsur_hara = c.id LEFT JOIN lahan AS d ON a.nop=d.nop ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM monitoring_unsur_hara WHERE id='$a' ORDER BY id";
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

	public function tambah($nop, $idp, $idu, $nilai){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO monitoring_unsur_hara VALUES(UNIX_TIMESTAMP(NOW()),'$nop', '$idp', '$idu','$nilai',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nop, $idp, $idu, $nilai){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE monitoring_unsur_hara SET nop='$nop', id_rencana_pola_tanam='$idp', id_unsur_hara='$idu', nilai='$nilai', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM monitoring_unsur_hara WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}