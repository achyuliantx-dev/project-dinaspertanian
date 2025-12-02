<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpe777 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS tbl_lahan_demp FROM tbl_pemupukan AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_pemupukan WHERE id='$a' ORDER BY id";
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

	public function tambah($lahan, $tglPuOr, $jmlPuOr, $tglPuAn, $jmlPuAn, $tglPuSu1, $caraPu1, $jenisPu1, $dosisPuO1, $dosisPuA1, $tglPuSu2, $caraPu2, $jenisPu2, $dosisPuO2, $dosisPuA2){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_pemupukan VALUES(UNIX_TIMESTAMP(NOW()), '$lahan', '$tglPuOr', '$jmlPuOr', '$tglPuAn', '$jmlPuAn', '$tglPuSu1', '$caraPu1', '$jenisPu1', '$dosisPuO1', '$dosisPuA1', '$tglPuSu2', '$caraPu2', '$jenisPu2', '$dosisPuO2','$dosisPuA2', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $lahan, $tglPuOr, $jmlPuOr, $tglPuAn, $jmlPuAn, $tglPuSu1, $caraPu1, $jenisPu1, $dosisPuO1, $dosisPuA1, $tglPuSu2, $caraPu2, $jenisPu2, $dosisPuO2, $dosisPuA2){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_pemupukan SET id='$id', id_lahan='$lahan', tgl_pupuk_dasar_organik='$tglPuOr', jml_pupuk_organik='$jmlPuOr', tgl_pupuk_anorganik='$tglPuAn', jml_pupuk_anorganik='$jmlPuAn', tgl_pupuk_susulan1='$tglPuSu1', cara_pupuk_s1='$caraPu1', jenis_pupuk_s1='$jenisPu1', dosis_pupuk_organik_s1='$dosisPuO1',dosis_pupuk_anorganik_s1='$dosisPuA1', tgl_pupuk_susulan2='$tglPuSu2', cara_pupuk_s2='$caraPu2', jenis_pupuk_s2='$jenisPu2', dosis_pupuk_organik_s2='$dosisPuO2',dosis_pupuk_anorganik_s2='$dosisPuA2', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_pemupukan WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}