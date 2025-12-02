<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pl002 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pl002";
		$this->load->model('Mpl002');
		$this->load->model('Mag778');
		$this->load->model('Mkc001');
		$this->load->model('Mds001');
		$data["datalogin"] = $this->Mlogin->cek_login();
		$dataform = $this->Mlogin->cek_sistem($idformini);
        if(is_array($data["datalogin"])){
			foreach($dataform as $cx){
				$idsistem_sistem = $cx->id_sistem;
			}
			$idsistem_user = array();
         	foreach ($data["datalogin"] as $dl){
				$idlevel = $dl->id_level;
				array_push($idsistem_user, $dl->id_sistem);
			}
			if(array_search($idsistem_sistem, $idsistem_user) !== false){}else{redirect(base_url());}
			$data["datamenu"] = $this->Mlogin->cek_menu($idsistem_sistem, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($idsistem_sistem, $idlevel);
			$data["ids"] = $idsistem_sistem;
			$data["idf"] = $idformini;
			$this->idsc = $idsistem_sistem;
			$idform = array(); $akses = array();
			foreach ($data["dataform"] as $dx){
				array_push($idform, $dx->id_form);
				if($dx->id_form == $idformini){array_push($akses, $dx->akses_tambah, $dx->akses_update, $dx->akses_hapus, $dx->akses_cetak);}
			}
			if(array_search($idformini, $idform) !== false){
				$data["akses"] = $akses;
				$this->aksesc = $akses; 
			}else{redirect(base_url());}
        	$this->load->view($idsistem_sistem.'/basis', $data, true);
        }else{redirect(base_url());}
    }

	public function index(){
		$data["fill"] = "pl002v";
		$data["dtaga"] = $this->Mag778->data();
		$data["dtkec"] = $this->Mkc001->data();
		$data["dtdes"] = $this->Mds001->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpl002->data();
        foreach ($dt as $k){
        	$id = $k->id;
        	$nama = $k->nama;
			$jk = $k->jenis_kelamin;
		 	$alamat = $k->alamat;
		 	$telp = $k->telp;
		 	$username = $k->username;
			if($username == ""){
				$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='".$id."' data-nama='".$nama."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>&nbsp<button class='btn btn-icon btn-round btn-danger' data-toggle='modal' data-target='#md_akses' data-nama='".$nama."' data-id='".$id."' onclick='filter(this)'><i class='icon wb-user'></i></button>";
			}else{
				$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-toggle='modal' data-target='#md_edit' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			}
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$jk.'","'.$alamat.'","'.$telp.'"],';
        }

        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpl002->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		        	$nama = $k->nama;
		            $nik = $k->nik;
		 			$nip = $k->nip_nipppk;
					$gelarDep = $k->gelar_depan;
					$gelarBel = $k->gelar_belakang;
					$tempat_lahir = $k->tempat_lahir;
					$tgl_lahir = $k->tgl_lahir;
					$jk = $k->jenis_kelamin;
				 	$agama = $k->id_agama;
				 	$jsp = $k->jurusan_semasa_pendidikan;
				 	$sek = $k->sekolah_universitas;
				 	$kec = $k->id_kecamatan;
				 	$ptt = $k->pangkat_terakhir_terampil;
				 	$pta = $k->pangkat_terakhir_asn;
				 	$alamat = $k->alamat;
				 	$desa = $k->id_desa;
				 	$pos = $k->kode_pos;
				 	$telp = $k->telp;
				 	$email = $k->email;
				 	$status = $k->status;
				 	$jtt = $k->jenjang_jabatan_terampil;
				 	$jja = $k->jenjang_jabatan_ahli;
				 	$jab = $k->kelas_jabatan;
				}
				echo base64_encode("1|".$id."|".$nama."|".$nik."|".$nip."|".$gelarDep."|".$gelarBel."|".$tempat_lahir."|".$tgl_lahir."|".$jk."|".$agama."|".$jsp."|".$sek."|".$kec."|".$ptt."|".$pta."|".$alamat."|".$desa."|".$pos."|".$telp."|".$email."|".$status."|".$jtt."|".$jja."|".$jab);
				
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
public function filterdesa(){
	$idkec = $this->uri->segment(3);
	$hasil = $this->Mpl002->filterdesa($idkec);
	echo json_encode($hasil);
}

