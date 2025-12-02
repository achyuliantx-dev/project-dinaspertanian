<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mid002 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan, c.nama AS desa FROM ipw_desa AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id LEFT JOIN desa AS c ON a.id_desa = c.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	// contoh untuk koneksi db2
	// public function tes(){
	// 	$db2 = $this->load->database('db2', true);
	// 	$sql = "SELECT a.*, b.nama AS kecamatan FROM asosiasi_kec AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
	// 	$querySQL = $db2->query($sql);
	// 	if($querySQL){return $querySQL->result();}
	// 	else{return 0;}
	// }

	public function filter($a){
		$sql = "SELECT * FROM ipw_desa WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM desa WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama, $desa, $kec, $bud, $btd, $bsd, $bbd){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO ipw_desa VALUES(UNIX_TIMESTAMP(NOW()),'$nama','$desa','$kec','$bud','$btd','$bsd','$bbd',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id,$nama, $desa, $kec, $bud, $btd, $bsd, $bbd){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE ipw_desa SET id_desa='$desa', nama='$nama', id_kecamatan='$kec', batas_utara_desa='$bud', batas_timur_desa='$btd', batas_selatan_desa='$bsd', batas_barat_desa='$bbd', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM ipw_desa WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}