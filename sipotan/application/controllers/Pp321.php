<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pp321 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "pp321";
		$this->load->model("Mpp321");
		$this->load->model("Mpk003");
		$this->load->model("Mpt071");
		$this->load->model("Mlh471");
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
		$data["fill"] = "pp321v";
		$data["dtnop"] = $this->Mlh471->data();
		$data["dtpupuk"] = $this->Mpk003->data();
		$data["dtpolatanam"] = $this->Mpt071->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mpp321->data();
        foreach ($dt as $k){
            $id = $k->id;
            $pt = $k->rencana_pola_tanam;
            $nop = $k->nop;
            $pupuk = $k->pupuk;
            $jumlah = $k->jumlah;
            $tgl_pakai = $k->tgl_pakai;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$pt.'","'.$nop.'","'.$pupuk.'","'.$jumlah.'","'.$tgl_pakai.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mpp321->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
				$id = $k->id;
				$nop = $k->nop;
	            $pupuk = $k->id_pupuk;
	            $jumlah = $k->jumlah;
	            $tgl_pakai = $k->tgl_pakai;
	            $pt = $k->id_rencana_pola_tanam;		
				}
				echo base64_encode("1|".$id."|".$nop."|".$pupuk."|".$jumlah."|".$tgl_pakai."|".$pt);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$nop = trim(str_replace("'","''",$this->input->post("nop")));
			$pupuk = trim(str_replace("'","''",$this->input->post("pupuk")));
			$jumlah = trim(str_replace("'","''",$this->input->post("jumlah")));
			$tgl_pakai = trim(str_replace("'","''",$this->input->post("tgl_pakai")));
			$pt = trim(str_replace("'","''",$this->input->post("pt")));
			$operasi = $this->Mpp321->tambah($nop, $pupuk, $jumlah, $tgl_pakai, $pt);
			if($operasi == "1"){
				$ket = "NOP: $nop,\nID Pupuk: $pupuk,\nJumlah: $jumlah,\nTanggal Pakai: $tgl_pakai,\nID Rencana Pola Tanam: $pt";
				$this->Mlog->log_history("Penggunaan Pupuk","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nop = trim(str_replace("'","''",$this->input->post("nop")));
			$pupuk = trim(str_replace("'","''",$this->input->post("pupuk")));
			$jumlah = trim(str_replace("'","''",$this->input->post("jumlah")));
			$tgl_pakai = trim(str_replace("'","''",$this->input->post("tgl_pakai")));
			$pt = trim(str_replace("'","''",$this->input->post("pt")));
			$operasi = $this->Mpp321->update($id, $nop, $pupuk, $jumlah, $tgl_pakai, $pt);
			if($operasi == "1"){
				$ket = "ID Penggunaan Pupuk: $id,\nNOP: $nop,\nID Pupuk: $pupuk,\nJumlah: $jumlah,\nTanggal Pakai: $tgl_pakai,\nID Rencana Pola Tanam: $pt";
				$this->Mlog->log_history("Penggunaan Pupuk","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mpp321->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mpp321->filter($id);
					$operasi = $this->Mpp321->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
							$nop = $k->nop;
				            $pupuk = $k->id_pupuk;
				            $jumlah = $k->jumlah;
				            $tgl_pakai = $k->tgl_pakai;
				            $pt = $k->id_rencana_pola_tanam;
						}
						$ket = "ID Penggunaan Pupuk: $id,\nID Pupuk: $pupuk,\nJumlah: $jumlah,\nTanggal Pakai: $tgl_pakai,\nID Rencana Pola Tanam: $pt";
						$this->Mlog->log_history("Penggunaan Pupuk","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}