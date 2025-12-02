<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pe190 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pe190";
		$this->load->model("Mpe190");
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
		$data["fill"] = "pe190v";
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpe190->data();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
            $kelahiran = $k->kelahiran;
            $tgl_lahir = $k->tanggal_lahir;
            if($k->jenis_kelamin == "1"){$jk = "Pria";}else{$jk = "Wanita";}
            $telp = $k->telp;
            $nip = $k->nip;
         	if($k->status == "1"){$status = "Aktif";}else{$status = "Tidak Aktif";}
         	if($k->status_pegawai == "1"){$sPegawai = "ASN";}else{$sPegawai = "Non ASN";}
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$kelahiran.'","'.$tgl_lahir.'","'.$jk.'","'.$telp.'","'.$nip.'","'.$status.'","'.$sPegawai.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpe190->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
				$id = $k->id;
	            $nama = $k->nama;
	            $kelahiran = $k->kelahiran;
	            $tgl_lahir = $k->tanggal_lahir;
	            $jk = $k->jenis_kelamin;
	            $telp = $k->telp;
	            $nip = $k->nip;
	            $status = $k->status;
	            $sPegawai = $k->status_pegawai;
				}
				echo base64_encode("1|".$id."|".$nama."|".$kelahiran."|".$tgl_lahir."|".$jk."|".$telp."|".$nip."|".$status."|".$sPegawai);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$kelahiran = trim(str_replace("'","''",$this->input->post("kelahiran")));
			$tgl_lahir = trim(str_replace("'","''",$this->input->post("tgl_lahir")));
			$jk = trim(str_replace("'","''",$this->input->post("jenis_kelamin")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$nip = trim(str_replace("'","''",$this->input->post("nip")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$sPegawai = trim(str_replace("'","''",$this->input->post("sPegawai")));
			$operasi = $this->Mpe190->tambah($nama, $kelahiran, $tgl_lahir, $jk, $telp, $nip, $status, $sPegawai);
			if($operasi == "1"){
				$ket = "Nama Pegawai: $nama,\nKelahiran: $kelahiran,\nTgl Lahir: $tgl_lahir,\nJenis Kelamin: $jk,\nTelepon: $telp,\nNip: $nip,\nStatus: $status,\nStatus Pegawai: $sPegawai";
				$this->Mlog->log_history("Pegawai","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$kelahiran = trim(str_replace("'","''",$this->input->post("kelahiran")));
			$tgl_lahir = trim(str_replace("'","''",$this->input->post("tgl_lahir")));
			$jk = trim(str_replace("'","''",$this->input->post("jenis_kelamin")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$nip = trim(str_replace("'","''",$this->input->post("nip")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$sPegawai = trim(str_replace("'","''",$this->input->post("sPegawai")));
			$operasi = $this->Mpe190->update($id, $nama, $kelahiran, $tgl_lahir, $jk, $telp, $nip, $status, $sPegawai);
			if($operasi == "1"){
				$ket = "ID Pegawai: $id,\nNama Pegawai: $nama,\nKelahiran: $kelahiran,\nTgl Lahir: $tgl_lahir,\nJenis Kelamin: $jk,\nTelepon: $telp,\nNip: $nip,\nStatus: $status,\nStatus Pegawai: $sPegawai";
				$this->Mlog->log_history("Pegawai","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpe190->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpe190->filter($id);
					$operasi = $this->Mpe190->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $nama = $k->nama;
				            $kelahiran = $k->kelahiran;
				            $tgl_lahir = $k->tanggal_lahir;
				            $jk = $k->jenis_kelamin;
				            $telp = $k->telp;
				            $nip = $k->nip;
				            $status = $k->status;
				            $sPegawai = $k->status_pegawai;	
						}
						$ket = "ID Pegawai: $id,\nNama Pegawai: $nama,\nKelahiran: $kelahiran,\nTgl Lahir: $tgl_lahir,\nJenis Kelamin: $jk,\nTelepon: $telp,\nNip: $nip,\nStatus: $status,\nStatus Pegawai: $sPegawai";
						$this->Mlog->log_history("Pegawai","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}