<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mgt001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS kecamatan, c.id AS ipw, d.nama AS tahun FROM gerakan_penerapan_teknologi AS a LEFT JOIN kecamatan AS b ON a.id_kecamatan = b.id LEFT JOIN ipw_kecamatan AS c ON a.id_ipwkecamatan = c. id LEFT JOIN m_tahun_anggaran AS d ON a.id_tahun = d.id WHERE a.id_kecamatan LIKE '%3517%' ORDER BY a.id";
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
		$sql = "SELECT * FROM gerakan_penerapan_teknologi WHERE id='$a' ORDER BY id";
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

	public function tambah($ur, $jml, $cam, $ipw, $thn){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO gerakan_penerapan_teknologi VALUES(UNIX_TIMESTAMP(NOW()),'$ur','$jml','$cam','$ipw','$thn',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $ur, $jml, $cam, $ipw, $thn){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE gerakan_penerapan_teknologi SET uraian='$ur', jumlah='$jml', id_kecamatan='$cam', id_ipwkecamatan='$ipw', id_tahun='$thn', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM gerakan_penerapan_teknologi WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}