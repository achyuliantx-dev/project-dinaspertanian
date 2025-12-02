<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdk999 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS id_lahan,c.nama as nama FROM tbl_dekomposer AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan LEFT JOIN tbl_jenis_dekomp AS c ON a.jenis_dekomposer=c.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_dekomposer WHERE id='$a' ORDER BY id";
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

	public function tambah($id_lahan, $tdek, $jubd, $tbj, $cps, $tad, $jdek, $ddek, $jap){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_dekomposer VALUES(UNIX_TIMESTAMP(NOW()), '$id_lahan', '$tdek', '$jubd', '$tbj', '$cps', '$tad', '$jdek', '$ddek', '$jap',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $id_lahan, $tdek, $jubd, $tbj, $cps, $tad, $jdek, $ddek, $jap){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_dekomposer SET id_lahan='$id_lahan', tgl_dekomposisi='$tdek', jml_bo_dekomposisi='$jubd', tgl_benam_jerami='$tbj', cara_panen_sebelumnya='$cps', tgl_aplikasi_dekomposer='$tad', jenis_dekomposer='$jdek', dosis_dekomposer='$ddek', jam_aplikasi='$jap', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_dekomposer WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}