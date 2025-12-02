<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mbp112 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS desa, c.nama AS kecamatan FROM tbl_mst_bpp AS a LEFT JOIN desa AS b ON a.id_desa = b.id LEFT JOIN kecamatan AS c ON a.id_kec = c.id ORDER BY a.id_bpp";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_mst_bpp WHERE id_bpp='$a' ORDER BY id_bpp";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM log_history WHERE id_user='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama, $alamat, $telp, $desa, $keca){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_mst_bpp VALUES(UNIX_TIMESTAMP(NOW()),  '$nama', '$alamat', '$telp', '$desa', '$keca',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $alamat, $telp, $desa, $keca){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_mst_bpp SET id_bpp='$id', nama_bpp='$nama', alamat='$alamat', no_telp='$telp', id_desa='$desa', id_kec='$keca',tgl_update=NOW(), id_update='$user' WHERE id_bpp='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_mst_bpp WHERE id_bpp='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}