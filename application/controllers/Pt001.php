<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pt001 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pt001";
		$this->load->model('Mpt001');
		$this->load->model('Mdn002');
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
		$data["fill"] = "pt001v";
		$data["dtdes"] = $this->Mds001->data();
		$data["dtdus"] = $this->Mdn002->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpt001->data();
        foreach ($dt as $k){
            $nik = $k->nik;
            $nama = $k->nama;
			$jk = $k->jenis_kelamin;
			$kelahiran = $k->kelahiran;
			$tgl_lahir= $k->tgl_lahir;
			$telp = $k->telp;
			$ibu = $k->nama_ibu;
			$alamat = $k->alamat;
			$dusun = $k->id_dusun;
			$rt = $k->rt;
			$rw = $k->rw;
			$desa = $k->id_desa;
			$dus = $k->dusun;
			$des =$k->desa;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$nik."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$nik.'","'.$nama.'","'.$jk.'","'.$kelahiran.'","'.$tgl_lahir.'","'.$telp.'","'.$ibu.'","'.$alamat.'","'.$dus.'","'.$rt.'","'.$rw.'","'.$des.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$nik = trim($this->input->post("id"));
		$dt = $this->Mpt001->filter($nik);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$nik = $k->nik;
            		$nama = $k->nama;
					$jk = $k->jenis_kelamin;
					$kelahiran = $k->kelahiran;
					$tgl_lahir= $k->tgl_lahir;
					$telp = $k->telp;
					$ibu = $k->nama_ibu;
					$alamat = $k->alamat;
					$dusun = $k->id_dusun;
					$rt = $k->rt;
					$rw = $k->rw;
					$desa = $k->id_desa;
				}
				echo base64_encode("1|".$nik."|".$nama."|".$jk."|".$kelahiran."|".$tgl_lahir."|".$telp."|".$ibu."|".$alamat."|".$dusun."|".$rt."|".$rw."|".$desa);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	

public function tambah(){
		if($this->aksesc[0] == "1"){
			$nik = trim(str_replace("'","''",$this->input->post("nik")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$jk = trim(str_replace("'","''",$this->input->post("jk")));
			$kelahiran = trim(str_replace("'","''",$this->input->post("kelahiran")));
			$tgl_lahir = trim(str_replace("'","''",$this->input->post("tgl_lahir")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$ibu = trim(str_replace("'","''",$this->input->post("ibu")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$dus = trim(str_replace("'","''",$this->input->post("dus")));
			$rt = trim(str_replace("'","''",$this->input->post("rt")));
			$rw = trim(str_replace("'","''",$this->input->post("rw")));
			$des = trim(str_replace("'","''",$this->input->post("des")));
			$operasi = $this->Mpt001->tambah($nik, $nama, $jk, $kelahiran, $tgl_lahir, $telp, $ibu, $alamat, $dus, $rt, $rw,$des);
			if($operasi == "1"){
				$ket = "Nik: $nik,\nNama: $nama,\nJenis Kelamin: $jk,\nKelahiran: $kelahiran,\nTanggal Lahir: $tgl_lahir,\nTelepon: $telp,\nNama Ibu: $ibu,\nAlamat: $alamat,\nID Dusun: $dus,\nRT: $rt,\nRW: $rw,\nID Desa: $des";
				$this->Mlog->log_history("Petani","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$nik = trim(str_replace("'","''",$this->input->post("nik")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$jk = trim(str_replace("'","''",$this->input->post("jk")));
			$kelahiran = trim(str_replace("'","''",$this->input->post("kelahiran")));
			$tgl_lahir = trim(str_replace("'","''",$this->input->post("tgl_lahir")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$ibu = trim(str_replace("'","''",$this->input->post("ibu")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$dus = trim(str_replace("'","''",$this->input->post("dus")));
			$rt = trim(str_replace("'","''",$this->input->post("rt")));
			$rw = trim(str_replace("'","''",$this->input->post("rw")));
			$des = trim(str_replace("'","''",$this->input->post("des")));
			$operasi = $this->Mpt001->update($nik, $nama, $jk, $kelahiran, $tgl_lahir, $telp, $ibu, $alamat, $dus, $rt, $rw,$des);
			if($operasi == "1"){
				$ket = "Nik: $nik,\nNama: $nama,\nJenis Kelamin: $jk,\nKelahiran: $kelahiran,\nTanggal Lahir: $tgl_lahir,\nTelepon: $telp,\nNama Ibu: $ibu,\nAlamat: $alamat,\nID Dusun: $dus,\nRT: $rt,\nRW: $rw,\nID Desa: $des";
				$this->Mlog->log_history("Petani","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$nik = trim(str_replace("'","''",$this->input->post("nik")));
			$td = $this->Mpt001->cekform($nik);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpt001->filter($nik);
					$operasi = $this->Mpt001->hapus($nik);
					if($operasi == "1"){
						foreach ($dt as $k){
							$nik = $k->nik;
		            		$nama = $k->nama;
							$jk = $k->jenis_kelamin;
							$kelahiran = $k->kelahiran;
							$tgl_lahir= $k->tgl_lahir;
							$telp = $k->telp;
							$ibu = $k->nama_ibu;
							$alamat = $k->alamat;
							$id_dusun = $k->id_dusun;
							$rt = $k->rt;
							$rw = $k->rw;
							$id_desa = $k->id_desa;
						}
						
						 $ket = "Nik: $nik,\nNama: $nama,\nJenis Kelamin: $jk,\nKelahiran: $kelahiran,\nTanggal Lahir: $tgl_lahir,\nTelepon: $telp,\nNama Ibu: $ibu,\nAlamat: $alamat,\nID Dusun: $id_dusun,\nRT: $rt,\nRW: $rw,\nID Desa: $id_desa";
						 $this->Mlog->log_history("Petani","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}