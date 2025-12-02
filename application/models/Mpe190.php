<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpe190 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM pegawai ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM pegawai WHERE id='$a' ORDER BY id";
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

	public function tambah($nama, $kelahiran, $tgl_lahir, $jk, $telp, $nip, $status, $sPegawai){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO pegawai VALUES(UNIX_TIMESTAMP(NOW()),'$nama', '$kelahiran', '$tgl_lahir', '$jk', '$telp', '$nip', '$status', '$sPegawai',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $kelahiran, $tgl_lahir, $jk, $telp, $nip, $status, $sPegawai){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE pegawai SET nama='$nama', kelahiran='$kelahiran', tanggal_lahir='$tgl_lahir', jenis_kelamin='$jk', telp='$telp', nip='$nip', status='$status', status_pegawai='$sPegawai', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM pegawai WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}