<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mh149 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "mh149";
		$this->load->model("Mmh149");
		$this->load->model("Muh157");
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
		$data["fill"] = "mh149v";
		$data["dtuh"] = $this->Muh157->data();
		$data["dtpol"] = $this->Mpt071->data();
		$data["dtlah"] = $this->Mlh471->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mmh149->data();
        foreach ($dt as $k){
            $id = $k->id;
            $idp = $k->id_rencana_pola_tanam;
            $nop= $k->nop;
            $idu = $k->id_unsur_hara;
            $nilai = $k->nilai;
            $idpol = $k->pola_tanam;
            $idup = $k->unsur_hara;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$idpol.'","'.$nop.'","'.$idup.'","'.$nilai.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mmh149->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
				$id = $k->id;
	            $nop= $k->nop;
	            $idp = $k->id_rencana_pola_tanam;
	            $idu = $k->id_unsur_hara;
	            $nilai = $k->nilai;		
				}
				echo base64_encode("1|".$id."|".$nop."|".$idp."|".$idu."|".$nilai);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$nop = trim(str_replace("'","''",$this->input->post("nop")));
			$idp = trim(str_replace("'","''",$this->input->post("idp")));
			$idu = trim(str_replace("'","''",$this->input->post("idu")));
			$nilai = trim(str_replace("'","''",$this->input->post("nilai")));
			$operasi = $this->Mmh149->tambah($nop, $idp, $idu, $nilai);
			if($operasi == "1"){
				$ket = "NOP: $nop,\nId Rencana Pola Tanam: $idp,\nID Unsur Hara: $idu,\nNilai: $nilai";
				$this->Mlog->log_history("Monintoring Unsur Hara","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nop = trim(str_replace("'","''",$this->input->post("nop")));
			$idp = trim(str_replace("'","''",$this->input->post("idp")));
			$idu = trim(str_replace("'","''",$this->input->post("idu")));
			$nilai = trim(str_replace("'","''",$this->input->post("nilai")));
			$operasi = $this->Mmh149->update($id, $nop, $idp, $idu, $nilai);
			if($operasi == "1"){
				$ket = "ID Monintoring Unsur Hara: $id,\nNOP: $nop,\nId Rencana Pola Tanam: $idp,\nID Unsur Hara: $idu,\nNilai: $nilai";
				$this->Mlog->log_history("Monintoring Unsur Hara","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mmh149->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mmh149->filter($id);
					$operasi = $this->Mmh149->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $nop= $k->nop;
				            $idp = $k->id_rencana_pola_tanam;
				            $idu = $k->id_unsur_hara;
				            $nilai = $k->nilai;		
						}
						$ket = "ID Monintoring Unsur Hara: $id,\nNOP: $nop,\nId Rencana Pola Tanam: $idp,\nID Unsur Hara: $idu,\nNilai: $nilai";
						$this->Mlog->log_history("Monintoring Unsur Hara","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}