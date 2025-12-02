<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mma567 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan, c.nama AS ipw, d.nama AS tahun, e.nama AS komoditas, f.nama_opt AS masalah, g.nama AS desa FROM masalah AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id LEFT JOIN ipw_desa AS c ON a.id_ipw = c. id LEFT JOIN m_tahun_anggaran AS d ON a.id_tahun = d.id LEFT JOIN komoditas AS e ON a.id_komoditas = e.id LEFT JOIN tbl_mst_opt AS f ON a.id_masalah = f.id_opt LEFT JOIN desa AS g ON a.id_desa = g.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
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
		$sql = "SELECT * FROM masalah WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM kecamatan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($masalah, $komoditas, $luas, $tipe, $thn, $cam, $ipw, $desa){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO masalah VALUES(UNIX_TIMESTAMP(NOW()),'$masalah','$komoditas','$luas','$tipe','$thn','$cam','$ipw','$desa',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $masalah, $komoditas, $luas, $tipe, $thn, $cam, $ipw, $desa){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE masalah SET id_masalah='$masalah', id_komoditas='$komoditas', luas_ha='$luas', id_tahun='$thn', id_ipw='$ipw', id_desa='$desa', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM masalah WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}