<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mta789 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.id_lahan AS id_lahan FROM tbl_analisa_usaha_tani AS a LEFT JOIN tbl_lahan_demp AS b ON a.id_lahan = b.id_lahan  ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM tbl_analisa_usaha_tani WHERE id='$a' ORDER BY id";
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

	public function tambah($id_lahan, $bol, $bpem, $btan, $bpuk, $bpes, $bpeng, $btk, $bsl, $blan,$tbiaya, $hpk, $tpan,$keu){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO tbl_analisa_usaha_tani VALUES(UNIX_TIMESTAMP(NOW()),'$id_lahan','$bol','$bpem','$btan','$bpuk','$bpes','$bpeng','$btk','$bsl','$blan','$tbiaya','$hpk','$tpan','$keu',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $id_lahan, $bol, $bpem, $btan, $bpuk, $bpes, $bpeng, $btk, $bsl, $blan,$tbiaya, $hpk, $tpan,$keu){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE tbl_analisa_usaha_tani SET id='$id', id_lahan='$id_lahan', biaya_olah_lahan='$bol', biaya_pembibitan='$bpem', biaya_tanam='$btan', biaya_pupuk='$bpuk', biaya_pestisida='$bpes', biaya_pengairan='$bpeng', biaya_tenaga_kerja='$btk', biaya_sewa_lahan='$bsl',biaya_lain2='$blan', total_biaya='$tbiaya', harga_pasar_kg='$hpk', total_panen='$tpan', keuntungan='$keu', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM tbl_analisa_usaha_tani WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}