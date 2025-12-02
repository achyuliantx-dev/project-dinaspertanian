<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mak789 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kabupaten FROM asosiasi_kab AS a LEFT JOIN kabupaten AS b ON a.id_kabupaten = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM asosiasi_kab WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM kabupaten WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama, $tgl_ber, $no_leg, $status, $alamat, $kabu, $telp, $email){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO asosiasi_kab VALUES(UNIX_TIMESTAMP(NOW()), '$nama', '$tgl_ber', '$no_leg', '$status', '$alamat', '$kabu', '$telp', '$email',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $tgl_ber, $no_leg, $status, $alamat, $kabu, $telp, $email){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE asosiasi_kab SET nama='$nama',tgl_berdiri='$tgl_ber',no_legalitas='$no_leg',status='$status', alamat='$alamat', id_kabupaten='$kabu', telp='$telp', email='$email' , tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM asosiasi_kab WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}