public function tambah(){
		if($this->aksesc[0] == "1"){
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$nik = trim(str_replace("'","''",$this->input->post("nik")));
			$nip = trim(str_replace("'","''",$this->input->post("nip")));
			$gelarDep = trim(str_replace("'","''",$this->input->post("gelarDep")));
			$gelarBel = trim(str_replace("'","''",$this->input->post("gelarBel")));
			$tempat_lahir = trim(str_replace("'","''",$this->input->post("tempat_lahir")));
			$tgl_lahir = trim(str_replace("'","''",$this->input->post("tgl_lahir")));
			$jk = trim(str_replace("'","''",$this->input->post("jk")));
			$agama = trim(str_replace("'","''",$this->input->post("agama")));
			$jsp = trim(str_replace("'","''",$this->input->post("jsp")));
			$sek = trim(str_replace("'","''",$this->input->post("sek")));
			$kec = trim(str_replace("'","''",$this->input->post("kec")));
			$ptt = trim(str_replace("'","''",$this->input->post("ptt")));
			$pta = trim(str_replace("'","''",$this->input->post("pta")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$desa = trim(str_replace("'","''",$this->input->post("desa")));
			$pos = trim(str_replace("'","''",$this->input->post("pos")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$email = trim(str_replace("'","''",$this->input->post("email")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$jtt = trim(str_replace("'","''",$this->input->post("jtt")));
			$jja = trim(str_replace("'","''",$this->input->post("jja")));
			$jab = trim(str_replace("'","''",$this->input->post("jab")));
			$operasi = $this->Mpl002->tambah($nama, $nik, $nip, $gelarDep, $gelarBel, $tempat_lahir, $tgl_lahir, $jk, $agama, $jsp, $sek, $kec, $ptt, $pta, $alamat, $desa, $pos, $telp, $email, $status, $jtt, $jja, $jab);
			if($operasi == "1"){
				$ket = "Nama: $nama,\nNik: $nik,\nNip/Nipppk: $nip,\nGelar Depan: $gelarDep,\nGelar Belakang: $gelarBel,\nTempat Lahir: $tempat_lahir,\nTanggal Lahir: $tgl_lahir,\nJenis Kelamin: $jk,\nAgama: $agama,\nJurusan Semasa Pendidikan: $jsp,\nSekolah/Universitas: $sek,\nKecamatan: $kec,\nPangkat Terakhir Terampil: $ptt,\nPangkat Terakhir ASN: $pta,\nAlamat: $alamat,\nDesa: $desa,\nKode Pos: $pos,\nTelepon: $telp,\nEmail: $email,\nStatus: $status,\nJenjang Jabatan Terampil: $jtt,\nJenjang Jabatan Ahli: $jja,\nJabatan: $jab";
				$this->Mlog->log_history("PPL","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$nik = trim(str_replace("'","''",$this->input->post("nik")));
			$nip = trim(str_replace("'","''",$this->input->post("nip")));
			$gelarDep = trim(str_replace("'","''",$this->input->post("gelarDep")));
			$gelarBel = trim(str_replace("'","''",$this->input->post("gelarBel")));
			$tempat_lahir = trim(str_replace("'","''",$this->input->post("tempat_lahir")));
			$tgl_lahir = trim(str_replace("'","''",$this->input->post("tgl_lahir")));
			$jk = trim(str_replace("'","''",$this->input->post("jk")));
			$agama = trim(str_replace("'","''",$this->input->post("agama")));
			$jsp = trim(str_replace("'","''",$this->input->post("jsp")));
			$sek = trim(str_replace("'","''",$this->input->post("sek")));
			$kec = trim(str_replace("'","''",$this->input->post("kec")));
			$ptt = trim(str_replace("'","''",$this->input->post("ptt")));
			$pta = trim(str_replace("'","''",$this->input->post("pta")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$desa = trim(str_replace("'","''",$this->input->post("desa")));
			$pos = trim(str_replace("'","''",$this->input->post("pos")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$email = trim(str_replace("'","''",$this->input->post("email")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$jtt = trim(str_replace("'","''",$this->input->post("jtt")));
			$jja = trim(str_replace("'","''",$this->input->post("jja")));
			$jab = trim(str_replace("'","''",$this->input->post("jab")));
			$operasi = $this->Mpl002->update($id, $nama, $nik, $nip, $gelarDep, $gelarBel, $tempat_lahir, $tgl_lahir, $jk, $agama, $jsp, $sek, $kec, $ptt, $pta, $alamat, $desa, $pos, $telp, $email, $status, $jtt, $jja, $jab);
			if($operasi == "1"){
				$ket = "ID PPL: $id,\nNama: $nama,\nNik: $nik,\nNip/Nipppk: $nip,\nGelar Depan: $gelarDep,\nGelar Belakang: $gelarBel,\nTempat Lahir: $tempat_lahir,\nTanggal Lahir: $tgl_lahir,\nJenis Kelamin: $jk,\nAgama: $agama,\nJurusan Semasa Pendidikan: $jsp,\nSekolah/Universitas: $sek,\nKecamatan: $kec,\nPangkat Terakhir Terampil: $ptt,\nPangkat Terakhir ASN: $pta,\nAlamat: $alamat,\nDesa: $desa,\nKode Pos: $pos,\nTelepon: $telp,\nEmail: $email,\nStatus: $status,\nJenjang Jabatan Terampil: $jtt,\nJenjang Jabatan Ahli: $jja,\nJabatan: $jab";
				$this->Mlog->log_history("PPL","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function tambah_akses(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$username = trim(str_replace("'","''",$this->input->post("username")));
			$pass =  md5(base64_encode(enkripsi($username)));
			$level = trim(str_replace("'","''",$this->input->post("level")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$operasi = $this->Mpl002->tambah_akses($id, $nama, $username, $pass, $level, $status);
			if($operasi == "1"){
				$ket = "ID Akses: $id,\nNama: $nama,\nUsername: $username,\nPassword: $pass,\nlevel: $level,\nstatus: $status";
				$this->Mlog->log_history("Akses","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpl002->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpl002->filter($id);
					$operasi = $this->Mpl002->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				        	$nama = $k->nama;
				            $nik = $k->nik;
				 			$nip = $k->nip_nipppk;
							$gelarDep = $k->gelar_depan;
							$gelarBel = $k->gelar_belakang;
							$tempat_lahir = $k->tempat_lahir;
							$tgl_lahir = $k->tgl_lahir;
							$jk = $k->jenis_kelamin;
						 	$agama = $k->id_agama;
						 	$jsp = $k->jurusan_semasa_pendidikan;
						 	$sek = $k->sekolah_universitas;
						 	$kec = $k->id_kecamatan;
						 	$ptt = $k->pangkat_terakhir_terampil;
						 	$pta = $k->pangkat_terakhir_asn;
						 	$alamat = $k->alamat;
						 	$desa = $k->id_desa;
						 	$pos = $k->kode_pos;
						 	$telp = $k->telp;
						 	$email = $k->email;
						 	$status = $k->status;
						 	$jtt = $k->jenjang_jabatan_terampil;
						 	$jja = $k->jenjang_jabatan_ahli;
						 	$jab = $k->kelas_jabatan;
						}
						 $ket = "ID PPL: $id,\nNama: $nama,\nNik: $nik,\nNip/Nipppk: $nip,\nGelar Depan: $gelarDep,\nGelar Belakang: $gelarBel,\nTempat Lahir: $tempat_lahir,\nTanggal Lahir: $tgl_lahir,\nJenis Kelamin: $jk,\nAgama: $agama,\nJurusan Semasa Pendidikan: $jsp,\nSekolah/Universitas: $sek,\nKecamatan: $kec,\nPangkat Terakhir Terampil: $ptt,\nPangkat Terakhir ASN: $pta,\nAlamat: $alamat,\nDesa: $desa,\nKode Pos: $pos,\nTelepon: $telp,\nEmail: $email,\nStatus: $status,\nJenjang Jabatan Terampil: $jtt,\nJenjang Jabatan Ahli: $jja,\nJabatan: $jab";
						 $this->Mlog->log_history("PPL","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}