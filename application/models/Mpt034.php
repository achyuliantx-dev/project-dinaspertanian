<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpt034 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS gapoktan FROM poktan AS a LEFT JOIN gapoktan AS b ON a.id_gapoktan = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM poktan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM pengurus_poktan WHERE id_poktan='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama,$tgl,$no,$status, $alamat,$gp,$telp,$email){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO poktan VALUES(UNIX_TIMESTAMP(NOW()),'$nama','$tgl','$no','$status','$alamat','$gp','$telp','$email',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama,$tgl,$no,$status, $alamat,$gp,$telp,$email){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE poktan SET nama='$nama', tgl_berdiri='$tgl', no_legalitas='$no', status='$status', alamat='$alamat', id_gapoktan='$gp', telp='$telp', email='$email', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM poktan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}