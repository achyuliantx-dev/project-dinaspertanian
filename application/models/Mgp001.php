<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mgp001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS desa FROM gapoktan AS a LEFT JOIN desa AS b ON a.id_desa = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM gapoktan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM pengurus_gapoktan WHERE id_gapoktan='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama,$tgl,$no,$stat, $alamat,$des,$telp,$email){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO gapoktan VALUES(UNIX_TIMESTAMP(NOW()),'$nama','$tgl','$no','$stat','$alamat','$des','$telp','$email',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama,$tgl,$no,$stat, $alamat,$des,$telp,$email){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE gapoktan SET nama='$nama', tgl_berdiri='$tgl', no_legalitas='$no', status='$stat', alamat='$alamat', id_desa='$des', telp='$telp', email='$email', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM gapoktan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}