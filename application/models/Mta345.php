<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mta345 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS tbl_lahan_demp FROM tbl_tanam AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_tanam WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM tbl_lahan_demp WHERE id_lahan='$a' ORDER BY id_lahan";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($lahan, $umurCB, $tglTanam, $kondisiTa, $teknologiTe, $jarakTa, $jmlBT, $drainase, $mekanisme, $ub){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_tanam VALUES(UNIX_TIMESTAMP(NOW()), '$lahan', '$umurCB', '$tglTanam', '$kondisiTa', '$teknologiTe', '$jarakTa', '$jmlBT', '$drainase', '$mekanisme', '$ub', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $lahan, $umurCB, $tglTanam, $kondisiTa, $teknologiTe, $jarakTa, $jmlBT, $drainase, $mekanisme, $ub){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_tanam SET id='$id', id_lahan='$lahan', umur_cabut_bibit='$umurCB', tgl_tanam='$tglTanam', kondisi_tanah='$kondisiTa', teknologi_terapan='$teknologiTe', jarak_tanam='$jarakTa', jml_batang_tancap='$jmlBT', drainase='$drainase', mekanisme='$mekanisme', usia_bibit='$ub', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_tanam WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}