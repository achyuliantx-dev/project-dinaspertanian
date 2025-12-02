<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mlh471 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS desa, c.nama AS petani, d.nama AS kategori_lahan, (a.lahan_subsidi+a.lahan_nonsubsidi) AS luas_ha FROM lahan AS a LEFT JOIN desa AS b ON a.id_desa = b.id LEFT JOIN petani AS c ON a.nik = c.nik LEFT JOIN kategori_lahan AS d ON a.id_kategori_lahan = d.id ORDER BY a.id_desa";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM lahan WHERE nop='$a' ORDER BY nop";
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

	public function tambah($nop,$nik,$has,$han,$jenis,$des,$lin,$buj){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO lahan VALUES ('$nop', '$nik' ,'$has', '$han' ,'$jenis', '$des' , '$lin' , '$buj',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($nop,$nik,$has,$han,$jenis,$des,$lin,$buj){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE lahan SET nik='$nik', lahan_subsidi='$has', lahan_nonsubsidi='$han', id_kategori_lahan='$jenis', id_desa='$des', lintang='$lin', bujur='$buj', tgl_update=NOW(), id_update='$user' WHERE nop='$nop';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($nop){
		$sql = "DELETE FROM lahan WHERE nop='$nop';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}