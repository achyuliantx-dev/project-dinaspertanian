<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpt001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS desa, c.nama AS dusun FROM petani AS a LEFT JOIN desa AS b ON a.id_desa = b.id LEFT JOIN dusun AS c ON a.id_dusun = c.id ORDER BY a.nik";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}
public function cekform($a){
		$sql = "SELECT * FROM lahan WHERE nik='$a' ORDER BY nik";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nik, $nama, $jk, $kelahiran, $tgl_lahir, $telp, $ibu, $alamat, $dus, $rt, $rw, $des ){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO petani VALUES('$nik', '$nama', '$jk', '$kelahiran', '$tgl_lahir', '$telp', '$ibu', '$alamat', '$dus', '$rt', '$rw', '$des',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($nik, $nama, $jk, $kelahiran, $tgl_lahir, $telp, $ibu, $alamat, $id_dusun, $rt, $rw, $id_desa ){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE petani SET nama='$nama', jenis_kelamin='$jk', kelahiran='$kelahiran', tgl_lahir='$tgl_lahir', telp='$telp', nama_ibu='$ibu', alamat='$alamat', id_dusun='$id_dusun', rt='$rt', rw='$rw', id_desa='$id_desa', tgl_update=NOW(), id_update='$user' WHERE nik='$nik';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($nik){
		$sql = "DELETE FROM petani WHERE nik='$nik';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function filter($a){
		$sql = "SELECT * FROM petani WHERE nik='$a' ORDER BY nik";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

}	