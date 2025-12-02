<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mtp001 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS pangkat, c.nama AS jenjang FROM tupoksi_golongan AS a LEFT JOIN range_pangkat AS b ON a.id_range = b.id LEFT JOIN jenjang AS c ON a.id_jenjang = c. id  ORDER BY a.id";
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
		$sql = "SELECT * FROM tupoksi_golongan WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM range_pangkat WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($jenjang, $nama, $kete, $pangkat, $kel, $kuant, $ak){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tupoksi_golongan VALUES(UNIX_TIMESTAMP(NOW()),'$jenjang','$nama','$kete','$pangkat','$kel','$kuant','$ak',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $jenjang, $nama, $kete, $pangkat, $kel, $kuant, $ak){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tupoksi_golongan SET id_jenjang='$jenjang', nama='$nama', keterangan='$kete', id_range='$pangkat', kelompok='$kel', kuantitas='$kuant', ak='$ak', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tupoksi_golongan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}