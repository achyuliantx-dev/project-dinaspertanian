<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpa111 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS poktan, c.jenis AS jenis_alsintan FROM prasarana_alsintan AS a LEFT JOIN poktan AS b ON a.id_poktan = b.id LEFT JOIN jenis_alsintan AS c ON a.id_alsintan = c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM prasarana_alsintan WHERE id='$a' ORDER BY id";
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

	public function tambah($poktan, $jenis_alsintan, $pribadi, $kelompok, $baik, $buruk){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO prasarana_alsintan VALUES(UNIX_TIMESTAMP(NOW()), '$poktan', '$jenis_alsintan', '$pribadi', '$kelompok', '$baik', '$buruk',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $poktan, $jenis_alsintan, $pribadi, $kelompok, $baik, $buruk){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE prasarana_alsintan SET id_poktan='$poktan', id_alsintan='$jenis_alsintan', k_pribadi='$pribadi', k_kelompok='$kelompok', k_baik='$baik', k_buruk='$buruk', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM prasarana_alsintan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}