<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpl002 extends CI_Model {
	public function data(){
		$sql = "SELECT a.id, a.nama, a.jenis_kelamin, a.alamat, a.telp, b.username FROM ppl AS a LEFT JOIN akses AS b ON a.id = b.id ORDER BY a.id";
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
	public function filterdesa($id){
		$sql = "SELECT * FROM desa WHERE id_kecamatan='$id'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama, $nik, $nip, $gelarDep, $gelarBel, $tempat_lahir, $tgl_lahir, $jk, $agama, $jsp, $sek, $kec, $ptt, $pta, $alamat, $desa, $pos, $telp, $email, $status, $jtt, $jja, $jab ){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO ppl VALUES(UNIX_TIMESTAMP(NOW()),'$nama', '$nik', '$nip', '$gelarDep', '$gelarBel', '$tempat_lahir', '$tgl_lahir', '$jk', '$agama', '$jsp', '$sek', '$kec', '$ptt', '$pta', '$alamat', '$desa', '$pos', '$telp', '$email', '$status', '$jtt', '$jja', '$jab', NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}
	public function tambah_akses($id, $nama, $username, $pass, $level, $status){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO akses VALUES ('$id','$nama','$username','$pass','$level','$status',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}
	public function update($id, $nama, $nik, $nip, $gelarDep, $gelarBel, $tempat_lahir, $tgl_lahir, $jk, $agama, $jsp, $sek, $kec, $ptt, $pta, $alamat, $desa, $pos, $telp, $email, $status, $jtt, $jja, $jab){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE ppl SET nama='$nama', nik='$nik', nip_nipppk='$nip', gelar_depan='$gelarDep', gelar_belakang='$gelarBel',tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', jenis_kelamin='$jk', id_agama='$agama', jurusan_semasa_pendidikan='$jsp', sekolah_universitas='$sek', id_kecamatan='$kec', pangkat_terakhir_terampil='$ptt', pangkat_terakhir_asn='$pta', alamat='$alamat', id_desa='$desa', kode_pos='$pos', telp='$telp', email='$email', status='$status', jenjang_jabatan_terampil='$jtt', jenjang_jabatan_ahli='$jja', kelas_jabatan='$jab', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}
	
	public function hapus($id){
		$sql = "DELETE FROM ppl WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function filter($a){
		$sql = "SELECT * FROM ppl WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

}	