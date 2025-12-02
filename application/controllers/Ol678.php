<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ol678 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ol678";
		$this->load->model("Mol678");
		$this->load->model("Mld111");
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
		$data["fill"] = "ol678v";
		$data["dtlahan"] = $this->Mld111->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mol678->data();
        foreach ($dt as $k){
            $id = $k->id;
            $lahan = $k->id_lahan;
            $tgl_singkal1 = $k->tgl_singkal1;
            $tgl_singkal2 = $k->tgl_singkal2;
            $tgl_garuh = $k->tgl_garuh;
            $tanah = $k->jenis_tanah;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$lahan.'","'.$tgl_singkal1.'","'.$tgl_singkal2.'","'.$tgl_garuh.'","'.$tanah.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mol678->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
				 	$id = $k->id;
		            $lahan = $k->id_lahan;
		            $tgl_singkal1 = $k->tgl_singkal1;
		            $tgl_singkal2 = $k->tgl_singkal2;
		            $tgl_garuh = $k->tgl_garuh;
		            $tanah = $k->jenis_tanah;		
				}
				echo base64_encode("1|".$id."|".$lahan."|".$tgl_singkal1."|".$tgl_singkal2."|".$tgl_garuh."|".$tanah);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$tgl_singkal1 = trim(str_replace("'","''",$this->input->post("tgl_singkal1")));
			$tgl_singkal2 = trim(str_replace("'","''",$this->input->post("tgl_singkal2")));
			$tgl_garuh = trim(str_replace("'","''",$this->input->post("tgl_garuh")));
			$tanah = trim(str_replace("'","''",$this->input->post("tanah")));
			$operasi = $this->Mol678->tambah($lahan, $tgl_singkal1, $tgl_singkal2, $tgl_garuh, $tanah);
			if($operasi == "1"){
				$ket = "ID Lahan: $lahan,\nTanggal Singkal 1: $tgl_singkal1,\nTanggal Singkal 2: $tgl_singkal2,\nTanggal Garuh: $tgl_garuh,\nJenis Tanah: $tanah";
				$this->Mlog->log_history("Olah Lahan","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$lahan = trim(str_replace("'","''",$this->input->post("lahan")));
			$tgl_singkal1 = trim(str_replace("'","''",$this->input->post("tgl_singkal1")));
			$tgl_singkal2 = trim(str_replace("'","''",$this->input->post("tgl_singkal2")));
			$tgl_garuh = trim(str_replace("'","''",$this->input->post("tgl_garuh")));
			$tanah = trim(str_replace("'","''",$this->input->post("tanah")));
			$operasi = $this->Mol678->update($id, $lahan, $tgl_singkal1, $tgl_singkal2, $tgl_garuh, $tanah);
			if($operasi == "1"){
				$ket = "ID Olah Lahan: $id,\nID Lahan: $lahan,\nTanggal Singkal 1: $tgl_singkal1,\nTanggal Singkal 2: $tgl_singkal2,\nTanggal Garuh: $tgl_garuh,\nJenis Tanah: $tanah";
				$this->Mlog->log_history("Olah Lahan","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mol678->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mol678->filter($id);
					$operasi = $this->Mol678->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
				            $lahan = $k->id_lahan;
				            $tgl_singkal1 = $k->tgl_singkal1;
				            $tgl_singkal2 = $k->tgl_singkal2;
				            $tgl_garuh = $k->tgl_garuh;
				            $tanah = $k->jenis_tanah;	
						}
						$ket = "ID Olah Lahan: $id,\nID Lahan: $lahan,\nTanggal Singkal 1: $tgl_singkal1,\nTanggal Singkal 2: $tgl_singkal2,\nTanggal Garuh: $tgl_garuh,\nJenis Tanah: $tanah";						
						$this->Mlog->log_history("Olah Lahan","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}