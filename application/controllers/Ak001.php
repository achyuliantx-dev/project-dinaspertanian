<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ak001 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ak001";
		$this->load->model('Mak001');
		$this->load->model('Mkc001');
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
		$data["fill"] = "ak001v";
		$data["dtkec"] = $this->Mkc001->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mak001->data();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
            $tgl = $k->tgl_berdiri;
            $no = $k->no_legalitas;
            if($k->status == "1"){$stat = "Aktif";}else{$stat = "Tak Aktif";}
            $alamat = $k->alamat;
            $kec = $k->id_kecamatan;
            $telp = $k->telp;
            $email = $k->email;
            $cam = $k->kecamatan;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$tgl.'","'.$no.'","'.$stat.'","'.$alamat.'","'.$cam.'","'.$telp.'","'.$email.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mak001->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
		            $nama = $k->nama;
		            $tgl = $k->tgl_berdiri;
		            $no = $k->no_legalitas;
		            $stat = $k->status;
		            $alamat = $k->alamat;
		            $kec = $k->id_kecamatan;
		            $telp = $k->telp;
		            $email = $k->email;
				}
				echo base64_encode("1|".$id."|".$nama."|".$tgl."|".$no."|".$stat."|".$alamat."|".$kec."|".$telp."|".$email);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$no = trim(str_replace("'","''",$this->input->post("no")));
			$stat = trim(str_replace("'","''",$this->input->post("stat")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$kec = trim(str_replace("'","''",$this->input->post("kec")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$email = trim(str_replace("'","''",$this->input->post("email")));
			$operasi = $this->Mak001->tambah($nama,$tgl,$no,$stat, $alamat,$kec,$telp,$email);
			if($operasi == "1"){
				$ket = "Nama Asosiasi Kecamatan: $nama,\nTanggal: $tgl,\nNomor Legalitas: $no,\nStatus: $stat,\nAlamat: $alamat,\nNama Kecamatan: $kec,\nTelp: $telp,\nEmail: $email";
				$this->Mlog->log_history("Asosiasi Kecamatan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$tgl = trim(str_replace("'","''",$this->input->post("tgl")));
			$no = trim(str_replace("'","''",$this->input->post("no")));
			$stat = trim(str_replace("'","''",$this->input->post("stat")));
			$alamat = trim(str_replace("'","''",$this->input->post("alamat")));
			$kec = trim(str_replace("'","''",$this->input->post("kec")));
			$telp = trim(str_replace("'","''",$this->input->post("telp")));
			$email = trim(str_replace("'","''",$this->input->post("email")));
			$operasi = $this->Mak001->update($id, $nama,$tgl,$no,$stat, $alamat,$kec,$telp,$email);
			if($operasi == "1"){
				$ket = "ID Asosiasi Kecamatan: $id,\nNama Asosiasi Kecamatan: $nama,\nTanggal: $tgl,\nNomor Legalitas: $no,\nStatus: $stat,\nAlamat: $alamat,\nNama Kecamatan: $kec,\nTelp: $telp,\nEmail: $email";
				$this->Mlog->log_history("Asosiasi Kecamatan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mak001->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mak001->filter($id);
					$operasi = $this->Mak001->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $nama = $k->nama;
				            $tgl = $k->tgl_berdiri;
				            $no = $k->no_legalitas;
				            $stat = $k->status;
				            $alamat = $k->alamat;
				            $kec = $k->id_kecamatan;
				            $telp = $k->telp;
				            $email = $k->email;
						}
						$ket = "ID Asosiasi Kecamatan: $id,\nNama Asosiasi Kecamatan: $nama,\nTanggal: $tgl,\nNomor Legalitas: $no,\nStatus: $stat,\nAlamat: $alamat,\nNama Kecamatan: $kec,\nTelp: $telp,\nEmail: $email";
				$this->Mlog->log_history("Asosiasi Kecamatan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}